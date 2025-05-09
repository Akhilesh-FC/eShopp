<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function view_product_details($id)
    {
        // Fetch the product details using DB facade
        $products = DB::table('products')
                    ->where('id', $id)
                    ->get(); // Using first() to get a single record
    
        // Fetch related variants
        $variants = DB::table('product_variants')
                    ->where('product_variants.product_id', $id)
                    ->join('size', 'product_variants.size', '=', 'size.id')  // join on size_id and id of sizes table
                    ->join('color', 'product_variants.color', '=', 'color.id') // join on color_id and id of colors table
                    ->select('product_variants.*', 'size.size as size_name', 'color.name as color_name')
                    ->get();
    
        // // Fetch images related to the product
        // $images = DB::table('product_images') 
        //             ->where('product_id', $id)
        //             ->get();
    
        // Pass data to the view
        return view('products.manageproducts', compact('products', 'variants'));
    }

    
    public function showAddProductForm(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        
        $colors =DB::table('color')->get();
        $sizes =DB::table('size')->get();
    
        // Fetch products with the 'status' column (0 for active, 1 for inactive)
        $products = DB::table('products')
            ->select('id', 'name', 'status') 
            ->paginate($perPage);
        $categories = DB::table('categories')->select('id', 'name')->get();
    
        return view('products.addproducts', compact('products', 'perPage', 'categories','colors','sizes'));
    }
    
    
    
    public function getSubcategories($categoryId)
    {
        $subcategories = DB::table('subcategories')
            ->where('category_id', $categoryId)
            ->select('id', 'name')
            ->get();
    
        return response()->json(['subcategories' => $subcategories]);
    }
    
    public function storeProduct(Request $request)
    {
        \Log::info('Product Data:', $request->all());
    
        // Validate the request data
        $validated = $request->validate([
            'product_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',  // Optional as it may be omitted
            'short_description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required',
            'made_in' => 'required',
            'product_highlight' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric|min:0|lte:price',
            'percentage_off' => 'nullable|numeric|min:0|max:100',
            'cod_allowed' => 'nullable|in:0,1',
            'is_returnable' => 'nullable|in:0,1',
            'is_cancelable' => 'nullable|in:0,1',
            'variants.*.size' => 'required|exists:size,id',
            'variants.*.color' => 'required|exists:color,id',
            'variants.*.quantity' => 'required|numeric|min:1',
            'total_allowed_quantity' => 'nullable|numeric|min:0',
            'minimum_order_quantity' => 'nullable|numeric|min:1',
        ]);
    
        // Path to save product images
        $folderPath = public_path('product/');
    
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
    
        $imageUrls = [];
        
        // Save images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($folderPath, $imageName);
                $imageUrl = url('product/' . $imageName);
                $imageUrls[] = $imageUrl;
            }
        }
    
        // Insert product data
        $productId = DB::table('products')->insertGetId([
            'name' => $request->product_name,
            'category_id' => $request->category_id,
            'subcategory' => $request->subcategory_id,
            'short_description' => $request->short_description,
            'image' => json_encode($imageUrls),
            'tags' => $request->tags,
            'made_in' => $request->made_in,
            'product_highlight' => $request->product_highlight,
            'description' => $request->description,
            'cod_allowed' => $request->cod_allowed,
            'is_returnable' => $request->is_returnable,
            'is_cancelable' => $request->is_cancelable,
            'total_allowed_quantity' => $request->total_allowed_quantity,
            'minimum_order_quantity' => $request->minimum_order_quantity,
        ]);
    
        // Insert product variants (size, color, quantity)
        // Insert product variants (size, color, quantity)
        foreach ($request->variants as $variant) {
        
        \Log::info('Processing variant:', ['variant' => $variant]);

            // Fetch the size based on the size ID
            $size = DB::table('size')->where('id', $variant['size'])->first();
            \Log::info('Fetched size:', ['size' => $size]);
            
            // Fetch the color based on the color ID
            $color = DB::table('color')->where('id', $variant['color'])->first();
        
            // Check if the size and color exist and have the 'name' property
            if ($size && $color) {
                // Insert the variant data
                DB::table('product_variants')->insert([
                    'product_id' => $productId,  // Insert the product ID
                    'size' => $size->name ?? 'N/A',       // Insert the size name if it exists, else 'N/A'
                    'color' => $color->name ?? 'N/A',     // Insert the color name if it exists, else 'N/A'
                    'color_index' => $color->id,          // Insert the color ID in the color_index column
                    'stock' => $variant['quantity'],      // Insert the stock quantity
                    'price' => $request->price,           // Insert the regular price
                    'special_price' => $request->special_price,  // Insert the special price (if any)
                    'percentage_off' => $request->percentage_off,  // Insert the percentage off (if any)
                ]);
            } else {
                \Log::error("Invalid size or color for product variant", ['size_id' => $variant['size'], 'color_id' => $variant['color']]);
                return redirect()->back()->withErrors("Invalid size or color selected.");
            }
        }
        
        
        return redirect()->route('manage_products')->with('success', 'Product added successfully!');
    }
        
            
    public function manageProducts(Request $request)
    {
        $search = $request->input('search');
        
        $perPage = $request->input('per_page', 5);
        
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.id', 'products.name', 'products.image', 'products.brand', 'products.rating', 'products.no_of_ratings', 'products.status', 'categories.name as category_name')
            // Apply search filter if a search term is provided
            ->when($search, function($query) use ($search) {
                return $query->where('products.name', 'like', '%'.$search.'%')
                             ->orWhere('categories.name', 'like', '%'.$search.'%');
            })
            // Paginate the results
            ->paginate($perPage);
        
        // Return the view with the products
        return view('products.manageproducts', compact('products'));
    }


    public function updateRating(Request $request, $id)
    {
        $rating = $request->input('rating');
        $no_of_ratings = $request->input('no_of_ratings');
    
        $product = DB::table('products')->where('id', $id)->first();
    
        if ($product) {
            $updateData = [];
    
            if ($rating) {
                $updateData['rating'] = $rating;
            }
            
            if ($no_of_ratings) {
                $updateData['no_of_ratings'] = $no_of_ratings;
            }
    
            if (!empty($updateData)) {
                DB::table('products')
                    ->where('id', $id)
                    ->update($updateData);
    
                return redirect()->back()->with('success', 'Ratings updated successfully.');
            }
    
            return redirect()->back()->with('error', 'No data to update.');
        }
    
        return redirect()->back()->with('error', 'No product found with this ID.');
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
