<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products with their images
        $products = Product::with('images')->paginate(10);

        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }

    public function adminView()
    {
        $products = Product::with('images')->get();
        return view('admin.products', compact('products'));
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
