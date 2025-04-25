<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $cart = Cart::create([
            'user_id' => 1,
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'] ?? 1
        ]);

        return response()->json($cart, 201);
    }

    public function viewCart()
    {
        return Cart::with('product.images')->where('user_id', 1)->get();
    }
}

