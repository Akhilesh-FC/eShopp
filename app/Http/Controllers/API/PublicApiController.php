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

class PublicApiController extends Controller
{
    public function search(?string $name)
    {
        // Split the input name into individual words
        $searchWords = explode(' ', $name);
        
        if (empty($searchWords[0])) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid search query',
                'data' => []
            ]);
        }
    
        // Get the first letter of the first word
        $firstLetter = substr($searchWords[0], 0, 1);
    
        // Fetch rows that start with the same first letter
        $allRows = DB::table('products')->where('name', 'LIKE', $firstLetter . '%')->get();
        $similarities = [];
    
        foreach ($allRows as $item) {
            // Split $item->name into individual words by spaces
            $itemWords = explode(' ', $item->name);
    
            // Initialize distances array
            $distances = [];
    
            // 1. Calculate Levenshtein distance for each word in the search query
            foreach ($searchWords as $searchIndex => $searchWord) {
                $minNormalizedDistance = PHP_INT_MAX; // Start with a large value
    
                // Compare with each word in the item name
                foreach ($itemWords as $itemWord) {
                    $levDistance = levenshtein($searchWord, $itemWord);
                    $normalizedDistance = $levDistance / max(strlen($searchWord), strlen($itemWord));
                    $minNormalizedDistance = min($minNormalizedDistance, $normalizedDistance);
                }
    
                // Store the minimum normalized distance for this search word
                $distances[$searchIndex][] = $minNormalizedDistance;
            }
    
            // After calculating distances, store them in a flattened format
            $item->distances = array_map(function($distanceArray) {
                sort($distanceArray); // Sort each word's distances
                return $distanceArray;
            }, $distances);
            $similarities[] = $item;
        }
    
        // 3. Sort the results based on the distances
        usort($similarities, function ($a, $b) {
            // Compare each set of sorted distances
            foreach ($a->distances as $index => $distanceArrayA) {
                $distanceArrayB = $b->distances[$index];
    
                // Compare sorted distances for each word
                foreach ($distanceArrayA as $key => $distanceA) {
                    if ($distanceA != $distanceArrayB[$key]) {
                        return $distanceA <=> $distanceArrayB[$key];
                    }
                }
            }
            return 0; // All distances are equal
        });
    
        // Get the top 30 most similar results
        $topSimilarities = array_slice($similarities, 0, 30);
    
        // Build the result collection from the top similar entries
        $resultRows = collect($topSimilarities);
    
        return response()->json([
            'success' => true,
            'message' => 'Results for search',
            'data' => $resultRows
        ]);
    }



    
    
    public function getProductsBySubcategory(Request $request)
    {
        $subcategoryId = $request->input('subcategory_id');
        $categoryId = $request->input('category_id'); // Category ID
    
        // Check if subcategory_id or category_id is provided
        if (!$subcategoryId && !$categoryId) {
            return response()->json([
                'success' => false,
                'message' => 'Subcategory ID or Category ID is required.',
            ], 200);
        }
    
        // You may need to get the user_id from the request if needed
        $userId = $request->input('user_id'); 
    
        $query = DB::table('products')
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id') // join with product_variants
            ->whereIn('products.is_vendor', [1]); // vendor-related filter, you can modify as needed
    
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
    
        // Retrieve the products
        $products = $query->get([
            'products.*', // all fields from the products table
            'product_variants.price',  // price from product_variants table
            'product_variants.special_price'  // special_price from product_variants table
        ]);
    
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

    
    // public function ProductDetails(Request $request)  
    // {
    //     $validator = Validator::make($request->all(), [  
    //         'product_id' => 'required'
    //     ]);
    //     $validator->stopOnFirstFailure(); 
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $validator->errors()->first()
    //         ], 200);
    //     }
    
    //     // Check if the product exists
    //     $product = DB::table('products')
    //         ->where('id', $request->product_id)
    //         ->select('products.*')
    //         ->first();
    
    //     if (empty($product)) {
    //         return response()->json([
    //             'success' => 'error',
    //             'message' => 'No product found for this product ID'
    //         ], 200);
    //     }
    
    //     // Fetch product details
        
    //         //first: get only one data, get: get multiple data
            
        
    //     // Fetch product variants
    //     $variants = DB::table('product_variants')
    //         ->where('product_id', $request->product_id)
    //         ->select(
    //             'special_price',
    //             'price',
    //             'percentage_off',
    //             'size',
    //             'color'
    //         )
    //         ->get();
    
    //     $userId = $request->input('user_id'); // Optional user ID
    //     $cartItems = [];
    //     $favoriteItems = [];
        
    //     if ($userId) {
    //         // Check if the product is added to the cart
    //         $cartItems = DB::table('cart')
    //             ->where('user_id', $userId)
    //             ->where('status', '0')
    //             ->pluck('product_id')
    //             ->toArray();
    
    //         // Check if the product is added to favorites
    //         $favoriteItems = DB::table('favorites')
    //             ->where('user_id', $userId)
    //             ->pluck('product_id')
    //             ->toArray();
    //     }
    
    //     $isAddedToCart = in_array($request->product_id, $cartItems) ? 1 : 0;
    //     $isAddedToFavorites = in_array($request->product_id, $favoriteItems) ? 1 : 0;
    
    //     $variant = $variants->first();
    
    //     // Merge product and variant data
    //     $productData = (object) array_merge((array) $product, (array) $variant);
    
    //     return response()->json([
    //         "success" => true,
    //         "is_added" => $isAddedToCart,  
    //         "is_added_to_fav" => $isAddedToFavorites,
    //         "data" => $productData 
    //     ], 200);
    // }
    
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
            'success' => 'error',
            'message' => 'No product found for this product ID'
        ], 200);
    }

    // Fetch product variants
    $variants = DB::table('product_variants')
        ->where('product_id', $request->product_id)
        ->select(
             'id',
            'special_price',
            'price',
            'percentage_off',
            'size',
            'color',
            'stock'
        )
        ->get();

    // Group variants by size
    $groupedVariants = $variants->groupBy('size');

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

        // Group colors for this size
        $colors = $variantsBySize->map(function ($variant) {
            return [
                'colorIndex' => $variant->color, // Assuming colorIndex is mapped to color field
                'colorName' => $variant->color, // Assuming colorName is the same as the color field
                'stock' => $variant->stock
            ];
        });

        return [
             'id' => $variantsBySize->first()->id,  // Size ID, assuming size is unique
            'Size' => $size,
            'price' => $price,
            'discount' => $discount,
            'specialPrice' => $specialPrice,
            'colors' => $colors
        ];
    });

    // Flatten the collection to an array
    $formattedVariants = $formattedVariants->values()->all();

    $variant = $variants->first();

    // Merge product and variant data
    $productData = (object) array_merge((array) $product, (array) $variant);

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

    // public function addToCart(Request $request)
    // {
    //     date_default_timezone_set('Asia/Kolkata');
    //     $datetime = now();
    //     // Validate the input data
    //     $validator = Validator::make($request->all(), [
    //         'product_id' => [
    //             'required',
    //             'exists:products,id', // Ensures the product exists in the products table
    //         ],
    //         'quantity' => [
    //             'required',
    //             'integer',
    //             'min:1|max:5', // Quantity must be at least 1
    //         ],
    //     ], [
    //         'product_id.required' => 'Product ID is required.',
    //         'product_id.exists' => 'The selected product does not exist.',
    //         'quantity.required' => 'Quantity is required.',
    //         'quantity.integer' => 'Quantity must be an integer.',
    //         'quantity.min' => 'Quantity must be at least 1.',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $validator->errors()->first(),
    //         ], 200);
    //     }
    
    //     // Get authenticated user ID
    //     $user = $request->user();
    //     if (!$user) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Unauthenticated. Please log in.',
    //         ], 200);
    //     }
    
    //     $userId = $user->id;
    //     $productId = $request->input('product_id');
    //     $quantity = $request->input('quantity');
    
    //     try {
    //         // Check if the product is already in the cart
    //         $cartItem = DB::table('cart')
    //             ->where('user_id', $userId)
    //             ->where('product_id', $productId)
    //             ->first();
    
    //         if ($cartItem) {
    //             // Update quantity if product exists in the cart
    //             DB::table('cart')
    //                 ->where('id', $cartItem->id)
    //                 ->update([
    //                     'quantity' => $cartItem->quantity + $quantity,
    //                     'updated_at' => $datetime,
    //                 ]);
    
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Product quantity updated in the cart.',
    //             ], 200);
    //         } else {
    //             // Insert new product into the cart
    //             DB::table('cart')->insert([
    //                 'user_id' => $userId,
    //                 'product_id' => $productId,
    //                 'quantity' => $quantity,
    //                 'created_at' => $datetime,
    //                 'updated_at' => $datetime,
    //             ]);
    
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Product added to the cart successfully.',
    //             ], 200);
    //         }
    //     } catch (\Exception $e) {
    //         // Catch and handle unexpected errors
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred while adding the product to the cart. Please try again.',
    //             'error' => $e->getMessage(),
    //         ], 200);
    //     }
    // }
    
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

   


    
    
    
    
    

}
