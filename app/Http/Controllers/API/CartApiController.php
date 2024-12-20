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
        
         $productVariant = DB::table('product_variants')
        ->where('product_id', $request->product_id)
        ->first();

            if (!$productVariant) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product variant not found',
                ], 404);
            }
            
        $existingCartItem = DB::table('cart')
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->where('status', '0')
            ->first();
    
        if ($existingCartItem) {
            DB::table('cart')
                ->where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->update([
                    'quantity' => $existingCartItem->quantity + $request->quantity,
                    'is_added' => true,  // Mark the product as added
                    'updated_at' => now(),  // Update the timestamp
                    ///////new add////
                     'price' => $productVariant->price,
                     'special_price' => $productVariant->special_price,
                    'percentage_off' => $productVariant->percentage_off,
                
                //off//
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
                ///new add//
                 'price' => $productVariant->price,
                'special_price' => $productVariant->special_price,
                'percentage_off' => $productVariant->percentage_off,
            
            ////new add///
            ]);
        }
    
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Product added to the cart successfully',
        ], 200);
    }

    // public function viewCart(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required|string',
    //     ]);
    
    //     $validator->stopOnFirstFailure();
    
    //     if ($validator->fails()) {
    //         $response = [
    //             'status' => false,
    //             'message' => $validator->errors()->first()
    //         ];
    //         return response()->json($response, 400);
    //     }
    
    //     $cartItems = DB::table('cart')
    //         ->join('products', 'cart.product_id', '=', 'products.id')
    //         ->join('product_variants', 'cart.product_id', '=', 'product_variants.product_id')
    //         ->select(
    //             'cart.id as cart_item_id',
    //             'cart.product_id',
    //             'products.*', // Select all columns from the products table
    //             'product_variants.price as product_price', // Price from product_variants table
    //             'product_variants.special_price as special_price',
    //             'product_variants.percentage_off as percentage_off',
    //             'cart.quantity',
    //             DB::raw('product_variants.special_price * cart.quantity as total_price') // Total price calculated using product_variants.price
    //         )
    //         // ->where('cart.user_id', $request->user_id)
    //         // ->get();
            
    //          ->where('cart.user_id', $request->user_id)
    //     ->where('cart.status', 0)  // Filter by cart status = 0
    //     ->get();
    
    //     if ($cartItems->isEmpty()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'No items in the cart',
    //             'data' => []
    //         ], 200);
    //     }
    
    //     // Calculate the final total price
    //     $finalTotalPrice = $cartItems->sum('total_price'); // Use Laravel's collection `sum()` method
    
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Cart retrieved successfully',
    //         'data' => $cartItems,
    //         'final_total_price' => $finalTotalPrice // Add the final total price here
    //     ], 200);
    // }
    
    public function viewCart(Request $request)
    {
        // Validate the user_id input
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
    
        // Fetch cart items for the specified user
        $cartItems = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->join('product_variants', 'cart.product_id', '=', 'product_variants.product_id') // Ensure the correct join on the variant
            ->select(
                'cart.id as cart_item_id',
                'cart.product_id',
                //'cart.product_variant_id', // Add the variant ID to ensure the correct variant is selected
                'products.*',   // Example of selecting the product description, adjust based on your structure
                'product_variants.price as product_price', // Price from product_variants table
                'product_variants.special_price as special_price', 
                'product_variants.percentage_off as percentage_off',
                'cart.quantity',
                DB::raw('IFNULL(product_variants.special_price, product_variants.price) * cart.quantity as total_price') // Default to regular price if special price is null
            )
            ->where('cart.user_id', $request->user_id)
            ->where('cart.status', 0)  // Ensure the cart is active (status = 0)
            ->get();
    
        // Check if the cart is empty
        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No items in the cart',
                'data' => []
            ], 200);
        }
    
        // Calculate the final total price of all items in the cart
        $finalTotalPrice = $cartItems->sum('total_price');
    
        return response()->json([
            'success' => true,
            'message' => 'Cart retrieved successfully',
            'data' => $cartItems,
            'final_total_price' => $finalTotalPrice // Return the final total price
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
    
    //     $userId = $request->user_id;
    
    //     // Fetch all favorite items along with product details and variant details
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
    //         ->where('favorites.user_id', $userId)
    //         ->get();
    
    //     if ($favoriteItems->isEmpty()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'No favorite items found',
    //             'data' => []
    //         ], 200);
    //     }
    
    //     // Fetch all product IDs in the cart for the user
    //     $cartItems = DB::table('cart')
    //         ->where('user_id', $userId)
    //         ->pluck('product_id')
    //         ->toArray();
    
    //     // Add 'is_added_to_cart' to each favorite item
    //     $favoriteItems = $favoriteItems->map(function ($item) use ($cartItems) {
    //         $item->is_added_to_cart = in_array($item->product_id, $cartItems) ? 1 : 0;
    //         return $item;
    //     });
    
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

    // Fetch all cart items with status 0 (active) and their quantities
    $cartItems = DB::table('cart')
        ->where('user_id', $userId)
        ->where('status', 0)  // Only fetch cart items with status = 0 (active)
        ->select('product_id', 'quantity')
        ->get()
        ->keyBy('product_id');  // Key the cart items by product_id to make lookup easier

    // Add 'is_added_to_cart' and 'quantity' to each favorite item
    $favoriteItems = $favoriteItems->map(function ($item) use ($cartItems) {
        // Check if the product exists in the cart with status 0 and get the quantity
        if (isset($cartItems[$item->product_id])) {
            $item->is_added_to_cart = 1;
            $item->quantity_in_cart = $cartItems[$item->product_id]->quantity;
        } else {
            $item->is_added_to_cart = 0;
            $item->quantity_in_cart = 0;
        }
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

    private function payin($paymode, $userId, $totalPrice,$orderId)   
    { 
        $cash = $totalPrice;  
        $userid = $userId;
        $date = date('YmdHis');  
        $rand = rand(11111, 99999);
        $orderid = $date . $rand;
        $datetime = now();
        $check_id = DB::table('users')->where('id', $userid)->first(); 
        
        if ($check_id) { 
            $redirect_url = env('APP_URL') . "api/checkPayment?order_id=$orderid";  
    
            $insert_payin = DB::table('payins')->insert([
                'user_id' => $userid,
                'cash' => $cash,
                'type' => $paymode,
                'order_id' => $orderid,
                'redirect_url' => $redirect_url,
                'status' => 1, // Assuming initial status is 1
                'typeimage' => "https://eshop.foundercode.org/uploads/fastpay_image.png",
                'created_at' => $datetime,
                'updated_at' => $datetime
            ]);
    
            if (!$insert_payin) {
                return response()->json(['status' => 400, 'message' => 'Failed to store record in payin history!']);
            }
    
            $postParameter = [
                'merchantid' => "04",
                'orderid' => $orderid,
                'amount' => $cash,
                'name' => $check_id->username,    
                'email' => "abc@gmail.com",  
                'mobile' => $check_id->mobile,   
                'remark' => 'payIn', 
                'type' => $cash,
                'redirect_url' => env('APP_URL') . "api/checkPayment?order_id=$orderid"
            ];
      
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://indianpay.co.in/admin/paynow',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0, 
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($postParameter),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Cookie: ci_session=1ef91dbbd8079592f9061d5df3107fd55bd7fb83'
                ),
            ));
            //UPDATE `orders` SET `transaction_id`='$rand' WHERE `order_id`='$orderId'
            DB::table('orders')->where('order_id', $orderId)->update(['transaction_id' => $orderid]); ///rohit sir
             $response = curl_exec($curl);
            curl_close($curl); 
            // print($response);
           
            $response = json_decode($response, true); 
            
            
            $paymentLink = $response['payment_link']; 
            
            return $paymentLink;  // Return the payment link
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Internal error!'
            ]);
        }
    }

    public function checkPayment(Request $request)
    {

        $orderid = $request->input('order_id');
	
        if ($orderid == "") {
            return response()->json(['status' => 400, 'message' => 'Order Id is required']);
        } else {
            $match_order = DB::table('payins')->where('order_id', $orderid)->where('status', 1)->first();

            if ($match_order) {
                $uid = $match_order->user_id;
                
                $cash = $match_order->cash;
                
               
                $orderid = $match_order->order_id;
                 $datetime=now();
             
                 //UPDATE `orders` SET status='1' WHERE `transaction_id`='$orderid'
                 DB::table('orders')->where('transaction_id', $orderid)->update(['status' => 1]); //rohit sir
              $update_payin = DB::table('payins')->where('order_id', $orderid)->where('status', 1)->where('user_id', $uid)->update(['status' => 2]);
    
                if ($update_payin) {
                   
                return redirect()->away(env('APP_URL').'/payment_success.php');
                    
                } else {
                    return response()->json(['status' => 400, 'message' => 'Failed to update payment status!']);
                }
            } else {
                return response()->json(['status' => 400, 'message' => 'Order id not found or already processed']);
            }
        }
    }
    
    public function checkout(Request $request) 
    {  
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'total_price' => 'required|numeric|min:1', 
            'address_id' => 'required|integer|exists:addresses,id', 
            'coupon_applied' => 'nullable|string', 
            'paymode' => 'required|in:0,1'
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
    
        $addressExists = DB::table('addresses')
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
        
        $orderId = rand(100000, 999999999);
    
        $orderData = [
            'user_id' => $userId,
            'address_id' => $addressId,
            'final_total' => $totalPrice,
            'payment_method' => $paymode == 1 ? 'Online' : 'COD',
            'order_id' => $orderId, 
             'status' => 0, // Order placed but not confirmed yet (initial status)
        ];
        
         DB::table('orders')->insert($orderData);
         DB::table('cart')
        ->where('user_id', $userId)
        ->update(['order_id' => $orderId]);
        
        if ($paymode == 0) { // COD
        DB::table('orders')
            ->where('order_id', $orderId)
            ->update(['status' => 0]); // 1 indicates order placed and confirmed
            
            // echo($paymode.$userId);
            // dd($paymode);

        DB::table('cart')
            ->where('user_id', $userId)
            ->update(['status' => 1]); // 1 indicates the cart is checked out and confirmed
    }
        if ($paymode == 1) {
            $paymentLink = $this->payin($paymode, $userId, $totalPrice,$orderId);  
      
            if ($paymentLink) {
                return response()->json([
                    'success' => true, 
                    'message' => 'Make Payment to confirm order.',   
                    'data' => [
                        'payment_url' => $paymentLink, 
                        'paymode' => 'Online', 
                        'final_total' => $totalPrice, 
                        'coupon_applied' => $couponApplied,  
                        'order_id' => $orderId,
                    ],
                ], 200); 
            }
        }
    
        if ($paymode == 1) {
            $paymentStatus = DB::table('payins')
                ->where('user_id', $userId)
                ->where('order_id', $orderId)
                ->value('status');
    
            if ($paymentStatus == 1) { 
                return response()->json([
                    'success' => false,
                    'message' => 'Payment is not completed yet.',
                ], 200);
            } elseif ($paymentStatus == 2) 
            { 
                return response()->json([
                    'success'=>true,
                    'message'=> 'Payment successful.',
                    ], 200); 
            } 
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Order Placed successfully.',
            'data' => [
                'paymode' => $paymode == 1 ? 'Online' : 'COD',
                'final_total' => $totalPrice,
                'coupon_applied' => $couponApplied,
                'order_id' => $orderId,
            ],
        ], 200);
    }
    
    public function viewcheckout(Request $request)  
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'product_name' => 'nullable|string', // Make product_name optional
        ]);
    
        if ($validator->fails()) { 
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 200); 
        }
    
        $user_id = $request->user_id;
        $product_name = $request->product_name; // Get the product name if passed
    
        // Get product IDs from the cart for the given user
        $product_ids = DB::table('cart')
            ->where('user_id', $user_id)
            ->pluck('product_id')
            ->toArray();
    
        // Start building the query to get order details with product details
        $query = DB::table('orders')
            ->select(
                'orders.order_id as order_id',
                'orders.final_total as total_price',
                'orders.status as order_status', 
                'orders.created_at as date',
                'cart.quantity as total_quantity',
                'cart.product_id as product_id',
                'products.name as product_name',
                'products.image as product_image',
                'cart.special_price as product_price'
            )
            ->leftJoin('cart', 'cart.user_id', '=', 'orders.user_id')
            ->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->where('orders.user_id', $user_id)
            ->whereIn('cart.product_id', $product_ids);
    
        // If a product name is provided, filter by product name
        if ($product_name) {
            $query->where('products.name', 'like', '%' . $product_name . '%');
        }
    
        // Execute the query
        $details = $query
            ->groupBy(
                'orders.order_id', 
                'cart.product_id', 
                'cart.quantity', 
                'cart.special_price', 
                'products.name', 
                'products.image', 
                'orders.final_total', 
                'orders.status', 
                'orders.created_at'
            )
            ->get();
    
        // If we have results, return them
        if ($details->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Order history retrieved successfully.',
                'data' => $details,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No orders found for this user.',
            ], 200);
        }
    }
    
    public function viewcheckout_history(Request $request)  
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|integer|exists:orders,order_id'
        ]);
    
        if ($validator->fails()) { 
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 200); 
        }
    
        $order_id = $request->order_id;
    
    
    
    
    
    
         if ($history->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Order history retrieved successfully.',
                'data' => $history,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No orders found for this order.',
            ], 200);
        }
    }
    
    
    
    
    public function checkout_old(Request $request) 
    {  
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'total_price' => 'required|numeric|min:1', 
            'address_id' => 'required|integer|exists:addresses,id', 
            'coupon_applied' => 'nullable|string', 
            'paymode' => 'required|in:0,1'
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
        
        // If payment mode is COD, delete cart items immediately
        if ($paymode == 0) {
            \DB::table('cart')->where('user_id', $userId)->delete();
        }
    
        // If payment mode is Online, generate payment link
        if ($paymode == 1) {
            $paymentLink = $this->payin($paymode, $userId, $totalPrice);  // Generate payment link
    
            if ($paymentLink) {
                return response()->json([
                    'success' => true, 
                    'message' => 'Make Payment to confirm order.',   
                    'data' => [
                        'payment_url' => $paymentLink, 
                        'paymode' => 'Online', 
                        'final_total' => $totalPrice, 
                        'coupon_applied' => $couponApplied,  
                        'order_id' => $orderId,
                    ],
                ], 200); 
            }
        }
    
        // After payment, check the status of the payment
        if ($paymode == 1) {
            // Check the payment status from the payins table
            $paymentStatus = \DB::table('payins')
                ->where('user_id', $userId)
                ->where('order_id', $orderId)
                ->value('status');
    
            if ($paymentStatus == 1) { // Payment not completed
                return response()->json([
                    'success' => false,
                    'message' => 'Payment is not completed yet.',
                ], 200);
            } elseif ($paymentStatus == 2) { // Payment successful
                // Payment successful, delete cart items
                \DB::table('cart')->where('user_id', $userId)->delete(); 
            } 
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Order Placed successfully.',
            'data' => [
                'paymode' => $paymode == 1 ? 'Online' : 'COD',
                'final_total' => $totalPrice,
                'coupon_applied' => $couponApplied,
                'order_id' => $orderId,
            ],
        ], 200);
    }

  
}