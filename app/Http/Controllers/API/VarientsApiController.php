<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class VarientsApiController extends Controller
{
    public function get_promo_codes(){
            $userCartData = DB::table('promo_codes')
            ->get();
        
        if (empty($userCartData)) {
            return response()->json([
                'status' => false,
                'error' => 'No coupon data found'
            ], 200);
        }else{
            return response()->json([
             'data'=>$userCartData,
        'status' => 200,
        'message' => 'Promo Code data found',
        ], 200);
    
        }
          
    }
    
    
    public function send_notifications(Request $request)
    {
        // Validate the request input
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);
    
        // Stop validation on the first failure
        $validator->stopOnFirstFailure();
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }
    
        $userId = $request->user_id;
    
        // Fetch cart and order statuses for the user, including product details (get all results)
        $results = DB::table('cart')
            ->leftJoin('orders', 'orders.user_id', '=', 'cart.user_id')
            ->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->select(
                'cart.user_id',
                'cart.status AS cart_status',
                DB::raw('MAX(orders.status) AS order_status'),
                DB::raw('MAX(orders.id) AS order_id'),
                'cart.product_id',
                DB::raw('MAX(products.image) AS product_image'),
                DB::raw('MAX(products.name) AS product_name'),
                DB::raw('MAX(products.short_description) AS product_description'),
                DB::raw('MAX(cart.created_at) AS added_to_cart_date'),
                DB::raw('MAX(orders.created_at) AS order_date')
            )
            ->where('cart.user_id', $userId)
            ->groupBy('cart.user_id', 'cart.status', 'cart.product_id')
            ->get(); // Use get() to retrieve all matching rows
    
        // If no results found, return an error message
        if ($results->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No items found in cart or no orders for this user.',
            ], 200);
        }
    
        // Loop through the results and send notifications for each user
        $notificationData = [];
    
        foreach ($results as $result) {
            $cartStatus = $result->cart_status;
            $orderStatus = $result->order_status;
            $orderId = $result->order_id;
            $productId = $result->product_id;
            $productImage = json_decode($result->product_image); // Assuming images are stored as a JSON array
            $productName = $result->product_name;
            $productDescription = $result->product_description;
            $addedToCartDate = $result->added_to_cart_date;
            $orderDate = $result->order_date;
    
            // Handle cart status: if cart status is 0, send message about proceeding to checkout
            // if ($cartStatus == 0) {
            //     $notificationData[] = [
            //         'message' => 'Item added to cart. Proceed to checkout.',
            //         'product_details' => [
            //             'name' => $productName,
            //             'image' => $productImage,
            //             'description' => $productDescription,
            //             'added_to_cart_date' => $addedToCartDate,
            //             'product_id' => $productId
            //         ]
            //     ];
            // }
    
            // Fetch order details based on the order ID
            $order = DB::table('orders')->where('id', $orderId)->first();
    
            // If no order found, continue to the next item
            if (!$order) {
                continue;
            }
    
            // Fetch the notification title based on the order status from the notifications_type table
            $notification = DB::table('notifications_type')
                ->where('status', $order->status)
                ->first();
    
            // If no notification found for this status, continue to the next item
            if (!$notification) {
                continue;
            }
    
            // Insert notification into the notifications table
            DB::table('notifications')->insert([
                'user_id' => $result->user_id,
                'title' => $notification->title,
                'date_sent' => now(),
            ]);
    
            // Add notification data to the response
            $notificationData[] = [
                'notification_status' => $notification->title,
                'product_name' => $productName,
                'image' => $productImage,
                'description' => $productDescription,
                'order_date' => $orderDate,
                'product_id' => $productId
            ];
        }
    
        // Return notification data (all data from loop)
        return response()->json([
            'success' => true,
            'message' => 'Statuses retrieved successfully',
            'notification_data' => $notificationData
        ], 200);
    }



    public function notification_type()
    {
        $notification_type = DB::table('notifications_type')->select('id', 'name')->get();
   
        if ($notification_type){
            return response()->json(
                [
                    'message' => 'Successfuly fetched',
                    'status' => 200,
                    'data' => $notification_type
                    ]);
        }else{
            return response()->json(['message' => 'No record found',
            'status' => 200,
            'data' => []], 200);
        }
    }
    
    public function get_color()
    {
        $colors = DB::table('color')
                    ->where('status', 1)
                    ->select('id', 'name', 'color') 
                    ->get();
    
        if ($colors->isNotEmpty()) {
            return response()->json([
                'message' => 'Successfully fetched',
                'status' => 200,
                'data' => $colors
            ]);
        } else {
            return response()->json([
                'message' => 'No record found',
                'status' => 200,
                'data' => []
            ], 200);
        }
    }

    
    public function get_size()
    {
        $sizes = DB::table('size')->where('status',1)->select('id','size')->get();
        
        if ($sizes->isNotEmpty()) {
            return response()->json([
                'message'=> 'Successfully fetched',
                'status' => 200,
                'data' => $sizes
            ]);
        } else {
            return response()->json([
                'message' => 'No record found',
                'status' => 200,
                'data' => []
            ], 200);
        }
    }
}




