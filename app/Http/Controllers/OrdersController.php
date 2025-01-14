<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{

    public function manageOrders(Request $request)
    {
         $search = $request->input('search'); 
        $perPage = $request->input('per_page', 5); 
        $orders = DB::table('orders', 'desc')->when($search, function ($query, $search) {
                    return $query->where('order_id', 'LIKE', "%{$search}%")
                                 ->orWhere('transaction_id', 'LIKE', "%{$search}%")
                                 ->orWhere('payment_method', 'LIKE', "%{$search}%");
                })->paginate($perPage);
    
        return view('orders.orders', compact('orders'));
    }
    
    public function viewOrderDetails($orderId)
    {
        $order = DB::table('orders')->where('id', $orderId)->first(); 
        $products = DB::table('products')
                      ->join('orders', 'products.id', '=', 'orders.id')
                      ->where('orders.id', $orderId)
                      ->select('products.*')
                      ->get(); 
    
        if (!$order) {
            return redirect()->route('orders')->with('error', 'Order not found');
        }
        return view('orders.userorderdetails', compact('order', 'products'));
    }
    
    // public function updateOrderStatus(Request $request, $orderId)
    // {
    //     $validated = $request->validate([
    //         'status' => 'required|in:0,1,2,3', // Validating the possible status values (0, 1, 2, 3)
    //     ]);
    
    //     $order = DB::table('orders')->where('order_id', $orderId)->first();
  
    //     if (!$order) {
    //         return redirect()->route('orders')->with('error', 'Order not found');
    //     }
    
    //     DB::table('orders')->where('order_id', $orderId)->update([
    //         'status' => $request->status
    //     ]);
    
    //     return redirect()->route('view_orderdetails', ['orderId' => $orderId])->with('success', 'Order status updated successfully!');
    // }
public function updateOrderStatus(Request $request, $orderId)
{
    $validated = $request->validate([
        'status' => 'required|in:0,1,2,3', // Validating the possible status values (0, 1, 2, 3)
    ]);
    
    // Retrieve the order
    $order = DB::table('orders')->where('order_id', $orderId)->first();

    if (!$order) {
        return redirect()->route('orders')->with('error', 'Order not found');
    }

    // Check if the status is "Out For Delivery" (status 2)
    if ($request->status == 2) {
        // Generate a 4-digit OTP
        $otp = rand(1000, 9999);

       

        // Store the OTP in the orders table
        DB::table('orders')->where('order_id', $orderId)->update([
            'otp' => $otp
        ]);
    }

    // Update status in 'orders' table
    DB::table('orders')->where('order_id', $orderId)->update([
        'status' => $request->status
    ]);

    // Get current status history from the 'order_items' table (assuming the status is stored in JSON format)
    $orderItemStatusHistory = DB::table('order_items')
        ->where('order_id', $orderId)
        ->pluck('status')  // Assuming status is stored as a JSON string
        ->first();

    // Check if status history exists; otherwise, initialize it as an empty array
    $statusHistory = json_decode($orderItemStatusHistory, true) ?: [];

    // Prepare the new status entry with the current datetime
    $newStatusEntry = [
        'status' => $this->getStatusText($request->status),  // Convert status code to human-readable text
        'datetime' => now()->toDateTimeString()  // Current datetime
    ];

    // Add the new status entry to the status history array
    $statusHistory[] = $newStatusEntry;

    // Insert the updated status history back into the 'order_items' table
    DB::table('order_items')
        ->where('order_id', $orderId)
        ->update([
            'status' => json_encode($statusHistory)  // Store the updated status history as a JSON string
        ]);

    return redirect()->route('view_orderdetails', ['orderId' => $orderId])
        ->with('success', 'Order status updated successfully!');
}

/**
 * Convert the status code to a human-readable status text.
 *
 * @param int $statusCode
 * @return string
 */
private function getStatusText($statusCode)
{
    switch ($statusCode) {
        case 0:
            return 'orderPlaced';
        case 1:
            return 'orderShipped';
        case 2:
            return 'outForDelivery';
        case 3:
            return 'orderDelivered';
        default:
            return 'unknownStatus';
    }
}




}
