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

            // Check if the product variant exists
            if (!$productVariant) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product variant not found',
                ], 404);
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
            // ->where('cart.user_id', $request->user_id)
            // ->get();
            
             ->where('cart.user_id', $request->user_id)
        ->where('cart.status', 0)  // Filter by cart status = 0
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

    private function payin($paymode, $userId, $totalPrice)   
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

        $response = curl_exec($curl);
        curl_close($curl);
        
        $response = json_decode($response, true); 
        //dd($response);
        
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
              // dd("UPDATE payins SET status = 2 WHERE order_id = $orderid AND status = 1 AND user_id = $uid");

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

    // public function order_place_list(Request $request)  
    // {
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required|integer|exists:users,id',   
    //     ]);
     
    //     if ($validator->fails()) { 
    //         return response()->json([
    //             'success' => false,
    //             'message' => $validator->errors()->first(), 
    //         ], 200); 
    //     }
    
    //     $user_id = $request->user_id;
    
    //     $product_ids = DB::table('cart')
    //         ->where('user_id', $user_id)
    //         ->pluck('product_id')
    //         ->toArray(); 


    //     $details = DB::table('orders')
    //         ->select(
    //             'orders.id as order_id',
    //             'orders.final_total as total_price', 
    //             'orders.status as order_status', 
    //             'orders.created_at as date',
    //             //'orders.status as status', 
    //             'products.name as p_name',
    //             'products.image as p_image',
    //             'product_variants.special_price as s_price',  
    //             'product_variants.percentage_off as p_off',   
    //             'cart.product_id as cart_product_id', 
    //             'cart.quantity as cart_quantity' 
    //         )
    //         ->leftJoin('cart', 'cart.user_id', '=', 'orders.user_id') 
    //         ->leftJoin('products', 'products.id', '=', 'cart.product_id')  
    //         ->leftJoin('product_variants', 'product_variants.product_id', '=', 'products.id') 
    //         ->where('orders.user_id', $user_id) 
    //         ->whereIn('cart.product_id', $product_ids) 
    //         ->get();

    
    //     if ($details) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Order history retrieved successfully.', 
    //             'data' => $details,
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'No orders found for this user.',
    //         ], 200);
    //     }
    // }
    
   public function viewcheckout(Request $request)  
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
        ]);
    
        if ($validator->fails()) { 
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 200); 
        }
    
        $user_id = $request->user_id;
    
        // Get product IDs from the cart for the given user
        $product_ids = DB::table('cart')
            ->where('user_id', $user_id)
            ->pluck('product_id')
            ->toArray();
    
        // Get order details along with product details from related tables
        $details = DB::table('orders')
            ->select(
                'orders.order_id as order_id',
                'orders.final_total as total_price',
                'orders.status as order_status', 
                'orders.created_at as date',
                'cart.quantity as total_quantity',
                'cart.product_id as product_id',
                'products.name as product_name',
                'products.image as product_image',
                'cart.special_price as product_price' // Correct field for price
            )
            ->leftJoin('cart', 'cart.user_id', '=', 'orders.user_id')
            ->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->where('orders.user_id', $user_id)
            ->whereIn('cart.product_id', $product_ids) // Filter by products in the cart
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
    

    ///all right////
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
            $paymentLink = $this->payin($paymode, $userId, $totalPrice);  
      
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
    
//   public function checkout(Request $request) 
// {  
//     $validator = Validator::make($request->all(), [
//         'user_id' => 'required|integer|exists:users,id',
//         'total_price' => 'required|numeric|min:1', 
//         'address_id' => 'required|integer|exists:addresses,id', 
//         'coupon_applied' => 'nullable|string', 
//         'paymode' => 'required|in:0,1'
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

//     // Check if the address belongs to the user
//     $addressExists = DB::table('addresses')
//         ->where('id', $addressId)
//         ->where('user_id', $userId)
//         ->exists();

//     if (!$addressExists) {
//         return response()->json([
//             'success' => false,
//             'message' => 'The provided address does not belong to the specified user.',
//         ], 200);
//     }

//     // Check for applied coupon
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

//     // Fetch cart items for the user
//     $cartItems = DB::table('cart')
//         ->where('user_id', $userId)
//         ->get(['product_id', 'quantity', 'price', 'special_price', 'percentage_off']);

//     // Prepare the order data (general order information)
//     $orderData = [
//         'user_id' => $userId,
//         'address_id' => $addressId,
//         'final_total' => $totalPrice,
//         'payment_method' => $paymode == 1 ? 'Online' : 'COD',
//         'created_at' => now(),
//         'updated_at' => now(),
//     ];

//     // Insert the order and get the order ID
//     $orderId = DB::table('orders')->insertGetId($orderData);
    
//     // Insert product-specific details for each product in the cart into a different table, assuming 'order_items'
//     foreach ($cartItems as $cartItem) {
//         DB::table('order_items')->insert([
//             'order_id' => $orderId,  // Associating this product with the correct order
//             'product_id' => $cartItem->product_id,
//             'quantity' => $cartItem->quantity,
//             'price' => $cartItem->price,
//             'special_price' => $cartItem->special_price,
//             'percentage_off' => $cartItem->percentage_off,
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//     }

//     // If payment mode is COD, delete cart items immediately
//     if ($paymode == 0) {
//         DB::table('cart')->where('user_id', $userId)->delete();
//     }

//     // If payment mode is Online, generate payment link
//     if ($paymode == 1) {
//         $paymentLink = $this->payin($paymode, $userId, $totalPrice);  // Generate payment link

//         if ($paymentLink) {
//             return response()->json([
//                 'success' => true, 
//                 'message' => 'Make Payment to confirm order.',   
//                 'data' => [
//                     'payment_url' => $paymentLink, 
//                     'paymode' => 'Online', 
//                     'final_total' => $totalPrice, 
//                     'coupon_applied' => $couponApplied,  
//                     'order_id' => $orderId,
//                 ],
//             ], 200); 
//         }
//     }

//     // After payment, check the status of the payment
//     if ($paymode == 1) {
//         // Check the payment status from the payins table
//         $paymentStatus = DB::table('payins')
//             ->where('user_id', $userId)
//             ->where('order_id', $orderId)
//             ->value('status');

//         if ($paymentStatus == 1) { // Payment not completed
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Payment is not completed yet.',
//             ], 200);
//         } elseif ($paymentStatus == 2) { // Payment successful
//             // Payment successful, delete cart items
//             DB::table('cart')->where('user_id', $userId)->delete(); 
//         } 
//     }

//     return response()->json([
//         'success' => true,
//         'message' => 'Order Placed successfully.',
//         'data' => [
//             'paymode' => $paymode == 1 ? 'Online' : 'COD',
//             'final_total' => $totalPrice,
//             'coupon_applied' => $couponApplied,
//             'order_id' => $orderId,
//         ],
//     ], 200);
// }



    
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