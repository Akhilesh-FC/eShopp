<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CartApiController extends Controller
{

    // public function addToCart(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required|integer|exists:users,id', 
    //         'product_id' => 'required|integer|exists:products,id',
    //         'quantity' => 'required|integer|min:1', 
    //     ]);
    
    //     $existingCartItem = DB::table('cart')
    //         ->where('user_id', $request->user_id)
    //         ->where('product_id', $request->product_id)
    //         ->first();
    
    //     if ($existingCartItem) {
    //         DB::table('cart')
    //             ->where('user_id', $request->user_id)
    //             ->where('product_id', $request->product_id)
    //             ->update([
    //                 'quantity' => $existingCartItem->quantity + $request->quantity
    //             ]);
    //     } else {

    //         DB::table('cart')->insert([
    //             'user_id' => $request->user_id,
    //             'product_id' => $request->product_id,
    //             'quantity' => $request->quantity,
    //             'created_at' => now(), 
    //             'updated_at' => now(),
    //         ]);
    //     }
    
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Product added to the cart successfully',
    //     ], 200);
    // }
    
    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id', 
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1', 
            ]);
    
            $validator->stopOnFirstFailure();
            
        if($validator->fails()){
             $response = [
                            'status' => false,
                           'message' => $validator->errors()->first()
                          ]; 
                    return response()->json($response,400);
        }

        // Check if the product already exists in the cart for the given user
        $existingCartItem = DB::table('cart')
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();
    
        // If the product already exists in the cart, update its quantity
        if ($existingCartItem) {
            DB::table('cart')
                ->where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->update([
                    'quantity' => $existingCartItem->quantity + $request->quantity,
                    'is_added' => true,  // Mark the product as added
                    'updated_at' => now(),  // Update the timestamp
                ]);
        } else {
            // If the product is not in the cart, add it
            DB::table('cart')->insert([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'is_added' => true,  // Mark the product as added
                'created_at' => now(),  // Set the created_at timestamp
                'updated_at' => now(),  // Set the updated_at timestamp
            ]);
        }
    
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Product added to the cart successfully',
        ], 200);
    }
    
//     public function viewCart(Request $request)
//     {
//             $validator = Validator::make($request->all(), [
//             'user_id' => 'required|integer', 
//         ]);

//         $validator->stopOnFirstFailure();
        
//     if($validator->fails()){
//          $response = [
//                         'status' => false,
//                       'message' => $validator->errors()->first()
//                       ]; 
//                 return response()->json($response,400);
//     }

//     $cartItems = DB::table('cart')
//         ->join('products', 'cart.product_id', '=', 'products.id')
//         ->join('product_variants', 'cart.product_id', '=', 'product_variants.product_id')
//         ->select(
//             'cart.id as cart_item_id',
//             'cart.product_id',
//             'products.name as product_name',
//             'products.description as product_description',
//             'product_variants.price as product_price', // Price from product_variants table
//             'cart.quantity',
//             DB::raw('product_variants.price * cart.quantity as total_price') // Total price calculated using product_variants.price
//         )
//         ->where('cart.user_id', $request->user_id)
//         ->get();

//     if ($cartItems->isEmpty()) {
//         return response()->json([
//             'success' => false,
//             'message' => 'No items in the cart',
//             'data' => []
//         ], 200);
//     }

//     return response()->json([
//         'success' => true,
//         'message' => 'Cart retrieved successfully',
//         'data' => $cartItems,
//     ], 200);
// }

    public function viewCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string', 
        ]);
    
        $validator->stopOnFirstFailure();
    
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => $validator->errors()->first()
            ]; 
            return response()->json($response, 400);
        }
    
        $cartItems = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->join('product_variants', 'cart.product_id', '=', 'product_variants.product_id')
            ->select(
                'cart.id as cart_item_id',
                'cart.product_id',
                'products.*', // Select all columns from the products table
                'product_variants.price as product_price', // Price from product_variants table
                'product_variants.special_price as special_price',
                'product_variants.percentage_off as percentage_off',
                'cart.quantity',
                DB::raw('product_variants.special_price * cart.quantity as total_price') // Total price calculated using product_variants.price
            )
            ->where('cart.user_id', $request->user_id)
            ->get();
    
        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No items in the cart',
                'data' => []
            ], 200);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Cart retrieved successfully',
            'data' => $cartItems,
        ], 200);
    }


