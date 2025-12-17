<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Prevent guest users
        if (!Auth::check()) {
            return response()->json(['message' => 'Login required'], 401);
        }
    
        // Validation
        $request->validate([
            'product' => 'required|array',
            'product.name'  => 'required|string',
            'product.price' => 'required|numeric',
            'product.image' => 'nullable|string'
        ]);
    
        $product = $request->input('product');
    
        // Check if product already exists
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('name', $product['name'])
                        ->first();
    
        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id'  => Auth::id(),
                'name'     => $product['name'],
                'price'    => $product['price'],
                'image'    => $product['image'] ?? null,
                'quantity' => 1
            ]);
        }
    
        // Get updated cart count (total item quantity)
        $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
    
        return response()->json([
            'message' => 'Product added to cart',
            'cartCount' => $cartCount
        ]);
    }
    

    public function showCart()
    {
       
        $cart = Cart::where('user_id', Auth::id())->get();
    
        return view('CartPg', compact('cart'));
    }
    
    

    
    public function deleteCartItem(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:carts,id'
    ]);

    $cartItem = Cart::find($request->id);

    if ($cartItem && $cartItem->user_id == Auth::id()) {
        $cartItem->delete();
    }

    // Return updated cart info
    $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
    $cart = Cart::where('user_id', Auth::id())->get();

    return response()->json([
        'cartCount' => $cartCount,
        'cart' => $cart
    ]);
}

public function incrementQuantity(Request $request)
{
  
    $request->validate([
        'id' => 'required|integer|exists:carts,id'
    ]);

    $cartItem = Cart::find($request->id);

    if ($cartItem && $cartItem->user_id == Auth::id()) {
        $cartItem->quantity += 1;
        $cartItem->save();
    }

    // Recalculate subtotal for this item
    $subtotal = $cartItem->price * $cartItem->quantity;

    // Recalculate total price for all items in the cart
    $totalPrice = Cart::where('user_id', Auth::id())
                      ->sum(DB::raw('price * quantity'));

    // Recalculate total quantity for cart badge
    $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');

    return response()->json([
        'quantity'   => $cartItem->quantity, // updated item quantity
        'subtotal'   => $subtotal,           // updated item subtotal
        'totalPrice' => $totalPrice,         // updated grand total
        'cartCount'  => $cartCount           // updated cart count
    ]);
}


public function decrementQuantity(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:carts,id'
    ]);

    $cartItem = Cart::find($request->id);

    if ($cartItem && $cartItem->user_id == Auth::id()) {
        // Prevent quantity from going below 1
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
        }
    }

    // Recalculate subtotal for this item
    $subtotal = $cartItem->price * $cartItem->quantity;

    // Recalculate total price for all items in the cart
    $totalPrice = Cart::where('user_id', Auth::id())
                      ->sum(DB::raw('price * quantity'));

    // Recalculate total quantity for cart badge
    $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');

    return response()->json([
        'quantity'   => $cartItem->quantity, // updated item quantity
        'subtotal'   => $subtotal,           // updated item subtotal
        'totalPrice' => $totalPrice,         // updated grand total
        'cartCount'  => $cartCount           // updated cart count
    ]);
}




}

