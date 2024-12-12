<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function showAddProductForm()
    {
        $categories = DB::table('categories')->select('id', 'name')->get();
        return view('admin.add_product', compact('categories'));
    }

    public function storeProduct(Request $request) 
    {
        // Validate the incoming data
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required|string|max:500',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|string|max:255',
            'made_in' => 'nullable|string|max:255',
            'product_highlight' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'special_price' => 'nullable|numeric|min:0',
            'percentage_off' => 'nullable|numeric|min:0|max:100',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('product_images', 'public'); 
            }
        }

        DB::table('products')->insert([
            'name' => $request->product_name,
            'category_id' => $request->category_id,
            'short_description' => $request->short_description,
            'images' => json_encode($imagePaths), // Store images as a JSON array
            'tags' => $request->tags,
            'made_in' => $request->made_in,
            'product_highlight' => $request->product_highlight,
            'description' => $request->description,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'percentage_off' => $request->percentage_off,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }
}
