<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;


class PublicApiController extends Controller
{
    public function universalSearch(Request $request)
    {
    $searchTerm = $request->input('search');

    $query = DB::table('products')->select('products.*');

    if ($searchTerm) {
        $columns = Schema::getColumnListing('products'); 
        $query->where(function ($query) use ($columns, $searchTerm) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', '%' . $searchTerm . '%');
            }
        });
    }
    else {
            $query->where('status', '=', 1); 
        }

    $products = $query->orderBy('name', 'asc')->get();

    return response()->json([
        'success' => true,
        'message' => 'Search results from products table',
        'data' => $products
    ], 200);
}
    
    public function getProductsBySubcategory(Request $request)
    {
        $subcategoryId = $request->input('subcategory_id');
        $categoryId = $request->input('category_id'); // Category ID
        $sortBy = $request->input('sort_by'); 
    
        // Check if subcategory_id or category_id is provided
        if (!$subcategoryId && !$categoryId) {
            return response()->json([
                'success' => false,
                'message' => 'Subcategory ID or Category ID is required.',
            ], 200);
        }
    
        // You may need to get the user_id from the request if needed
        $userId = $request->input('user_id'); 
    
        // Start building the query
        $query = DB::table('products')
            ->join('product_variants', function ($join) {
                // Subquery to get the first variant for each product
                $join->on('products.id', '=', 'product_variants.product_id')
                    ->whereRaw('product_variants.id = (SELECT MIN(id) FROM product_variants WHERE product_variants.product_id = products.id)');
            })
            ->whereIn('products.is_vendor', [1])
            ->distinct('products.id') // Ensure we get distinct products
            ->orderBy('products.id', 'asc') // Ordering by 'products.id' or another field as needed
    
         ->when($sortBy, function ($query, $sortBy) {
            switch ($sortBy) {
                case 1:
                    return $query->orderByDesc('products.rating');
                case 2:
                    return $query->orderByDesc('products.created_at');
                case 3:
                    return $query->orderBy('products.created_at');
                case 4:
                    return $query->orderBy('product_variants.price');
                case 5:
                    return $query->orderByDesc('product_variants.price');
                default:
                    return $query;
            }
        });

    
        if ($subcategoryId) {
            // If subcategory_id is provided, filter by subcategory
            $query->where('products.subcategory', $subcategoryId);
        }
    
        if ($categoryId) {
            // If category_id is provided, get products of all subcategories under this category
            $query->whereIn('products.subcategory', function ($subQuery) use ($categoryId) {
                $subQuery->select('id')
                    ->from('subcategories')
                    ->where('category_id', $categoryId);
            });
        }
    
        // Get the first variant for each product
        $products = $query->select(
            'products.*', 
            'product_variants.price', 
            'product_variants.special_price'
        )
        ->get();
    
        $cartItems = [];
        $favoriteItems = [];
        if ($userId) {
            $cartItems = DB::table('cart')
                ->where('user_id', $userId)
                ->get(['product_id', 'quantity', 'status'])
                ->keyBy('product_id')
                ->map(function($item) {
                    return [
                        'quantity' => $item->quantity,
                        'status' => $item->status 
                    ]; 
                });
    
            $favoriteItems = DB::table('favorites')
                ->where('user_id', $userId)
                ->pluck('product_id')
                ->toArray();
        }
    
        // Modify products based on cart and favorite data
        $products = $products->map(function ($product) use ($cartItems, $favoriteItems, $userId) {
            $product->is_added_to_cart = 0;
            $product->quantity_in_cart = 0;
            $product->is_added_to_fav = 0;
    
            if ($userId) {
                // Check if the product is in the cart
                $cartItem = $cartItems->get($product->id);
                
                if ($cartItem) {
                    // If the cart item status is 1 (checked out), set cart quantity and added to cart status to 0
                    if ($cartItem['status'] == 1) {
                        $product->is_added_to_cart = 0;
                        $product->quantity_in_cart = 0;
                    } else {
                        // If the cart item status is 0, return the quantity and set 'added to cart' status
                        $product->is_added_to_cart = 1;
                        $product->quantity_in_cart = $cartItem['quantity'];
                    }
                }
    
                // Check if the product is in the favorites
                $product->is_added_to_fav = in_array($product->id, $favoriteItems) ? 1 : 0;
            }
    
            return $product;
        });
    
        if ($products->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No products found for this subcategory or category.',
            ], 200);
        }
    
        return response()->json([
            'success' => true,
            'data' => $products,
        ], 200);
    }
    
   public function ProductDetails(Request $request)  
    {
        $validator = Validator::make($request->all(), [  
            'product_id' => 'required'
        ]);
        $validator->stopOnFirstFailure(); 
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }
    
        // Check if the product exists
        $product = DB::table('products')
            ->where('id', $request->product_id)
            ->select('products.*')
            ->first();
    
        if (empty($product)) {
            return response()->json([
                'success' => false,
                'message' => 'No product found for this product ID'
            ], 200);
        }
    
        // Fetch product variants
        $variants = DB::table('product_variants')
            ->leftJoin('color', 'product_variants.color_index', '=', 'color.id')
            ->where('product_variants.product_id', $request->product_id)
            ->select(
                'product_variants.id',  
                'product_variants.special_price',
                'product_variants.price',
                'product_variants.percentage_off',
                'product_variants.size',
                'product_variants.color',
                'product_variants.color_index',
                'product_variants.stock',
                'color.name as color_name',
                'color.color as color_hex'
            )
            ->get();
    //dd($variants);
        $groupedVariants = $variants->groupBy('size');
    
        $colorHex = $variants->pluck('color_hex')->first();
    
        $userId = $request->input('user_id'); // Optional user ID
        $cartItems = [];
        $favoriteItems = [];
    
        if ($userId) {
            // Check if the product is added to the cart
            $cartItems = DB::table('cart')
                ->where('user_id', $userId)
                ->where('status', '0')
                ->pluck('product_id')
                ->toArray();
    
            // Check if the product is added to favorites
            $favoriteItems = DB::table('favorites')
                ->where('user_id', $userId)
                ->pluck('product_id')
                ->toArray();
        }
    
        $isAddedToCart = in_array($request->product_id, $cartItems) ? 1 : 0;
        $isAddedToFavorites = in_array($request->product_id, $favoriteItems) ? 1 : 0;
    
        // Prepare the response structure for variants with sizes and colors
        $formattedVariants = $groupedVariants->map(function ($variantsBySize) {
            $size = $variantsBySize->first()->size; 
            $price = $variantsBySize->first()->price;
            $specialPrice = $variantsBySize->first()->special_price;
            $discount = $variantsBySize->first()->percentage_off;
    
            $colorsForSize = $variantsBySize->map(function ($variant) {
                return [
                    'colorId' => $variant->color_index, // Color ID from the variant
                    'colorName' => $variant->color_name, // Color name from the color table
                    'colorCode' => $variant->color_hex, // Color hex code
                    'stock' => $variant->stock // Stock for the color variant
                ];
            });
    
            return [
                'id' => $variantsBySize->first()->id,  // Variant ID (from product_variants table)
                'Size' => $size,
                'price' => $price,
                'discount' => $discount,
                'specialPrice' => $specialPrice,
                'colors' => $colorsForSize
            ];
        });
    
        $formattedVariants = $formattedVariants->values()->all(); // Get the array values from the collection
    
        // Get the first variant (You may need more data from variants)
        $variant = $variants->first(); 
    
        // Merge product and variant data, and include formattedVariants properly
        // Ensure the product ID is set correctly here
        $productData = (object) array_merge((array) $product, [
            'id' => $product->id, // Correctly assign the product ID here
            'price' => $variant->price, // Add price from first variant
            'percentage_off' => $variant->percentage_off, // Add discount from first variant
            'special_price' => $variant->special_price,
        ]);
    
        return response()->json([
            "success" => true,
            "is_added" => $isAddedToCart,
            "is_added_to_fav" => $isAddedToFavorites,
            "data" => $productData,
            "variants" => $formattedVariants // Returning the grouped variants
        ], 200);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string|unique:users,mobile',
            
        ]);
        
        $mobile = $request->mobile;
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }

        $user = DB::table('users')->insert([
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $mobile,
            'image' => 'https://free2kart.mobileappdemo.net/public/profileimage/default.png',
        //   'image' => "profileimage/1.png",
            //'image' => null,

            
        ]); 
        if ($user) {
            $userss = DB::table('users')->where('mobile', $mobile)->first();
            $id=$userss->id;
           // dd($id);
            return response()->json([
                'data'=> $id,
                'success' => true,
                'message' => 'Registration successful.',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed',
            ], 200);
        }
    }
   
    public function getProfile($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:users,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid user ID.',
            ], 200);
        }
    
        Log::info("Received ID: $id");
    
        $user = DB::table('users')
            ->select('id', 'mobile', 'username', 'email', 'image', 'active')
            ->where('id', $id)
            ->first();
    
        Log::info("Fetched User: " . json_encode($user));
    
        if ($user) {
            // Check if the user is active (status = 1)
            if ($user->active == 1) {
                return response()->json([
                    'success' => true,
                    'status_message' => 'User is active.',
                    'active'=> 1,
                    'data' => $user,
                    
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'active' => 0,
                    'message' => 'User is inactive.',
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 200);
        }
    }
    
    public function updateProfile(Request $request)
    {
        $userId = $request->input('id');
    
        $user = DB::table('users')
            ->where('id', $userId)
            ->select('id', 'username', 'email', 'image') // Ensure 'image' column is included
            ->first();
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 200);
        }
    
        // Validate the input fields
        $validator = Validator::make($request->all(), [
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $userId,
            'profileimage' => 'nullable|image|max:2048', // For uploaded image
            'image_base64' => 'nullable|string',         // For base64-encoded image
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first()
            ], 200);
        }
    
        $baseUrl = env('APP_URL', 'https://free2kart.mobileappdemo.net/') . '/public/';
     // Base URL for constructing image path
        $input = collect($request->only(['username', 'email']))
            ->filter(function ($value) {
                return $value !== null;
            })->toArray();
    
        // Handle uploaded file (if provided)
        if ($request->hasFile('profileimage')) {
            // Delete old image if exists
            if (!empty($user->image) && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
    
            $file = $request->file('profileimage');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profileimage'), $fileName);
    
            $input['image'] = 'profileimage/' . $fileName; // Relative path
        }
    
        // Handle base64 image (if provided)
        if ($request->input('image_base64')) {
            // Decode and store the image
            $imageData = base64_decode($request->input('image_base64'));
            $imageName = 'profileimage/' . uniqid() . '.png'; // Unique name
    
            file_put_contents(public_path($imageName), $imageData);
    
            // Delete old image if exists
            if (!empty($user->image) && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
    
            $input['image'] = $baseUrl.$imageName; // Relative path
        }
    
        // Check if there is any data to update
        if (empty($input)) {
            return response()->json([
                'success' => false,
                'message' => 'No data provided to update.'
            ], 200);
        }
    
        // Update the user's profile with the provided data
        DB::table('users')
            ->where('id', $userId)
            ->update($input);
    
        // Fetch the updated user data
        $updatedUser = DB::table('users')
            ->where('id', $userId)
            ->select('id', 'username', 'email', 'image') // Specify fields to return
            ->first();
    
        // Append the base URL to the image path, if an image exists
        if (!empty($updatedUser->image)) {
            $updatedUser->image = $baseUrl . '/' . $updatedUser->image;
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            // 'user' => $updatedUser
        ], 200);
    }
  
    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 2,
                'message' => $validator->errors()->first(),
            ], 200);
        }
    
        // Check if the user exists
        $user = DB::table('users')->where('mobile', $request->mobile)->first();
    
        // Check if user exists
        if ($user) {
            $login_status = $user->active;  // Now safe to access $user->active
    
            if ($login_status == 1) {
                return response()->json([
                    'success' => true,
                    'status' => 0,
                    'active'=> 1,
                    'message' => 'Login successful.',
                    'data' => $user->id,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'status' => 1,
                    'active' => 0,
                    'message' => 'You are blocked by admin. Please contact the admin.',
                ], 200);
            }
        } else {
            // User not found
            return response()->json([
                'success' => false,
                'status' => 1,
                'message' => 'You are not registered. Please register first.',
            ], 200);
        }
    }

    public function showSliders()
    {
        $sliders = DB::table('sliders')->select('id', 'image', 'date_added')->get();
        
        return response()->json([
            'success' => true,
            'data' => $sliders,
        ], 200);
    }

    public function showCategories()
    {
        $categories = DB::table('categories')
            ->select('id', 'name', 'image')
            ->where('status',1)
            ->get();
        return response()->json([
            'success' => true,
            'data' => $categories,
        ], 200);
    }

    public function subcategories(Request $request)
    {
    // Fetch category_id from the request
    $categoryId = $request->input('category_id'); 

    // Validate if category_id is provided
    if (!$categoryId) {
        return response()->json([
            'success' => false,
            'message' => 'Category ID is required.',
        ], 200);
    }

    // Fetch categories based on category_id
    $categories = DB::table('categories')
        ->where('id', $categoryId) // Filter categories by category_id
        ->get();

    // Initialize an array to store the categories with their subcategories and sub-subcategories
    

    foreach ($categories as $category) {
        // Fetch subcategories for each category
        $subcategories = DB::table('subcategories')
            ->where('category_id', $category->id) // Get subcategories by category_id
            ->get(['id', 'name', 'image', 'category_id']);

        // For each subcategory, fetch sub-subcategories from `sub_categories2`
        foreach ($subcategories as $subcategory) {
            $subSubcategories = DB::table('sub_categories2')
                ->where('sub_categories_id', $subcategory->id) // Match sub_categories_id with subcategory ID
                ->get(['id', 'sub_categories_id','name','images']); // Fetch relevant fields
            
            // // Attach sub-subcategories to the subcategory
             $subcategory->sub_subcategories = $subSubcategories;
        }

        // Prepare the category data with its subcategories and sub-subcategories
        $categoryData = [
            'id' => $category->id,
            'name' => $category->name,
            'image' => $category->image, // Include category image if required
            'category_name' => $category->name,
            'sub_category' => $subcategories // Attach subcategories with their sub-subcategories
            
        ];

        // Add the category data to the response array
        $categoriesWithSubcategories = $categoryData;
    }

        // Return the final response
        return response()->json([
            'success' => true,
            'data' => $categoriesWithSubcategories,
        ], 200);
    }
    
    public function FAQs()
    {
        $faqs = DB::table('faqs')->select('question', 'answer')->get();
    
        if ($faqs->isNotEmpty()) {
            return response()->json([
                'message' => 'Successfully fetched',
                'status' => 200,
                'data' => $faqs
            ]);
        } else {
            return response()->json([
                'message' => 'No record found',
                'status' => 200,
                'data' => []
            ], 200);
        }
    }

    public function about_us(Request $request)
    {
        $about_us = $request->about;
        $about_us = DB::select("SELECT `variable`, `value` FROM `settings` WHERE `variable` = 'about_us'");
        if ($about_us) {
            $response = [
                'message' => 'Successfully',
                'status' => 200,
                'data' => $about_us
            ];
            return response()->json($response);
        } else {
            return response()->json(['message' => 'No record found', 'status' => 400,
                'data' => []], 400);
        }
    }
    
    public function contact_us(Request $request)
    {
        $contact_us = DB::table('settings')->select('variable', 'value')->where('variable', 'contact_us')->first(); 
    
        if ($contact_us) {
            return response()->json([
                'message' => 'Successfully fetched',
                'status' => 200,
                'data' => $contact_us
            ]);
        } else {
            return response()->json([
                'message' => 'No record found',
                'status' => 400,
                'data' => null
            ], 400);
        }
    }
    
    public function Privacy_Policy()
    {
        $privacyPolicy = DB::table('settings')->select('variable', 'value')->where('variable', 'privacy_policy')->first();

        if ($privacyPolicy) {
           return response()->json([
               'message'=> 'Successfuly fetched',
               'status'=> 200,
               'data'=> $privacyPolicy
           ]);

        } else {
            return response()->json(['message' => 'No record found',
            'status' => 400,
            'data' => []], 400);
        }
    }
    
    public function Return_Policy()
    {
        $returnPolicy = DB::table('settings')->select('variable', 'value')->where('variable', 'return_policy')->first();
        if ($returnPolicy) {
           return response()->json([
               'message'=> 'Successfuly fetched',
               'status'=> 200,
               'data'=> $returnPolicy
           ]);

        } else {
            return response()->json(['message' => 'No record found',
            'status' => 400,
            'data' => []], 400);
        }
    }
    
    public function Shipping_Policy()
    {
        $shippingPolicy = DB::table('settings')->select('variable', 'value')->where('variable', 'shipping_policy')->first();
        if ($shippingPolicy) {
           return response()->json([
               'message'=> 'Successfuly fetched',
               'status'=> 200,
               'data'=> $shippingPolicy
           ]);
           
        } else {
            return response()->json(['message' => 'No record found',
            'status' => 400,
            'data' => []], 400);
        }
    }
    
    public function Terms_Condition()
    {
        $termcondition = DB::table('settings')->select('variable', 'value')->where('variable', 'terms_conditions')->first();
   
        if ($termcondition){
            return response()->json(
                [
                    'message' => 'Successfuly fetched',
                    'status' => 200,
                    'data' => $termcondition
                    ]);
        }else{
            return response()->json(['message' => 'No record found',
            'status' => 400,
            'data' => []], 400);
        }
    }

   
   
