<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function deliveryInfo(Request $request)
{
    // Make sure user is logged in
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $request->validate([
        'name' => 'required',
        'number' => 'required',
        'email' => 'required|email',
        'address' => 'required',
        'province' => 'required',
        'product_id' => 'required|exists:products,id', 
    ]);

    // Save delivery and assign to a variable
    $delivery = Delivery::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'number' => $request->number,
        'email' => $request->email,
        'address' => $request->address,
        'province' => $request->province,
    ]);

    // Redirect to order summary with product and delivery IDs
    return redirect()->route('order.summary', [
        'product_id' => $request->product_id,
        'delivery_id' => $delivery->id
    ]);
}


public function deliveryInfoDisplay($product_id){




    $deliveries = Delivery::where('user_id', Auth::id())->latest()->get();
$showSaved = $deliveries->isNotEmpty();

return view('DeliverInfoPg', compact('product_id', 'deliveries', 'showSaved'));
    // if (!Auth::check()) {
    //     return redirect()->route('login');
    // }

    // // Get logged-in user's delivery info
    // $delivery = Delivery::where('user_id', Auth::id())->first();
    // $orders = Order::where('user_id', Auth::id())->get();
    // $showSaved = true;
    // return view('DeliverInfoPg', compact('delivery','orders','showSaved'));

}



public function useDelivery(Request $request)
{
    $delivery = Delivery::where('id', $request->delivery_id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    // Store selected delivery in session (temporary)
    session(['selected_delivery' => $delivery->id]);

    return redirect()->route('order.summary')->with('success', 'Delivery info selected!');
}
    



public function showDeliveryPage()
{
    $delivery = Delivery::where('user_id', Auth::id())->latest()->first();

    // If user just submitted form → DO NOT show
    if (session()->has('just_saved')) {
        $showSaved = false;

        // remove flag after using it
        session()->forget('just_saved');
    } else {
        // normal revisit → show saved data
        $showSaved = true;
    }

    return view('OrderSummeryPg', compact('delivery', 'showSaved'));
}




public function deleteDelivery(Request $request)
{
    $delivery = Delivery::where('id', $request->delivery_id)
        ->where('user_id', Auth::id()) 
        ->first();

    if ($delivery) {
        $delivery->delete();
        return response()->json([
            'success' => true,
            'message' => 'Delivery address deleted!'
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Delivery not found!'
    ], 404);
}
}


