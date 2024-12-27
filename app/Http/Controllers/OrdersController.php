<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{

    public function manageOrders(Request $request)
    {
        $perPage = $request->input('per_page', 5); 
        $orders = DB::table('orders')->paginate($perPage);
    
        return view('orders.orders', compact('orders'));
    }
    
    public function viewOrderDetails($orderId)
{
    
    //dd($orderId);
    // Fetch the order details from the 'orders' table
    $order = DB::table('orders')->where('id', $orderId)->first(); // Fetch the order by its ID
//dd($order);
    // Fetch the related products (assuming 'order_product' is a pivot table for many-to-many relation)
    $products = DB::table('products')
                  ->join('orders', 'products.id', '=', 'orders.id')
                  ->where('orders.id', $orderId)
                  ->select('products.*')
                  ->get(); // Fetch the related products for this order

    if (!$order) {
        return redirect()->route('orders')->with('error', 'Order not found');
    }
//dd();
    // Pass the order and products data to the view
    return view('orders.userorderdetails', compact('order', 'products'));
}



}