//   public function ProductDetails(Request $request)  
//     {
//         $validator = Validator::make($request->all(), [  
//             'product_id' => 'required'
//         ]);
//         $validator->stopOnFirstFailure(); 
    
//         if ($validator->fails()) {
//             return response()->json([
//                 'success' => false,
//                 'message' => $validator->errors()->first()
//             ], 200);
//         }
    
//         // Check if the product exists
//         $product = DB::table('products')
//             ->where('id', $request->product_id)
//             ->select('products.*')
//             ->first();
    
//         if (empty($product)) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'No product found for this product ID'
//             ], 200);
//         }
    
//         // Fetch product variants
//         $variants = DB::table('product_variants')
//             ->leftJoin('color', 'product_variants.color_index', '=', 'color.id')
//             ->where('product_variants.product_id', $request->product_id)
//             ->select(
//                 'product_variants.id',  
//                 'product_variants.special_price',
//                 'product_variants.price',
//                 'product_variants.percentage_off',
//                 'product_variants.size',
//                 'product_variants.color',
//                 'product_variants.color_index',
//                 'product_variants.stock',
//                 'color.name as color_name',
//                 'color.color as color_hex'
//             )
//             ->get();
        
//         $groupedVariants = $variants->groupBy('size');
        
//         // Fetch color hex from the first variant
//         $colorHex = $variants->pluck('color_hex')->first();
    