//     public function updateFromCart(Request $request)
//     {
    
//     $validator = Validator::make($request->all(), [
//         'user_id' => 'required|integer|exists:users,id', 
//         'product_id' => 'required|integer|exists:products,id', 
//         'quantity' => 'required|integer|min:1', 
//         ]);

//         $validator->stopOnFirstFailure();
        
//     if($validator->fails()){
//          $response = [
//                         'status' => false,
//                       'message' => $validator->errors()->first()
//                       ]; 
//                 return response()->json($response,400);
//     }

//     $existingCartItem = DB::table('cart')
//         ->where('user_id', $request->user_id)
//         ->where('product_id', $request->product_id)
//         ->first();

//     if ($existingCartItem) {
//         // Update the quantity by adding the new quantity to the existing quantity
//         DB::table('cart')
//             ->where('user_id', $request->user_id)
//             ->where('product_id', $request->product_id)
//             ->update([
//                 'quantity' => $request->quantity, // Add new quantity to existing
//                 //$existingCartItem->quantity += $request->quantity;
//                 'updated_at' => now(),
//             ]);

//         return response()->json([
//             'success' => true,
//             'message' => 'Cart updated successfully',
//         ], 200);
//     } else {
//         // Product not found in the cart
//         return response()->json([
//             'success' => false,
//             'message' => 'Product not found in the cart',
//         ], 200);
//     }
// }

    public function updateFromCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id', 
            'product_id' => 'required|integer|exists:products,id', 
            'quantity' => 'required|integer|min:1', 
        ]);
    
        $validator->stopOnFirstFailure();
        
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => $validator->errors()->first()
            ]; 
            return response()->json($response, 200);
        }
    
        // Get the existing cart item
        $existingCartItem = DB::table('cart')
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();
    
        if ($existingCartItem) {
            // Increment the existing quantity by the new quantity from the request
            $newQuantity = $request->quantity;
    
            // Update the cart with the new quantity
            DB::table('cart')
                ->where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->update([
                    'quantity' => $newQuantity, // Add the new quantity to the existing quantity
                    'updated_at' => now(),
                ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
            ], 200);
        } else {
            // If the product is not found in the cart
            return response()->json([
                'success' => false,
                'message' => 'Product not found in the cart',
            ], 200);
        }
    }


    public function removeFromCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id', 
            'product_id' => 'required|integer|exists:products,id', 
        ]);

        $validator->stopOnFirstFailure();
        
        if($validator->fails()){
            $response = [
                        'status' => false,
                       'message' => $validator->errors()->first()
                      ]; 
                return response()->json($response,400);
        }
        
    
        $existingCartItem = DB::table('cart')
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();
    
        if ($existingCartItem) {
            $newQuantity = $existingCartItem->quantity - $request->quantity;
    
            if ($newQuantity > 0) {
                // Update the cart item with the reduced quantity
                DB::table('cart')
                    ->where('user_id', $request->user_id)
                    ->where('product_id', $request->product_id)
                    ->update([
                        'quantity' => $newQuantity,
                        'updated_at' => now(),
                    ]);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Product quantity reduced successfully in the cart.',
                ], 200);
            } else {
                // Remove the item from the cart if quantity becomes zero or less
                DB::table('cart')
                    ->where('user_id', $request->user_id)
                    ->where('product_id', $request->product_id)
                    ->delete();
    
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from the cart successfully.',
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in the cart.',
            ], 200);
        }
    }
    
    public function deleteFromCart(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id', 
            'product_id' => 'required|integer|exists:products,id', 
        ]);
    
        $validator->stopOnFirstFailure();
    
        if ($validator->fails()) {
            $response = [
                'status' => false, 
                'message' => $validator->errors()->first() 
            ];
            return response()->json($response, 200);  
        } 
    
        // Check if the item exists in the cart
        $existingCartItem = DB::table('cart')
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();
    
        if ($existingCartItem) {
            // Delete the item from the cart
            DB::table('cart')
                ->where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Product deleted from the cart successfully.',
            ], 200);
        } else {
            // Product not found in the cart
            return response()->json([
                'success' => false,
                'message' => 'Product not found in the cart.',
            ], 200);
        }
    }

    
    public function addToFavorite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id', 
            'product_id' => 'required|integer|exists:products,id',
            ]);
    
            $validator->stopOnFirstFailure();
            
            if($validator->fails()){
                $response = [
                            'status' => false,
                           'message' => $validator->errors()->first()
                          ]; 
                    return response()->json($response,200);
        }

        $existingFavorite = DB::table('favorites')
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();
    
        if ($existingFavorite) {
            // If the product is already in favorites, update the quantity
            DB::table('favorites')
                ->where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->update([
                    'quantity' => $existingFavorite->quantity + $request->quantity,
                    'updated_at' => now(),
                ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Product quantity updated in favorites successfully',
            ], 200);
        }

        // If the product is not in favorites, insert a new record
        DB::table('favorites')->insert([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'created_at' => now(), 
            'updated_at' => now(),
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Product added to favorites successfully',
        ], 200);
    }

    // public function viewFav(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required|integer', 
    //     ]);

    //     $validator->stopOnFirstFailure();
        
    // if($validator->fails()){
    //      $response = [
    //                     'status' => false,
    //                   'message' => $validator->errors()->first()
    //                   ]; 
    //             return response()->json($response,400);
    // }
    
    //     $favoriteItems = DB::table('favorites')
    //         ->join('products', 'favorites.product_id', '=', 'products.id')
    //         ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
    //         ->select(
    //             'favorites.id as favorite_item_id',
    //             'favorites.product_id',
    //             'products.name as product_name',
    //             'products.description as product_description',
    //             'product_variants.special_price as product_price' // Price from product_variants table
    //         )
    //         ->where('favorites.user_id', $request->user_id)
    //         ->get();
    
    //     if ($favoriteItems->isEmpty()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'No items in favorites',
    //             'data' => []
    //         ], 200);
    //     }
    
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Favorites retrieved successfully',
    //         'data' => $favoriteItems,
    //     ], 200);
    // }
    
    public function viewFavorites(Request $request)
    {
        // Validate the user ID
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
        ]);
        
    
        // Stop on the first failure
        $validator->stopOnFirstFailure();
    
        // Return validation errors if any
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => $validator->errors()->first()
            ];
            return response()->json($response, 200);
        }
    
        // Get the favorites data from the database
        $favoriteItems = DB::table('favorites')
            ->join('products', 'favorites.product_id', '=', 'products.id')
            ->join('product_variants', 'favorites.product_id', '=', 'product_variants.product_id')
            ->select(
                'favorites.id as favorite_item_id',
                'favorites.product_id',
                'products.*', // Select all columns from the products table
                'product_variants.price as product_price', // Price from product_variants table
                'product_variants.special_price as special_price',
                'product_variants.percentage_off as percentage_off',
                DB::raw('product_variants.special_price as total_price') // You can adjust the total price calculation if needed
            )
            ->where('favorites.user_id', $request->user_id)
            ->get();
    
        // Check if no favorite items found
        if ($favoriteItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No favorite items found',
                'data' => []
            ], 200);
        }
    
        // Return the response with favorite items data
        return response()->json([
            'success' => true,
            'message' => 'Favorites retrieved successfully',
            'data' => $favoriteItems,
        ], 200);
    }

    public function removeFromFavorite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $validator->stopOnFirstFailure();
        
        if($validator->fails()){
         $response = [
                        'status' => false,
                       'message' => $validator->errors()->first()
                      ]; 
                return response()->json($response,200);
        }
        $userid = $request->user_id;
        if($userid == "null" && $userid == null){
        $existingFavorite = DB::table('favorites')
            ->where('user_id', $userid)
            ->where('product_id', $request->product_id)
            ->first();
    
        if (!$existingFavorite) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in favorites',
            ], 200);
        }

        // Remove the product from favorites
        DB::table('favorites')
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product removed from favorites successfully',
        ], 200);
        }else{
           return response()->json([
            'success' => false,
            'message' => 'You Are Not Login.! Please Login First...!',
        ], 200); 
        }
    }


