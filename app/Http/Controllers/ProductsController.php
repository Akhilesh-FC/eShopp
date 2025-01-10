<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
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
            'subcategory_id' => 'required|exists:subcategories,id',
            'short_description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required',
            'made_in' => 'required',
            'product_highlight' => 'required',
            'description' => 'required',
            'product_color' => 'required',
            'product_size' => 'required',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric|min:0|lte:price',
            'percentage_off' => 'nullable|numeric|min:0|max:100',
            'cod_allowed' => 'nullable|in:0,1',
            'is_returnable' => 'nullable|in:0,1',
            'is_cancelable' => 'nullable|in:0,1',
        ]);
    //dd($request->cod_allowed);
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
        ]);
    
        // Insert product variant data (color, size, price)
        DB::table('product_variants')->insert([
            'product_id' => $productId, 
            'color' => $request->product_color,  // Fixed to use request value
            'size' => $request->product_size,    // Fixed to use request value
            'price' => $request->price,
            'special_price' => $request->special_price,
            'percentage_off' => $request->percentage_off,
        ]);
    
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
