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
    
        // Calculate the final total price
        $finalTotalPrice = $cartItems->sum('total_price'); // Use Laravel's collection `sum()` method
    
        return response()->json([
            'success' => true,
            'message' => 'Cart retrieved successfully',
            'data' => $cartItems,
            'final_total_price' => $finalTotalPrice // Add the final total price here
        ], 200);
    }

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
    
        
        $existingCartItem = DB::table('cart')
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();
    
        if ($existingCartItem) {
            $newQuantity = $request->quantity;
    
            DB::table('cart')
                ->where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->update([
                    'quantity' => $newQuantity, 
                    'updated_at' => now(),
                ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
            ], 200);
        } else {
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
                return response()->json($response,200);
        }
        
    
        $existingCartItem = DB::table('cart')
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();
    
        if ($existingCartItem) {
            $newQuantity = $existingCartItem->quantity - $request->quantity;
    
            if ($newQuantity > 0) {
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
    
        $existingCartItem = DB::table('cart')
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();
    
        if ($existingCartItem) {
            DB::table('cart')
                ->where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Product deleted from the cart successfully.',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in the cart.',
            ], 200);
        }
    }

    // public function addToFavorite(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required|integer|exists:users,id', 
    //         'product_id' => 'required|integer|exists:products,id',
    //         ]);
    
    //         $validator->stopOnFirstFailure();
            
    //         if($validator->fails()){
    //             $response = [
    //                         'status' => false,
    //                       'message' => $validator->errors()->first()
    //                       ]; 
    //                 return response()->json($response,200);
    //     }

    //     $existingFavorite = DB::table('favorites')
    //         ->where('user_id', $request->user_id)
    //         ->where('product_id', $request->product_id)
    //         ->first();
    
    //     if ($existingFavorite) {
    //         DB::table('favorites')
    //             ->where('user_id', $request->user_id)
    //             ->where('product_id', $request->product_id)
    //             ->update([
    //                 'quantity' => $existingFavorite->quantity + $request->quantity,
    //                 'updated_at' => now(),
    //             ]);
    
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Product quantity updated in favorites successfully',
    //         ], 200);
    //     }

    //     DB::table('favorites')->insert([
    //         'user_id' => $request->user_id,
    //         'product_id' => $request->product_id,
    //         'quantity' => $request->quantity,
    //         'created_at' => now(), 
    //         'updated_at' => now(),
    //     ]);
    
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Product added to favorites successfully',
    //     ], 200);
    // }
    
    public function addToFavorite(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id',
            'fav_status' => 'required|integer|in:0,1',  // Ensure fav_status is either 0 or 1
        ]);
        
        $validator->stopOnFirstFailure();
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }
    
        // If the request is to add the product to favorites (fav_status = 1)
        if ($request->fav_status == 1) {
            // Check if the product is already in favorites
            $existingFavorite = DB::table('favorites')
                ->where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->first();
    
            // If the product is not in favorites, insert it with fav_status = 1
            DB::table('favorites')->insert([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id, 
                'status' => 1, // Mark it as favorite
                'created_at' => now(),
                'updated_at' => now(), 
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Product added to favorites successfully',
            ], 200);
        }
    
        // If the request is to remove the product from favorites (fav_status = 0)
        if ($request->fav_status == 0) {
            $existingFavorite = DB::table('favorites')
                ->where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->first();
    
            if ($existingFavorite) {
                // If the product is in favorites, delete it from the favorites table
                DB::table('favorites')
                    ->where('user_id', $request->user_id)
                    ->where('product_id', $request->product_id)
                    ->delete(); // Delete the record from the favorites table
    
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from favorites successfully',
                ], 200);
            }
    
            // If the product is not in favorites, return an error message
            return response()->json([
                'success' => false,
                'message' => 'Product not found in favorites',
            ], 200);
        }
    }

    // public function viewFavorites(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required|integer',
    //     ]);
        
    //     $validator->stopOnFirstFailure();
    
    //     if ($validator->fails()) {
    //         $response = [
    //             'status' => false,
    //             'message' => $validator->errors()->first()
    //         ];
    //         return response()->json($response, 200);
    //     }
    
    //     $favoriteItems = DB::table('favorites')
    //         ->join('products', 'favorites.product_id', '=', 'products.id')
    //         ->join('product_variants', 'favorites.product_id', '=', 'product_variants.product_id')
    //         ->select(
    //             'favorites.id as favorite_item_id',
    //             'favorites.product_id',
    //             'products.*', 
    //             'product_variants.price as product_price', 
    //             'product_variants.special_price as special_price',
    //             'product_variants.percentage_off as percentage_off',
    //             DB::raw('product_variants.special_price as total_price') 
    //         )
    //         ->where('favorites.user_id', $request->user_id)
    //         ->get();
            
            
    
    //     if ($favoriteItems->isEmpty()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'No favorite items found',
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
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
        ]);
        
        $validator->stopOnFirstFailure();
    
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => $validator->errors()->first()
            ];
            return response()->json($response, 200);
        }
    
        $userId = $request->user_id;
    
        // Fetch all favorite items along with product details and variant details
        $favoriteItems = DB::table('favorites')
            ->join('products', 'favorites.product_id', '=', 'products.id')
            ->join('product_variants', 'favorites.product_id', '=', 'product_variants.product_id')
            ->select(
                'favorites.id as favorite_item_id',
                'favorites.product_id',
                'products.*', 
                'product_variants.price as product_price', 
                'product_variants.special_price as special_price',
                'product_variants.percentage_off as percentage_off',
                DB::raw('product_variants.special_price as total_price') 
            )
            ->where('favorites.user_id', $userId)
            ->get();
    
        if ($favoriteItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No favorite items found',
                'data' => []
            ], 200);
        }
    
        // Fetch all product IDs in the cart for the user
        $cartItems = DB::table('cart')
            ->where('user_id', $userId)
            ->pluck('product_id')
            ->toArray();
    
        // Add 'is_added_to_cart' to each favorite item
        $favoriteItems = $favoriteItems->map(function ($item) use ($cartItems) {
            $item->is_added_to_cart = in_array($item->product_id, $cartItems) ? 1 : 0;
            return $item;
        });
    
        return response()->json([
            'success' => true,
            'message' => 'Favorites retrieved successfully',
            'data' => $favoriteItems,
        ], 200);
    }
    

    public function removeFromFavorite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id', 
            'product_id' => 'required|integer|exists:products,id',
        ]);
    
        $validator->stopOnFirstFailure();
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }
    
        $userid = $request->user_id;
    
        if (empty($userid)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not logged in. Please log in first.',
            ], 200);
        }
    
        $existingFavorite = DB::table('favorites')
            ->where('user_id', $userid)
            ->where('product_id', $request->product_id)
            ->first();
    
        if (!$existingFavorite) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in favorites.',
            ], 200);
        }
    
        DB::table('favorites')
            ->where('user_id', $userid)
            ->where('product_id', $request->product_id)
            ->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Product removed from favorites successfully.',
        ], 200);
    }
    
    public function deletefromfav(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id',
        ]);
    
        $validator->stopOnFirstFailure(); 
    
        if ($validator->fails()) {
            return response()->json([ 
                'status' => false,
                'message' => $validator->errors()->first() 
            ], 200);
        }
    
        $existingFavItem = DB::table('favorites') 
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id) 
            ->first();
    
        if ($existingFavItem) { 
            DB::table('favorites')
                ->where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart successfully',
            ], 200);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Product not found in the cart', 
        ], 200);
    }

    
    // public function checkout(Request $request)
    // { 
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required|integer|exists:users,id',
    //         'total_price' => 'required|numeric|min:1', 
    //         'address_id' => 'required|integer|exists:addresses,id', 
    //         'coupon_applied' => 'nullable|string', 
    //         'paymode' => 'required|in:0,1',
    //     ]);
    
    //     $validator->stopOnFirstFailure();
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $validator->errors()->first(),
    //         ], 200);
    //     }
    
    //     $userId = $request->input('user_id');
    //     $totalPrice = $request->input('total_price');
    //     $addressId = $request->input('address_id');
    //     $paymode = $request->input('paymode');
    //     $couponApplied = $request->input('coupon_applied', null); 
        
    //     if (!empty($couponApplied)) {
    //         $isCouponValid = $this->validateCoupon($couponApplied);
    //         if (!$isCouponValid) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Invalid coupon code.',
    //             ], 200);
    //         }
    
    //         $totalPrice = $this->applyCouponDiscount($totalPrice, $couponApplied);
    //     }
    
    //     $orderData = [
    //         'user_id' => $userId,
    //         'address_id' => $addressId,
    //         'final_total' => $totalPrice,
    //         'payment_method' => $paymode == 1 ? 'Online' : 'COD',
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ];
    
    //     $orderId = \DB::table('orders')->insertGetId($orderData);
    
    //     if ($paymode == 1) {
    //         $paymentUrl = "https://paymentgateway.com/checkout?user_id=$userId&amount=$totalPrice";
    
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Make Payment to confirm order.',
    //             'data' => [
    //                 'payment_url' => $paymentUrl,
    //                 'paymode' => 'Online',
    //                 'final_total' => $totalPrice,
    //                 'coupon_applied' => $couponApplied,
    //                 'order_id' => $orderId,
    //             ],
    //         ], 200);
    //     }
    
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Order Placed successfully.',
    //         'data' => [
    //             'paymode' => 'COD',
    //             'final_total' => $totalPrice,
    //             'coupon_applied' => $couponApplied,
    //             'order_id' => $orderId,
    //         ],
    //     ], 200);
    // }
    
    // public function checkout(Request $request)
    // { 
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required|integer|exists:users,id',
    //         'total_price' => 'required|numeric|min:1', 
    //         'address_id' => 'required|integer|exists:addresses,id', 
    //         'coupon_applied' => 'nullable|string', 
    //         'paymode' => 'required|in:0,1',
    //     ]);
    
    //     $validator->stopOnFirstFailure();
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $validator->errors()->first(),
    //         ], 200);
    //     }
    
    //     $userId = $request->input('user_id');
    //     $totalPrice = $request->input('total_price');
    //     $addressId = $request->input('address_id');
    //     $paymode = $request->input('paymode');
    //     $couponApplied = $request->input('coupon_applied', null); 
        
    //     if (!empty($couponApplied)) {
    //         $isCouponValid = $this->validateCoupon($couponApplied);
    //         if (!$isCouponValid) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Invalid coupon code.',
    //             ], 200);
    //         }
    
    //         $totalPrice = $this->applyCouponDiscount($totalPrice, $couponApplied);
    //     }
    
    //     $orderData = [
    //         'user_id' => $userId,
    //         'address_id' => $addressId,
    //         'final_total' => $totalPrice,
    //         'payment_method' => $paymode == 1 ? 'Online' : 'COD',
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ];
    
    //     $orderId = \DB::table('orders')->insertGetId($orderData);
    
    //     \DB::table('cart')->where('user_id', $userId)->delete();
    
    //     if ($paymode == 1) {
    //         $paymentUrl = "https://paymentgateway.com/checkout?user_id=$userId&amount=$totalPrice";
    
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Make Payment to confirm order.',
    //             'data' => [
    //                 'payment_url' => $paymentUrl,
    //                 'paymode' => 'Online',
    //                 'final_total' => $totalPrice,
    //                 'coupon_applied' => $couponApplied,
    //                 'order_id' => $orderId,
    //             ],
    //         ], 200);
    //     }
    
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Order Placed successfully.',
    //         'data' => [
    //             'paymode' => 'COD',
    //             'final_total' => $totalPrice,
    //             'coupon_applied' => $couponApplied,
    //             'order_id' => $orderId,
    //         ],
    //     ], 200);
    // }


    public function checkout(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'total_price' => 'required|numeric|min:1', 
            'address_id' => 'required|integer|exists:addresses,id', 
            'coupon_applied' => 'nullable|string', 
            'paymode' => 'required|in:0,1',
        ]);
    
        $validator->stopOnFirstFailure();
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }
    
        $userId = $request->input('user_id');
        $totalPrice = $request->input('total_price');
        $addressId = $request->input('address_id');
        $paymode = $request->input('paymode');
        $couponApplied = $request->input('coupon_applied', null);
    
        // Check if the address belongs to the user
        $addressExists = \DB::table('addresses')
            ->where('id', $addressId)
            ->where('user_id', $userId)
            ->exists();
    
        if (!$addressExists) {
            return response()->json([
                'success' => false,
                'message' => 'The provided address does not belong to the specified user.',
            ], 200);
        }
    
        if (!empty($couponApplied)) {
            $isCouponValid = $this->validateCoupon($couponApplied);
            if (!$isCouponValid) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid coupon code.',
                ], 200);
            }
    
            $totalPrice = $this->applyCouponDiscount($totalPrice, $couponApplied);
        }
    
        $orderData = [
            'user_id' => $userId,
            'address_id' => $addressId,
            'final_total' => $totalPrice,
            'payment_method' => $paymode == 1 ? 'Online' : 'COD',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    
        $orderId = \DB::table('orders')->insertGetId($orderData);
    
        \DB::table('cart')->where('user_id', $userId)->delete();
    
        if ($paymode == 1) {
            $paymentUrl = "https://paymentgateway.com/checkout?user_id=$userId&amount=$totalPrice";
    
            return response()->json([
                'success' => true,
                'message' => 'Make Payment to confirm order.',
                'data' => [
                    'payment_url' => $paymentUrl,
                    'paymode' => 'Online',
                    'final_total' => $totalPrice,
                    'coupon_applied' => $couponApplied,
                    'order_id' => $orderId,
                ],
            ], 200);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Order Placed successfully.',
            'data' => [
                'paymode' => 'COD',
                'final_total' => $totalPrice,
                'coupon_applied' => $couponApplied,
                'order_id' => $orderId,
            ],
        ], 200);
    }

    
    


// // Example function to validate coupon (Replace with actual implementation)
// private function validateCoupon($coupon)
// {
//     // Example: Check if coupon exists in a `coupons` table and is valid
//     return \DB::table('coupons')->where('code', $coupon)->where('is_active', 1)->exists();
// }

// // Example function to apply coupon discount (Replace with actual implementation)
// private function applyCouponDiscount($totalPrice, $coupon)
// {
//     // Example: Fetch discount percentage or amount from `coupons` table
//     $discount = \DB::table('coupons')->where('code', $coupon)->value('discount_amount');
//     return $totalPrice - $discount;
// }






}