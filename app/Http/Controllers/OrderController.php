<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class OrderController extends Controller
{
    

    public function storeOrder(Request $request)
{
    if (Auth::user()->role === 'admin') {
        return response()->json([
            'message' => 'Admins cannot place orders.'
        ], 403);
    }

    $data = $request->validate([
        'product_id' => 'required|integer',
        'quantity'   => 'required|integer|min:1',
        'name'       => 'required|string',
        'email'      => 'required|email',
        'number'     => 'required|string',
        'address'    => 'required|string',
        'province'   => 'required|string',
    ]);

    DB::beginTransaction();

    try {

        $product = Product::lockForUpdate()->findOrFail($data['product_id']);

        // ❗ STOCK CHECK
        if ($product->stock < $data['quantity']) {
            throw new \Exception('Not enough stock available');
        }

        // reduce stock
        $product->stock -= $data['quantity'];

        // update availability
        if ($product->stock <= 0) {
            $product->availability = 'out_of_stock';
        }

        $product->save();

        $price = $product->price;
        $total = $price * $data['quantity'];

        Order::create([
            'user_id'    => auth()->id(),
            'product_id' => $data['product_id'],
            'item_name'  => $product->title,
            'item_image' => $product->mainImage->image_path ?? null,
            'quantity'   => $data['quantity'],
            'price'      => $price,
            'total'      => $total,
            'name'       => $data['name'],
            'email'      => $data['email'],
            'phone'      => $data['number'],
            'address'    => $data['address'],
            'province'   => $data['province'],
            'status'     => 'pending',
        ]);

        DB::commit();

        return redirect()->route('user.orders')
            ->with('success', 'Order placed successfully!');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', $e->getMessage());
    }
}

    //Function to display Product info and delivery info to orderSummeryPg
    public function index(Request $request)
    {
        
        if (Auth::user()->role === 'admin') {
            return response()->json([
                'message' => 'Admins cannot place orders.'
            ], 403);
        }
        $product = Product::findOrFail($request->product_id);
        $delivery = Delivery::findOrFail($request->delivery_id);
    

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // From cart
            $quantity = $cartItem->quantity;
            $total = $cartItem->quantity * $cartItem->price;


        } else {
            // Direct order
            $quantity = 1;
            $total = $product->price;
        }
        
        return view('OrderSummeryPg', [
            'product' => $product,
            'delivery' => $delivery,
            'quantity' => $quantity,
            'total' => $total
        ]);
    }   


    public function buyNow($productId)
    {

        
        if (Auth::user()->role === 'admin') {
            return response()->json([
                'message' => 'Admins cannot buy products.'
            ], 403);
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();
    
        // If product already in cart → go to cart page
        if ($cartItem) {
            return redirect()->route('cart.show');
        }
    
        // If not in cart → go to product page
        return redirect()->route('product.show', $productId);
    }




    public function userOrders(){
        
        $orders = Order:: where('user_id', Auth::id())
        ->latest()
        ->get();
        return view('userOrdersPg', compact('orders')); 
    } 



//Admin order managment
public function pendingOrders(){
    if (!Auth::check()) {
        return redirect()->route('login');
    }
$orders = Order::where('status','pending')
-> latest()
->paginate(10);
return view('admin.pendingOrdersPg', compact('orders'));

}



public function adminProductInfo($orderId){

    if (!Auth::check()) {
        return redirect()->route('login');
    }
    $order = Order::with('product')->findOrFail($orderId);

    return view('admin.orderProductInfoPg', compact('order'));
    

}




public function updateStatus(Request $request, $id)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    $order = Order::findOrFail($id);

    $order->status = $request->status;
    $order->save();

    return back()->with('success', 'Order status updated successfully!');
}




public function shippedOrders(){
    
    $orders = Order::where('status','shipped')
    -> latest()
    ->paginate(10);
    return view('admin.shippedOrdersPg', compact('orders'));
    
    }

    public function completedOrders(){
        
        $orders = Order::where('status','completed')
        -> latest()
        ->paginate(10);
        return view('admin.completedOrdersPg', compact('orders'));
        
        }

    public function cancelledOrders(){
        
        $orders = Order::where('status','cancelled')
        -> latest()
        ->paginate(10);
        return view('admin.cancelledOrdersPg', compact('orders'));
        
        }
    

     public function deleteOrder($id){
        $order = Order::findOrFail($id);
        $order->delete();
    
        return redirect()->back()->with('success', 'Order deleted successfully!');
    }    


    public function adminDashboard()
    {
        
     return view('admin.adminDashboard',[
        'weekly' => $this->weekylySalesChart(),
        'monthly' => $this->monthlySalesChart(),
        'totalOrderCount' => $this ->showTotalOrderCount(),
        'revenue' => $this ->showRevenue(),
        'customerCount' => $this ->showTotalCustomers()

     ]);
    }


public function weekylySalesChart (){
   
    
    // Last 7 days

   $dates = collect();
   $sales = collect();

   for ($i = 6; $i >= 0; $i--) {
       $date = Carbon::today()->subDays($i);

       $total = Order::whereDate('created_at', $date)
           ->where('status', 'completed') // only completed orders
           ->sum('total');

       $dates->push($date->format('D')); // Mon, Tue...
       $sales->push($total);
   }

   return [
       'labels' => $dates->toArray(),
       'data' => $sales->toArray()
   ];
}

public function monthlySalesChart()
{
    
    $months = collect();
    $monthlyRevenue = collect();

    // Loop through the last 12 months
    for ($i = 11; $i >= 0; $i--) {
        $date = Carbon::now()->subMonths($i);

        // Count completed orders in this month
        $total = Order::whereYear('created_at', $date->year)
        ->whereMonth('created_at', $date->month)
        ->where('status', 'completed')
        ->sum('total');

        $months->push($date->format('M')); // Jan, Feb, Mar...
        $monthlyRevenue->push($total);
    }

    return [
        'labels' => $months->toArray(),
        'data' => $monthlyRevenue->toArray()
    ];
}

public function showTotalOrderCount(){
$totalOrders = Order::where('status', 'completed') 
-> count();
return [
'totalOrders' => $totalOrders
  ];

}

public function showRevenue()
{
    
   $totalRevenue = Order::where('status', 'completed') // optional but recommended
    ->sum('total'); // column name
return [
'totalRevenue' =>$totalRevenue
];

}


public function showTotalCustomers(){
    
$customerCount = User::where('role', 'user') 
->count();
return [
'totalCustomers' => $customerCount

];
}

    

}
