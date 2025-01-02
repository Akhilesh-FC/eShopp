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
        $orders = DB::table('orders', 'desc')->paginate($perPage);
    
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



}
