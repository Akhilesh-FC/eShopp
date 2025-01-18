<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;


class CartApiController extends Controller
{
    
    public function addToCart(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $datetime = now();
        
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id', 
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color_id' => 'required|integer', //color_id
            'size_id' => 'required',  //size_id
            ]);
    
            $validator->stopOnFirstFailure();
            
        if($validator->fails()){
             $response = [
                            'status' => false,
                           'message' => $validator->errors()->first()
                          ]; 
                    return response()->json($response,200);
        }
        
         $productVariant = DB::table('product_variants')
        ->where('product_id', $request->product_id)
        ->first();

            if (!$productVariant) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product variant not found',
                ], 200);
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
                    'updated_at' => $datetime,  // Update the timestamp
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
                'size_id' => $request->size_id,
                'color_id' => $request->color_id,
                
                'is_added' => true,  // Mark the product as added
                'created_at' => $datetime,  // Set the created_at timestamp
                'updated_at' => $datetime,  // Set the updated_at timestamp
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
    //         return response()->json([
    //             'status' => false,
    //             'message' => $validator->errors()->first()
    //         ], 200);
    //     }
    
    //     $cartItems = DB::table('cart')
    //         ->join('products', 'cart.product_id', '=', 'products.id')
    //         ->join('product_variants', 'cart.product_id', '=', 'product_variants.product_id') 
    //         ->select(
    //             'cart.id as cart_item_id',
    //             'cart.product_id',
    //             'products.*',   
    //             'product_variants.price as product_price', 
    //             'product_variants.special_price as special_price', 
    //             'product_variants.percentage_off as percentage_off',
    //             'cart.quantity',
    //             DB::raw('IFNULL(product_variants.special_price, product_variants.price) * cart.quantity as total_price') // Calculate total price
    //         )
    //         ->where('cart.user_id', $request->user_id)
    //         ->where('cart.status', 0)  // Active cart only
    //         ->get();
    
    //     // Calculate the final total price of all items in the cart
    //     $finalTotalPrice = $cartItems->sum('total_price'); // Sum of all total_price values from cartItems
    
    //     // Ensure final_total_price is always returned, even if cart is empty
    //     $finalTotalPrice = $finalTotalPrice ?? 0; // Default to 0 if no cart items
        
    //     $finalTotalPrice = number_format($finalTotalPrice, 2, '.', '');
    
    //     // Check if the cart is empty and return appropriate response
    //     if ($cartItems->isEmpty()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'No items in the cart',
    //             'data' => [],
    //             'final_total_price' => $finalTotalPrice // Always return the total price
    //         ], 200);
    //     }
    
    //     // Return the response with cart items and final total price
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Cart retrieved successfully',
    //         'data' => $cartItems,
    //         'final_total_price' => $finalTotalPrice // Always return the total price
    //     ], 200);
    // }
    
    public function viewCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
        ]);
        
        $validator->stopOnFirstFailure();
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }
    
        // Fetch cart items and ensure we join only the first product variant
        $cartItems = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->leftJoin('product_variants', function ($join) {
                // Subquery to get the first variant for each product
                $join->on('cart.product_id', '=', 'product_variants.product_id')
                    ->whereRaw('product_variants.id = (SELECT MIN(id) FROM product_variants WHERE product_variants.product_id = cart.product_id)');
            })
            ->select(
                'cart.id as cart_item_id',
                'cart.product_id',
                'products.*',
                'product_variants.id as variant_id',
                'product_variants.price as product_price',
                'product_variants.special_price as special_price',
                'product_variants.percentage_off as percentage_off',
                'cart.quantity',
                DB::raw('IFNULL(product_variants.special_price, product_variants.price) * cart.quantity as total_price') // Calculate total price
            )
            ->where('cart.user_id', $request->user_id)
            ->where('cart.status', 0)  // Active cart only
            ->get();
    
        // Calculate the final total price of all items in the cart
        $finalTotalPrice = $cartItems->sum('total_price'); // Sum of all total_price values from cartItems
        
        // Ensure final_total_price is always returned, even if cart is empty
        $finalTotalPrice = $finalTotalPrice ?? 0; // Default to 0 if no cart items
        
        $finalTotalPrice = number_format($finalTotalPrice, 2, '.', '');
        
        // Check if the cart is empty and return appropriate response
        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No items in the cart',
                'data' => [],
                'final_total_price' => $finalTotalPrice // Always return the total price
            ], 200);
        }
    
        // Return the response with cart items and final total price
        return response()->json([
            'success' => true,
            'message' => 'Cart retrieved successfully',
            'data' => $cartItems,
            'final_total_price' => $finalTotalPrice // Always return the total price
        ], 200);
    }
    
        
    public function updateFromCart(Request $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        $datetime = now();
        
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
                    'updated_at' => $datetime(),
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
        
        date_default_timezone_set('Asia/Kolkata');
        $datetime = now();
        
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
                        'updated_at' => $datetime,
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
        date_default_timezone_set('Asia/Kolkata');
        $datetime = now();
        
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
                'created_at' => $datetime,
                'updated_at' => $datetime, 
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
    // $validator = Validator::make($request->all(), [
    //     'user_id' => 'required|integer',
    // ]);
    
    // $validator->stopOnFirstFailure();

    // if ($validator->fails()) {
    //     $response = [
    //         'status' => false,
    //         'message' => $validator->errors()->first()
    //     ];
    //     return response()->json($response, 200);
    // }

    // $userId = $request->user_id;

    // // Fetch all favorite items along with product details and variant details
    // $favoriteItems = DB::table('favorites')
    //     ->join('products', 'favorites.product_id', '=', 'products.id')
    //     ->join('product_variants', 'favorites.product_id', '=', 'product_variants.product_id')
    //     ->select(
    //         'favorites.id as favorite_item_id',
    //         'favorites.product_id',
    //         'products.*', 
    //         'product_variants.price as product_price', 
    //         'product_variants.special_price as special_price',
    //         'product_variants.percentage_off as percentage_off',
    //         DB::raw('product_variants.special_price as total_price') 
    //     )
    //     ->where('favorites.user_id', $userId)
    //     ->get();

    // if ($favoriteItems->isEmpty()) {
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'No favorite items found',
    //         'data' => []
    //     ], 200);
    // }

    // // Fetch all cart items with status 0 (active) and their quantities
    // $cartItems = DB::table('cart')
    //     ->where('user_id', $userId)
    //     ->where('status', 0)  // Only fetch cart items with status = 0 (active)
    //     ->select('product_id', 'quantity')
    //     ->get()
    //     ->keyBy('product_id');  // Key the cart items by product_id to make lookup easier

    // // Add 'is_added_to_cart' and 'quantity' to each favorite item
    // $favoriteItems = $favoriteItems->map(function ($item) use ($cartItems) {
    //     // Check if the product exists in the cart with status 0 and get the quantity
    //     if (isset($cartItems[$item->product_id])) {
    //         $item->is_added_to_cart = 1;
    //         $item->quantity_in_cart = $cartItems[$item->product_id]->quantity;
    //     } else {
    //         $item->is_added_to_cart = 0;
    //         $item->quantity_in_cart = 0;
    //     }
    //     return $item;
    // });

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

    // Fetch all favorite items along with product details and the first variant's details
    $favoriteItems = DB::table('favorites')
        ->join('products', 'favorites.product_id', '=', 'products.id')
        ->leftJoin('product_variants', function ($join) {
            // Subquery to get the first variant for each product
            $join->on('favorites.product_id', '=', 'product_variants.product_id')
                ->whereRaw('product_variants.id = (SELECT MIN(id) FROM product_variants WHERE product_variants.product_id = favorites.product_id)');
        })
        ->select(
            'favorites.id as favorite_item_id',
            'favorites.product_id',
            'products.*',
            'product_variants.id as variant_id', 
            'product_variants.price as product_price', 
            'product_variants.special_price as special_price',
            'product_variants.percentage_off as percentage_off',
            DB::raw('IFNULL(product_variants.special_price, product_variants.price) as total_price') // Calculate total price
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
                'typeimage' => "https://free2kart.mobileappdemo.net/uploads/fastpay_image.png",
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
    
    // public function checkout(Request $request) 
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
        
    //     $orderId = rand(100000, 999999999);
    
    //     $orderData = [
    //         'user_id' => $userId,
    //         'address_id' => $addressId,
    //         'final_total' => $totalPrice,
    //         'payment_method' => $paymode == 1 ? 'Online' : 'COD',
    //         'order_id' => $orderId, 
    //         'status' => 0, // Order placed but not confirmed yet (initial status)
    //     ];
        
    //     date_default_timezone_set('Asia/Kolkata');
    //     $datetime = now();
        
    //      DB::table('orders')->insert($orderData);
    //      DB::table('cart')
    //     ->where('user_id', $userId)
    //     ->update(['order_id' => $orderId]);
        
        
        
    //     if ($paymode == 0) { // COD
    //     DB::table('orders')
    //         ->where('order_id', $orderId)
    //         ->update(['status' => 0]); // 1 indicates order placed and confirmed
            
    //         // echo($paymode.$userId);
    //         // dd($paymode);

    //     DB::table('cart')
    //         ->where('user_id', $userId)
    //         ->update(['status' => 1]); // 1 indicates the cart is checked out and confirmed
    // }
    //     if ($paymode == 1) {
    //         $paymentLink = $this->payin($paymode, $userId, $totalPrice,$orderId);  
      
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
    
    //     if ($paymode == 1) {
    //         $paymentStatus = DB::table('payins')
    //             ->where('user_id', $userId)
    //             ->where('order_id', $orderId)
    //             ->value('status');
    
    //         if ($paymentStatus == 1) { 
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Payment is not completed yet.',
    //             ], 200);
    //         } elseif ($paymentStatus == 2) 
    //         { 
    //             return response()->json([
    //                 'success'=>true,
    //                 'message'=> 'Payment successful.',
    //                 ], 200); 
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
    
        date_default_timezone_set('Asia/Kolkata');
        $datetime = Carbon::now()->format('Y-m-d H:i:s'); // Format the datetime properly
    
        DB::table('orders')->insert($orderData);
    
        // Prepare status array based on order status
        $statusUpdates = [];
    
        // Fetch the order status from the orders table
        $orderStatus = DB::table('orders')->where('order_id', $orderId)->value('status');
        
        // Dynamically add status messages to the array based on order status
        if ($orderStatus == 0) {  // Order placed (status = 0)
            $statusUpdates[] = ['status' => 'orderPlaced', 'datetime' => $datetime];
        }
        
        if ($orderStatus == 1) {  // Order shipped (status = 1)
            $statusUpdates[] = ['status' => 'orderShipped', 'datetime' => $datetime];
        }
    
        if ($orderStatus == 2) {  // Order out for delivery (status =2)
            $statusUpdates[] = ['status' => 'orderOutForDelivery', 'datetime' => $datetime];
        }
        
        if ($orderStatus == 3) {  // Order delivered (status = 3)
            $statusUpdates[] = ['status' => 'orderDelivered', 'datetime' => $datetime];
        }
    
        // Encode the status array to JSON
        $orderItemStatus = json_encode($statusUpdates);
    
        // Insert into order_items with the dynamic status in JSON format
        DB::table('order_items')->insert([
            'order_id' => $orderId,
            'user_id' => $userId,
             'address_id' => $addressId,
            'final_total' => $totalPrice,
            'payment_method' => $paymode == 1 ? 'Online' : 'COD',
           'status' => $orderItemStatus, // Store the dynamic status as JSON
            // Other necessary columns in order_items (like item_id, quantity, etc.)
        ]);
    
        DB::table('cart')
            ->where('user_id', $userId)
            ->update(['order_id' => $orderId]);
    
        if ($paymode == 0) { // COD
            DB::table('orders')
                ->where('order_id', $orderId)
                ->update(['status' => 0]); // 0 indicates order placed and confirmed
    
            DB::table('cart')
                ->where('user_id', $userId)
                ->update(['status' => 1]); // 1 indicates the cart is checked out and confirmed
        }
    
        if ($paymode == 1) {
            $paymentLink = $this->payin($paymode, $userId, $totalPrice, $orderId);  
    
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
            } elseif ($paymentStatus == 2) { 
                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful.',
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
        
        // date_default_timezone_set('Asia/Kolkata');
        // $datetime = now();
    
        // Get product IDs from the cart for the given user
        $product_ids = DB::table('cart')
            ->where('user_id', $user_id)
            ->pluck('product_id')
            ->toArray();
    
        // Start building the query to get order details with product details
        $query = DB::table('orders')
            ->select( DB::raw('DISTINCT orders.order_id as order_id'),
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
    
   
    
//     public function viewcheckout_history(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'user_id' => 'required|integer|exists:users,id',
//         'order_id' => 'required|integer|exists:orders,order_id'
//     ]);

//     if ($validator->fails()) {
//         return response()->json([
//             'success' => false,
//             'message' => $validator->errors()->first(),
//         ], 200);
//     }

//     $order_id = $request->order_id;

//     $order = DB::table('orders')
//         ->where('order_id', $order_id)
//         ->first();

//     if (!$order) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Order not found.',
//         ], 200);
//     }

//     $statusMessage = '';
//     switch ($order->status) {
//         case 0:
//             $statusMessage = 'Order placed.';
//             break;
//         case 1:
//             $statusMessage = 'Order shipped.';
//             break;
//         case 2:
//             $statusMessage = 'Order Out For delivery';
//             break;
//         case 3:
//             $statusMessage = 'Order delivered.';
//             break;
//         default:
//             $statusMessage = 'Unknown status.';
//     }

//     // Update the query to include vendor_id
//     $cartItems = DB::table('cart')
//         ->join('products', 'cart.product_id', '=', 'products.id')
//         ->join('orders', 'orders.order_id', '=', 'cart.order_id')
//         ->join('order_items', 'orders.order_id', '=', 'order_items.order_id')
//         ->join('users', 'users.id', '=', 'cart.user_id')
//         ->where('cart.order_id', $order_id)
//         ->select('cart.product_id', 'products.name', 'products.image', 'cart.quantity', 
//                  'users.id as user_id', 'users.email', 'orders.status as order_status', 
//                  'order_items.status as item_status', 'products.vendor_id', 
//                  'orders.created_at', 'orders.updated_at')
//         ->get();

//     if ($cartItems->isEmpty()) {
//         return response()->json([
//             'success' => false,
//             'message' => 'No products found for this order.',
//         ], 200);
//     }

//     $orderDetails = [];
//     $totalPrice = 0;
//     $shippingAddress = '';

//     foreach ($cartItems as $item) {
//         // Fetching product variant details using the product_id from cart
//         $variant = DB::table('product_variants')
//             ->where('product_id', $item->product_id)
//             ->first();

//         if ($variant) {
//             $price = $variant->price;
//             $percentageOff = $variant->percentage_off;
//             $specialPrice = $variant->special_price;

//             // Calculate total price for this item based on quantity
//             $itemTotalPrice = $specialPrice > 0 ? $specialPrice : $price;
//             $itemTotalPrice *= $item->quantity;

//             // Check for vendor_id and get the shipping address accordingly
//             if (is_null($item->vendor_id)) {
//                 // If vendor_id is NULL, fetch address from users table
//                 $userAddress = DB::table('users')
//                     ->where('id', 1) // Assuming id = 1 is the desired user
//                     ->value('address'); // Replace with the correct column name for address
//                 $shippingAddress = $userAddress;
//             } else {
//                 // If vendor_id exists, fetch address from vendors table
//                 $vendorAddress = DB::table('vendors')
//                     ->where('id', $item->vendor_id)
//                     ->value('shoap_address'); // Assuming 'shop_address' is the column in vendors table
//                 $shippingAddress = $vendorAddress;
//             }

//             // Add item details to the orderDetails array
//             $orderDetails= [
//                 'product_id' => $item->product_id,
//                 'name' => $item->name,
//                 'user_email' => $cartItems->first()->email,
//                 'image' => $item->image,
//                 'quantity' => $item->quantity,
//                 'price' => $price,
//                 'percentage_off' => $percentageOff,
//                 'special_price' => $specialPrice,
//                 'total_price' => $itemTotalPrice,
//                 'status' => $item->item_status,
//                 'shipping_address' => $shippingAddress,
//                 'created_at' => $item->created_at,
//             ];

//             // Accumulate the total price of the order
//             //$totalPrice += $itemTotalPrice;
//         } else {
//             // If variant doesn't exist, return an error or handle it as needed
//             $orderDetails = [
//                 'product_id' => $item->product_id,
//                 'name' => $item->name,
//                 'image' => $item->image,
//                 'quantity' => $item->quantity,
//                 'message' => 'No variant found for this product.',
//             ];
//         }
//     }

//     return response()->json([
//         'success' => true,
//         'message' => 'Order history retrieved successfully.',
//         'order_id' => $order_id,
//         'order_status' => $statusMessage,
//         'order_details' => $orderDetails,
//       // 'total_price' => $totalPrice,
//         // Adding the shipping address to the response
//     ], 200);
// }

public function viewcheckout_history(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|integer|exists:users,id',
        'order_id' => 'required|integer|exists:orders,order_id'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ], 200);
    }

    $order_id = $request->order_id;

    $order = DB::table('orders')
        ->where('order_id', $order_id)
        ->first();

    if (!$order) {
        return response()->json([
            'success' => false,
            'message' => 'Order not found.',
        ], 200);
    }

    $statusMessage = '';
    switch ($order->status) {
        case 0:
            $statusMessage = 'Order placed.';
            break;
        case 1:
            $statusMessage = 'Order shipped.';
            break;
        case 2:
            $statusMessage = 'Order Out For delivery';
            
            // Generate 4-digit OTP when order status is "Out For delivery"
            $otp = rand(1000, 9999);
            
            // Update the OTP in the orders table
            DB::table('orders')
                ->where('order_id', $order_id)
                ->update(['otp' => $otp]);
            
            break;
        case 3:
            $statusMessage = 'Order delivered.';
            break;
        default:
            $statusMessage = 'Unknown status.';
    }

    // Update the query to include vendor_id
    $cartItems = DB::table('cart')
        ->join('products', 'cart.product_id', '=', 'products.id')
        ->join('orders', 'orders.order_id', '=', 'cart.order_id')
        ->join('order_items', 'orders.order_id', '=', 'order_items.order_id')
        ->join('users', 'users.id', '=', 'cart.user_id')
        ->where('cart.order_id', $order_id)
        ->select('cart.product_id', 'products.name', 'products.image', 'cart.quantity', 
                 'users.id as user_id', 'users.email', 'orders.status as order_status', 
                 'order_items.status as item_status', 'products.vendor_id', 
                 'orders.created_at', 'orders.updated_at')
        ->get();

    if ($cartItems->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No products found for this order.',
        ], 200);
    }

    $orderDetails = [];
    $totalPrice = 0;
    $shippingAddress = '';

    foreach ($cartItems as $item) {
        // Fetching product variant details using the product_id from cart
        $variant = DB::table('product_variants')
            ->where('product_id', $item->product_id)
            ->first();

        if ($variant) {
            $price = $variant->price;
            $percentageOff = $variant->percentage_off;
            $specialPrice = $variant->special_price;

            // Calculate total price for this item based on quantity
            $itemTotalPrice = $specialPrice > 0 ? $specialPrice : $price;
            $itemTotalPrice *= $item->quantity;

            // Check for vendor_id and get the shipping address accordingly
            if (is_null($item->vendor_id)) {
                // If vendor_id is NULL, fetch address from users table
                $userAddress = DB::table('users')
                    ->where('id', 1) // Assuming id = 1 is the desired user
                    ->value('address'); // Replace with the correct column name for address
                $shippingAddress = $userAddress;
            } else {
                // If vendor_id exists, fetch address from vendors table
                $vendorAddress = DB::table('vendors')
                    ->where('id', $item->vendor_id)
                    ->value('shoap_address'); // Assuming 'shop_address' is the column in vendors table
                $shippingAddress = $vendorAddress;
            }

            // Add item details to the orderDetails array
            $orderDetails = [
                 'order_id' => $order_id,
        'order_status' => $statusMessage,
                'product_id' => $item->product_id,
                'name' => $item->name,
                'user_email' => $cartItems->first()->email,
                'image' => $item->image,
                'quantity' => $item->quantity,
                'price' => $price,
                'percentage_off' => $percentageOff,
                'special_price' => $specialPrice,
                'total_price' => $itemTotalPrice,
                'status' => $item->item_status,
                'shipping_address' => $shippingAddress,
                'created_at' => $item->created_at,
                 'otp' => $order->otp,
            ];

            // Accumulate the total price of the order
            $totalPrice += $itemTotalPrice;
        } else {
            // If variant doesn't exist, return an error or handle it as needed
            $orderDetails = [
                'product_id' => $item->product_id,
                'name' => $item->name,
                'image' => $item->image,
                'quantity' => $item->quantity,
               
                'message' => 'No variant found for this product.',
                
                
            ];
        }
    }

    return response()->json([
        'success' => true,
        'message' => 'Order history retrieved successfully.',
        // 'order_id' => $order_id,
        // 'order_status' => $statusMessage,
        'order_details' => $orderDetails,
        //'total_price' => $totalPrice,
          // Include OTP in the response (only if it exists)
    ], 200);
}

    
    





  
}