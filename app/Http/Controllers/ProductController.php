<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with('images')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'images.*' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $product = Product::create($request->only('name', 'price'));

        foreach ($request->file('images') as $image) {
            $path = $image->store('product_images', 'public');
            $product->images()->create(['image_url' => $path]);
        }

        return response()->json($product->load('images'), 201);
    }
}
