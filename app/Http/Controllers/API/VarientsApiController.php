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
  public function send_notifications(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:users,id'
    ]);

    $validator->stopOnFirstFailure();

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first()
        ], 200);
    }

    $userId = $request->user_id;

    // Fetch cart and order statuses for the user, including product details
    $results = DB::table('cart')
        ->select(DB::raw('DISTINCT cart.user_id, cart.status AS cart_status, orders.status AS order_status, 
                            products.image AS product_image, products.name AS product_name, products.short_description AS product_description,
                            cart.created_at AS added_to_cart_date, orders.created_at AS order_date'))
        ->leftJoin('orders', 'orders.user_id', '=', 'cart.user_id')
        ->leftJoin('products', 'products.id', '=', 'cart.product_id') // Assuming cart has product_id
        ->where('cart.user_id', $userId)  // Target a specific user or remove for all users
        ->get();

    // Loop through the results and send notifications for each user
    foreach ($results as $result) {
        // Get the user's cart status, order status, and product details
        $cartStatus = $result->cart_status;
        $orderStatus = $result->order_status;
        $productImage = $result->product_image;
        $productName = $result->product_name;
        $productDescription = $result->product_description;
        $addedToCartDate = $result->added_to_cart_date;
        $orderDate = $result->order_date;

        // Check cart status and respond accordingly
        if ($cartStatus == 0) {
            return response()->json([
                'success' => true,
                'message' => 'Item added to cart. Proceed to checkout.',
                'product_details' => [
                    'name' => $productName,
                    'image' => $productImage,
                    'description' => $productDescription,
                    'added_to_cart_date' => $addedToCartDate
                ]
            ], 200);
        }

        // Fetch order details
        $order = DB::table('orders')->where('user_id', $result->user_id)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'No order found for this user.',
            ], 200);
        }

        // Get the order status and fetch the notification message
        $status = $order->status;  // Assuming status is an integer (0, 1, 2, 3)

        // Fetch the notification title and message based on the order status
        $notification = DB::table('notifications_type')
            ->where('status', $status)
            ->first();

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'No notification found for this status.',
            ], 200);
        }

        // Insert notification into the notifications table
        $notificationId = DB::table('notifications')->insertGetId([
            'user_id' => $result->user_id,
            'title' => $notification->title,
            'date_sent' => now(),
           
        ]);

        // Return notification details along with product info
        return response()->json([
            'success' => true,
            'message' => $notification->title,
            'notification_status' => $notification->name,
            'notification_data' => [
                'title' => $notification->title,
                'message' => $notification->message ?? 'No message available.',
            ],
            'notification_id' => $notificationId,
            'product_details' => [
                'name' => $productName,
                'image' => $productImage,
                'description' => $productDescription,
                'order_date' => $orderDate
            ]
        ], 200);
    }

    return response()->json([
        'success' => false,
        'message' => 'No users found with the specified cart and order statuses.',
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




