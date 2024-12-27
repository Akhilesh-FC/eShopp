<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function showAddProductForm(Request $request)
    {
        $perPage = $request->input('per_page', 5);
    
        // Fetch products with the 'status' column (0 for active, 1 for inactive)
        $products = DB::table('products')
            ->select('id', 'name', 'status') 
            ->paginate($perPage);
        $categories = DB::table('categories')->select('id', 'name')->get();
    
        return view('products.addproducts', compact('products', 'perPage', 'categories'));
    }
    
    public function getSubcategories($categoryId)
    {
        // Fetch subcategories for the selected category
        $subcategories = DB::table('subcategories')
            ->where('category_id', $categoryId)
            ->select('id', 'name')
            ->get();
    
        return response()->json(['subcategories' => $subcategories]);
    }


    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required|string|max:500',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|string|max:255',
            'made_in' => 'nullable|string|max:255',
            'product_highlight' => 'required|string',
            'description' => 'required|string',
            'color' => 'required|string',
            'size' => 'required|string',
            'price' => 'required|numeric|min:0',
            'special_price' => 'required|numeric|min:0',
            'percentage_off' => 'required|numeric|min:0|max:100',
        ]);
    
        // Define the folder path for storing images
        $folderPath = public_path('products/');  
    
        // Create the products folder if it doesn't exist
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);  
        }
    
        // Initialize an array to store image URLs
        $imageUrls = [];
    
        // Iterate over each uploaded image and save them
        foreach ($request->file('images') as $image) {
    
            // Generate a unique name for each image
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            // Move the image to the products folder
            $image->move($folderPath, $imageName);  
    
            // Generate the image URL
            $imageUrl = url('products/' . $imageName);
    
            // Add the URL to the array
            $imageUrls[] = $imageUrl;
        }
    
        // Insert the product details into the products table
        $productId = DB::table('products')->insertGetId([
            'name' => $request->product_name,
            'category_id' => $request->category_id,
            'short_description' => $request->short_description,
            'image' => json_encode($imageUrls), 
            'tags' => $request->tags,
            'made_in' => $request->made_in,
            'product_highlight' => $request->product_highlight,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Insert the product variant details into the product_variants table
        DB::table('product_variants')->insert([
            'product_id' => $productId, 
            'color' => $color,
            'size' => $size,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'percentage_off' => $request->percentage_off,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Return a success message after adding the product
        return redirect()->back()->with('success', 'Product added successfully!');
    }
    
    public function manageProducts(Request $request)
    {
        $perPage = $request->input('per_page', 5);
    
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.id', 'products.name', 'products.image', 'products.brand', 'products.rating', 'products.status','categories.name as category_name')
            ->leftJoin('product_rating', 'products.id', '=', 'product_rating.product_id')
            ->paginate($perPage);  // Use paginate() instead of get()
    
        return view('products.manageproducts', compact('products'));
    }

    public function updateRating(Request $request, $id)
    {
        $rating = $request->input('rating');
        $variants = DB::table('product_rating')->where('product_id', $id)->get();
    
        if ($variants->isNotEmpty()) {
            
            DB::table('product_rating')
                ->where('product_id', $id) 
                ->update(['rating' => $rating]); 
    
            return redirect()->back()->with('success', 'Ratings updated successfully.');
        }
    
        return redirect()->back()->with('error', 'No variants found for this product.');
    }
    
    public function deleteProduct($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        
        if ($product) {
            DB::table('products')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Product deleted successfully.');
        }
    
        return redirect()->back()->with('error', 'Product not found.');
    }
    
    
    public function toggleActiveInactive($id)
    {
        // Use 'first()' to fetch a single product row, which returns a stdClass object
        $product = DB::table('products')->where('id', $id)->first();
   // dd($product);
        if ($product) {
            // Access the 'status' field from the retrieved stdClass object
            $newStatus = $product->status == 0 ? 1 : 0;
    
    
            // Update the status in the database
            DB::table('products')->where('id', $id)->update(['status' => $newStatus]);
    
            return redirect()->back()->with('success', 'Product status updated successfully');
        }
    
        return redirect()->back()->with('error', 'Product not found');
    }





}