//         $userId = $request->input('user_id'); // Optional user ID
//         $cartItems = [];
//         $favoriteItems = [];
    
//         if ($userId) {
//             // Check if the product is added to the cart
//             $cartItems = DB::table('cart')
//                 ->where('user_id', $userId)
//                 ->where('status', '0')
//                 ->pluck('product_id')
//                 ->toArray();
    
//             // Check if the product is added to favorites
//             $favoriteItems = DB::table('favorites')
//                 ->where('user_id', $userId)
//                 ->pluck('product_id')
//                 ->toArray();
//         }
    
//         $isAddedToCart = in_array($request->product_id, $cartItems) ? 1 : 0;
//         $isAddedToFavorites = in_array($request->product_id, $favoriteItems) ? 1 : 0;
    
//         // Prepare the response structure for variants with sizes and colors
//         $formattedVariants = $groupedVariants->map(function ($variantsBySize) {
//             $size = $variantsBySize->first()->size;
//             $price = $variantsBySize->first()->price;
//             $specialPrice = $variantsBySize->first()->special_price;
//             $discount = $variantsBySize->first()->percentage_off;
    
//             $colorsForSize = $variantsBySize->map(function ($variant) {
//                 return [
//                     'colorId' => $variant->color_index, // Color ID from the variant
//                     'colorName' => $variant->color_name, // Color name from the color table
//                     'colorCode' => $variant->color_hex, // Color hex code
//                     'stock' => $variant->stock // Stock for the color variant
//                 ];
//             });
    
//             return [
//                 'id' => $variantsBySize->first()->id,  // Variant ID, assuming each variant has a unique ID   product id chane insaat of id 
//                 'Size' => $size,
//                 'price' => $price,
//                 'discount' => $discount,
//                 'specialPrice' => $specialPrice,
//                 'colors' => $colorsForSize
//             ];
//         });
    
//         $formattedVariants = $formattedVariants->values()->all(); // Get the array values from the collection
        
//         // Get the first variant (You may need more data from variants)
//         $variant = $variants->first(); 
    
//         // Merge product and variant data, and include formattedVariants properly
//         $productData = (object) array_merge((array) $product, (array) $variant);
    
//         return response()->json([
//             "success" => true,
//             "is_added" => $isAddedToCart,
//             "is_added_to_fav" => $isAddedToFavorites,
//             "data" => $productData,
//             "variants" => $formattedVariants // Returning the grouped variants
//         ], 200);
//     }


    
    
    
    
    

}