// public function viewFav(Request $request)
// {
//     $request->validate([
//         'user_id' => 'required|integer|exists:users,id', 
//     ]);

//     $favoriteItems = DB::table('favorites')
//         ->join('products', 'favorites.product_id', '=', 'products.id')
//         ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
//         ->leftJoin('product_rating', 'products.id', '=', 'product_rating.product_id') // Join with product_rating table to fetch ratings
//         ->select(
//             'favorites.id as favorite_item_id',
//             'favorites.product_id',
//             'products.*', // Select all fields from the products table
//             'product_variants.price as product_price', // Price from product_variants table
//             'product_variants.special_price as product_special_price', // Special price from product_variants table
//             'product_variants.percentage_off', // Discount percentage from product_variants table
//             'product_rating.rating as product_rating' // Rating from product_rating table

//         )
//         ->where('favorites.user_id', $request->user_id)
//         ->get();

//     if ($favoriteItems->isEmpty()) {
//         return response()->json([
//             'success' => false,
//             'message' => 'No items in favorites',
//             'data' => []
//         ], 200);
//     }

//     return response()->json([
//         'success' => true,
//         'message' => 'Favorites retrieved successfully',
//         'data' => $favoriteItems,
//     ], 200);
// }
//     public function deleteFromCart(Request $request)
//     {
//         // Validate the request
//         $request->validate([
//             'user_id' => 'required|integer|exists:users,id', // Ensure user exists
//             'product_id' => 'required|integer|exists:products,id', // Ensure product exists
//         ]);
    
