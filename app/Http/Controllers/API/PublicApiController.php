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
    
//     public function subcategories(Request $request)
//     {
//     // You can filter by category_id if needed. 
//     // For example, to fetch subcategories for a specific category:
//     $categoryId = $request->input('category_id'); // Get category_id from query parameters or request body

//     // Fetch data by joining categories and subcategories, optionally filter by category_id
//     $query = DB::table('subcategories')
//         ->join('categories', 'categories.id', '=', 'subcategories.category_id') // Join the tables
//         ->select('subcategories.id', 'subcategories.name', 'subcategories.image', 'categories.name as category_name'); // Select relevant fields from both tables

//     // If a category_id is provided, filter the results by that category_id
//     if ($categoryId) {
//         $query->where('subcategories.category_id', '=', $categoryId);
//     }

//     // Execute the query and fetch the results
//     $subcategories = $query->get();

//     // Return the response with subcategory data
//     return response()->json([
//         'success' => true,
//         'data' => $subcategories,
//     ], 200);
// }

    public function subcategories(Request $request)
    {
        // Fetch category_id from the request (either query parameters or request body)
        $categoryId = $request->input('category_id'); // Get category_id from request body
    
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
    
        // Initialize an empty array to store the categories and subcategories
        $categoriesWithSubcategories = [];
    
        foreach ($categories as $category) {
            // Fetch subcategories for each category
            $subcategories = DB::table('subcategories')
                ->where('category_id', $category->id) // Get subcategories by category_id
                ->get(['id', 'name', 'image', 'category_id']);
    
            // Prepare the category data with its subcategories
            $categoryData = [
                'id' => $category->id,
                'name' => $category->name,
                'image' => $category->image, // You can return category image if required
                'category_name' => $category->name,
                'sub_category' => $subcategories // Attach the subcategories
            ];
    
            // Add the category data to the response array
            $categoriesWithSubcategories[] = $categoryData;
        }
    
        // Return the final response
        return response()->json([
            'success' => true,
            'data' => $categoriesWithSubcategories,
        ], 200);
    }
    
    public function getProductsByCategory(Request $request)
    {
        // Fetch category_id from the request (either query parameters or request body)
        $categoryId = $request->input('category_id'); // Get category_id from request body or query params
    
        // Validate if category_id is provided
        if (!$categoryId) {
            return response()->json([
                'success' => false,
                'message' => 'Category ID is required.',
            ], 400);
        }
    
        // Fetch products that match the category_id
        $products = DB::table('products')
            ->where('category_id', $categoryId) // Filter products by category_id
            ->get(['id', 'name', 'description', 'image', 'category_id']); // Select relevant fields
    
        // Check if products are found
        if ($products->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No products found for this category.',
            ], 404);
        }
    
        // Return the products data
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
                'min:1', // Quantity must be at least 1
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

//   public function updateProfile(Request $request)
//     {
//         // Validate the incoming request
//         $validator = Validator::make($request->all(), [
//             'image' => 'required|string',  // Ensure image is a Base64 encoded string
//         ]);

//         if ($validator->fails()) {
//             return response()->json([
//                 'error' => $validator->errors()
//             ], 400);
//         }

//         // Get the Base64 encoded string from the request
//         $base64Image = $request->input('image');

//         // Check if the string is a valid Base64 image format
//         if (!preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches)) {
//             // If the image format is missing (no data:image/jpeg;base64,...), we try to prepend it
//             if (preg_match('/^\/9j/', $base64Image)) {
//                 // It's a JPEG image, so we prepend the appropriate header
//                 $base64Image = 'data:image/jpeg;base64,' . $base64Image;
//             } elseif (preg_match('/^iVBOR/', $base64Image)) {
//                 // It's a PNG image, so we prepend the appropriate header
//                 $base64Image = 'data:image/png;base64,' . $base64Image;
//             } else {
//                 return response()->json([
//                     'error' => 'Invalid image format'
//                 ], 400);
//             }
//         }

//         // Now we can safely remove the image header
//         $imageData = substr($base64Image, strpos($base64Image, ',') + 1);

//         // Decode the image data
//         $image = base64_decode($imageData);

//         if (!$image) {
//             return response()->json([
//                 'error' => 'Image decoding failed'
//             ], 400);
//         }

//         // Generate a unique filename for the image
//         $imageName = Str::random(10) . '.png';  // You can use other formats based on your image type

