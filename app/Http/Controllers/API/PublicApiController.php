<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PublicApiController extends Controller
{

    public function ProductDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }
    
        // Check if the product ID exists in the product_variants table
        $variantExists = DB::table('products')
            ->where('id', $request->product_id)
            ->exists();
    
        if (!$variantExists) {
            return response()->json([
                'status' => 'error',
                'message' => 'No variants found for this product ID'
            ], 200);
        }
    
        // Fetch the product details
        $product = DB::table('products')
            ->where('id', $request->product_id)
            ->select(
                'id as product_id',
                'name',
                'rating',
                'made_in',
                'stock',
                'availability',
                'no_of_ratings',
                'item_to_sell',
                'in_day_to_sell',
                'product_highlight'
            )
            ->first(); // Fetch a single product record
    
        // Fetch all variants for the product
        $variants = DB::table('product_variants')
            ->where('product_id', $request->product_id)
            ->select(
                'special_price',
                'price',
                'percentage_off',
                'size',
                'color'
            )
            ->get();
    
        // Combine product details with its variants
        $product->variants = $variants;
    
        // Return the product details along with its variants
        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    public function Token(Request $request)
    {
       
        $request->validate([
            'token' => 'required|string',
         ]);
        $token = $request->token;

        $userUpdated = DB::table('users')->insert([
            'token' => $token
            ]
        );

        if ($userUpdated) {
            return response()->json([
                'message' => 'Token stored successfully.',
                'success' => true,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to store the token.',
                'success' => false,
            ], 200);
        }
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
            'image' => 'https://eshop.foundercode.org/public/profileimage/1.png',
            
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
            ], 400);
        }
    
        // Check if the user exists
        $user = DB::table('users')->where('mobile', $request->mobile)->first();
    
        if ($user) {
            // Generate and send OTP
            $otp = rand(100000, 999999);
            // Example: Call your OTP service here
            // Http::post('your-otp-api-endpoint', ['otp' => $otp, 'mobile' => $request->mobile]);
    
            return response()->json([
                'success' => true,
                'status' => 0,
                'message' => 'OTP sent successfully.',
                'data' => $user->id,
            ], 200);
        } else {
            // User not registered
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
        ], 400);
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
    

    public function getProductsBySubcategory(Request $request)
    {
    // Fetch subcategory_id from the request (query parameters or request body)
    $subcategoryId = $request->input('subcategory_id'); 

    // Validate if subcategory_id is provided
    if (!$subcategoryId) {
        return response()->json([
            'success' => false,
            'message' => 'Subcategory ID is required.',
        ], 200);
    }

    // Define base URL for images
    $baseUrl = env('APP_URL'); 

    // Fetch products that match the subcategory_id along with price and special_price from product_variants
    $products = DB::table('products')
         ->join('sub_categories2', 'products.category_id', '=', 'sub_categories2.sub_categories_id') 
        ->join('product_variants', 'products.id', '=', 'product_variants.product_id') // Join with product_variants table
        ->where('products.category_id', $subcategoryId) // Filter by subcategory_id
         ->orWhere('sub_categories2.id', $subcategoryId)
        ->get([
            'products.*',
            
            'product_variants.price', // Fetch price from product_variants
            'product_variants.special_price' // Fetch special price from product_variants
        ]); // Select relevant fields

    // Check if products are found
    if ($products->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No products found for this subcategory.',
        ], 200);
    }

    // Return the products data as a list
    return response()->json([
        'success' => true,
        'data' => $products,
    ], 200);
    }

    public function addToCart(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'product_id' => [
                'required',
                'exists:products,id', // Ensures the product exists in the products table
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1|max:5', // Quantity must be at least 1
            ],
        ], [
            'product_id.required' => 'Product ID is required.',
            'product_id.exists' => 'The selected product does not exist.',
            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.min' => 'Quantity must be at least 1.',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }
    
        // Get authenticated user ID
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated. Please log in.',
            ], 401);
        }
    
        $userId = $user->id;
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        try {
            // Check if the product is already in the cart
            $cartItem = DB::table('cart')
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();
    
            if ($cartItem) {
                // Update quantity if product exists in the cart
                DB::table('cart')
                    ->where('id', $cartItem->id)
                    ->update([
                        'quantity' => $cartItem->quantity + $quantity,
                        'updated_at' => now(),
                    ]);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Product quantity updated in the cart.',
                ], 200);
            } else {
                // Insert new product into the cart
                DB::table('cart')->insert([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Product added to the cart successfully.',
                ], 201);
            }
        } catch (\Exception $e) {
            // Catch and handle unexpected errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the product to the cart. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getProfile($id)
    {
        // Debugging: Log the incoming ID
        \Log::info("Received ID: $id");
    
        $user = DB::table('users')
            ->select('id', 'mobile', 'username', 'email', 'image')
            ->where('id', $id)
            ->first();
    
        // Debugging: Log the fetched user
        \Log::info("Fetched User: " . json_encode($user));
    
        if ($user) {
            return response()->json([
                'success' => true,
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 400);
        }
    }

    public function updateProfile(Request $request)
    {
        $userId = $request->input('id');
    
        // Check if the user exists
        $user = DB::table('users')
            ->where('id', $userId)
            ->select('id', 'username', 'email', 'image') // Ensure 'image' column is included
            ->first();
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 400);
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
    
        $baseUrl = env('APP_URL', 'https://eshop.foundercode.org') . '/public';
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
    
            $input['image'] = $imageName; // Relative path
        }
    
        // Check if there is any data to update
        if (empty($input)) {
            return response()->json([
                'success' => false,
                'message' => 'No data provided to update.'
            ], 400);
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
            ], 400);
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
