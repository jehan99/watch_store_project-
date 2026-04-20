<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Login required'], 401);
        }

        if (Auth::user()->role === 'admin') {
            return response()->json([
                'message' => 'Admins cannot add products to cart.'
            ], 403);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->availability === 'out_of_stock') {
            return response()->json([
                'message' => 'Product is out of stock.'
            ], 400);
        }
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {

            if ($cartItem->quantity >= $product->stock) {
                return response()->json([
                    'message' => 'Max stock reached'
                ], 400);
            }

            $cartItem->increment('quantity');
        } else {

            if ($product->stock < 1) {
                return response()->json([
                    'message' => 'Out of stock'
                ], 400);
            }

            Cart::create([
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
                'name'       => $product->title,
                'price'      => $product->price,
                'image'      => $product->main_image,
                'quantity'   => 1
            ]);
        }

        return response()->json([
            'message'   => 'Product added to cart',
            'cartCount' => Cart::where('user_id', Auth::id())->sum('quantity')
        ]);
    }

    public function showCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Remove cart items whose products were deleted by admin
        Cart::where('user_id', Auth::id())
            ->whereDoesntHave('product')
            ->delete();


        // Get cart with main product image
        $cart = Cart::where('user_id', Auth::id())
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->leftJoin('product_images', function ($join) {
                $join->on('products.id', '=', 'product_images.product_id')
                    ->where('product_images.is_main', 1);
            })
            ->select(
                'carts.*',
                'products.title as name',
                'products.price',
                'products.availability',
                'product_images.image_path as image' // main image
            )
            ->get();

        return view('CartPg', compact('cart'));
    }

    public function deleteCartItem(Request $request)
    {

        if (!Auth::check()) {
            return response()->json(['message' => 'Login required'], 401);
        }

        if (Auth::user()->role === 'admin') {
            return response()->json([
                'message' => 'Admins cannot modify cart.'
            ], 403);
        }


        $request->validate([
            'id' => 'required|exists:carts,id'
        ]);

        $cartItem = Cart::findOrFail($request->id);

        if ($cartItem->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $cartItem->delete();

        return response()->json([
            'cartCount' => Cart::where('user_id', Auth::id())->sum('quantity')
        ]);
    }

    public function incrementQuantity(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Login required'], 401);
        }

        if (Auth::user()->role === 'admin') {
            return response()->json([
                'message' => 'Admins cannot modify cart.'
            ], 403);
        }


        $request->validate([
            'id' => 'required|exists:carts,id'
        ]);

        $cartItem = Cart::findOrFail($request->id);



        if ($cartItem->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }


        if (!$cartItem->product) {
            $cartItem->delete();
            return response()->json([
                'message'   => 'Product no longer available',
                'cartCount' => Cart::where('user_id', Auth::id())->sum('quantity')
            ], 410);
        }


        if ($cartItem->product->availability === 'out_of_stock') {
            return response()->json([
                'message' => 'Product is out of stock'
            ], 400);
        }

        if ($cartItem->quantity >= $cartItem->product->stock) {
            return response()->json([
                'error' => true,
                'maxReached' => true,
                'message' => 'Max stock reached'
            ], 400);
        }

        $cartItem->increment('quantity');

        return response()->json([
            'quantity'   => $cartItem->quantity,
            'subtotal'   => $cartItem->price * $cartItem->quantity,
            'totalPrice' => Cart::where('user_id', Auth::id())
                ->sum(DB::raw('price * quantity')),
            'cartCount'  => Cart::where('user_id', Auth::id())->sum('quantity')
        ]);
    }

    public function decrementQuantity(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Login required'], 401);
        }
        if (Auth::user()->role === 'admin') {
            return response()->json([
                'message' => 'Admins cannot modify cart.'
            ], 403);
        }



        $request->validate([
            'id' => 'required|exists:carts,id'
        ]);

        $cartItem = Cart::findOrFail($request->id);

        if ($cartItem->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }


        if (!$cartItem->product) {
            $cartItem->delete();
            return response()->json([
                'message'   => 'Product no longer available',
                'cartCount' => Cart::where('user_id', Auth::id())->sum('quantity')
            ], 410);
        }

        if ($cartItem->product->availability === 'out_of_stock') {
            return response()->json([
                'message' => 'Product is out of stock'
            ], 400);
        }

        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        }

        return response()->json([
            'quantity'   => $cartItem->quantity,
            'subtotal'   => $cartItem->price * $cartItem->quantity,
            'totalPrice' => Cart::where('user_id', Auth::id())
                ->sum(DB::raw('price * quantity')),
            'cartCount'  => Cart::where('user_id', Auth::id())->sum('quantity')
        ]);
    }
}