//         // Check if the product exists in the cart
//         $cartItem = DB::table('cart')
//             ->where('user_id', $request->user_id)
//             ->where('product_id', $request->product_id)
//             ->first();
    
//         if (!$cartItem) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Product is not in the cart',
//             ], 404);
//         }
    
//         // Remove the product from the cart
//         DB::table('cart')
//             ->where('user_id', $request->user_id)
//             ->where('product_id', $request->product_id)
//             ->delete();
    
//         return response()->json([
//             'success' => true,
//             'message' => 'Product removed from the cart successfully',
//         ], 200);
//     }
    //     public function removeFromFavorite(Request $request)
//     {
//     // Validate incoming request
//     $request->validate([
//         'user_id' => 'required|integer|exists:users,id', // Ensure user exists
//         'product_id' => 'required|integer|exists:products,id', // Ensure product exists
//     ]);

//     // Check if the product exists in the user's favorites
//     $existingFavorite = DB::table('favorites')
//         ->where('user_id', $request->user_id)
//         ->where('product_id', $request->product_id)
//         ->first();

//     if (!$existingFavorite) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Product is not in your favorites',
//         ], 404);
//     }

//     // Remove the product from favorites
//     DB::table('favorites')
//         ->where('user_id', $request->user_id)
//         ->where('product_id', $request->product_id)
//         ->delete();

//     return response()->json([
//         'success' => true,
//         'message' => 'Product removed from favorites successfully',
//     ], 200);
// }





}