//         // Save the image to storage (storage/app/public directory)
//         $imagePath = 'profileimage/' . $imageName;

//         // Store the image file on disk (in storage/app/public)
//         Storage::disk('public')->put($imagePath, $image);

//         // Return success response with the image URL
//         return response()->json([
//             'success' => true,
//             'message' => 'Profile image updated successfully',
//             'image_url' => asset('storage/' . $imagePath)
//         ], 200);
//     }

    // public function updateProfile(Request $request)
    // {
    //     // Validate the incoming request
    //     $validator = Validator::make($request->all(), [
    //         'id' => 'required', // Ensure the user ID exists in the users table
    //         'username' => 'nullable|string|max:255',
    //         'email' => 'nullable|email|max:255',
    //         'image' => 'nullable|string', // Assuming Base64 encoded image
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'error' => $validator->errors()->first(),
    //         ], 400);
    //     }
    //     // Fetch the user by ID
    //     $user = DB::table('users')->where('id', $request->id)->first();
        
    //     if (!$user) {
    //         return response()->json([
    //             'error' => 'User not found'
    //         ], 404);
    //     }
    
    //     // Prepare the data to update
    //     $updateData = [];
    
    //     // Update username if provided
    //     if ($request->has('username')) {
    //         $updateData['username'] = $request->username;
    //     }
    
    //     if ($request->has('email')) {
    //         $updateData['email'] = $request->email;
    //     }
    
    //     if ($request->has('image')) {
    //         $base64Image = $request->input('image');
    
    //         if (!preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches)) {
    //             // Check if missing the header and prepend based on image type
    //             if (preg_match('/^\/9j/', $base64Image)) {
    //                 $base64Image = 'data:image/jpeg;base64,' . $base64Image;
    //             } elseif (preg_match('/^iVBOR/', $base64Image)) {
    //                 $base64Image = 'data:image/png;base64,' . $base64Image;
    //             } else {
    //                 return response()->json([
    //                     'error' => 'Invalid image format'
    //                 ], 400);
    //             }
    //         }
    
    //         // Remove the image header and decode
    //         $imageData = substr($base64Image, strpos($base64Image, ',') + 1);
    //         $image = base64_decode($imageData);
    
    //         if (!$image) {
    //             return response()->json([
    //                 'error' => 'Image decoding failed'
    //             ], 400);
    //         }
    //         // Generate a unique filename
    //         $imageName = Str::random(10) . '.png';
    //         $imagePath = 'https://eshop.foundercode.org/storage/app/public/profileimage/' . $imageName;
    //         // Save the image to storage
    //         Storage::disk('public')->put($imagePath, $image);
    //         // Add image to update data
    //         $updateData['image'] = $imagePath;
    //     }
    //     // Update the user record in the database
    //     DB::table('users')->where('id', $request->id)->update($updateData);
    
    //     // Return success response
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Profile updated successfully',
    //         'data' => [
    //             'username' => $request->username ?? $user->username,
    //             'email' => $request->email ?? $user->email,
    //             'image_url' => isset($updateData['image']) ? asset('storage/' . $updateData['image']) : null,
    //         ]
    //     ], 200);
    // }
    
    public function updateProfile(Request $request)
    {
        $userId = $request->input('id');
        
        // Check if the user exists
        $user = DB::table('users')->where('id', $userId)->first();
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        // Validate the input fields
        $validator = Validator::make($request->all(), [
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $userId,
            'image_base64' => 'nullable|string', // For base64-encoded image
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first()
            ], 422);
        }
    
        $baseUrl = env('APP_URL'); // Base URL for constructing image path
        $input = $request->only(['username', 'email']); // Extract relevant fields
    
        // Handle Base64-encoded image if provided
        if ($request->input('image_base64')) {
            $imageData = base64_decode($request->input('image_base64'));
    
            if ($imageData === false) {
                return response()->json(['error' => 'Invalid base64 image data'], 400);
            }
    
            // Generate a unique file name for the image
            $imageName = 'images/' . uniqid() . '.png';
    
            // Save the decoded image to the public directory
            file_put_contents(public_path($imageName), $imageData);
    
            // Delete the old image if it exists
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
    
            // Save the new image path
            $input['image'] = $baseUrl . '/' . $imageName;
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
            ->select('id', 'username', 'mobile','email', 'image') // Specify fields to return
            ->first();
    
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'user' => $updatedUser
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
