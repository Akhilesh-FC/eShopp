<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
//   public function manageOrders(Request $request)
// {
//     $perPage = $request->input('per_page', 10); 
//     $orders = DB::table('orders')->paginate($perPage);

//     return view('orders.orders', compact('orders'));
// }

public function manageOrders(Request $request)
{
    $perPage = $request->input('per_page', 10); 
    // $orders = DB::table('orders')
    //     ->select('id', 'transaction_id', 'total', 'promo_discount', 'final_total', 'payment_method', 'order_date')  // Ensure all fields are selected
    //     ->paginate($perPage);
    $orders = DB::table('orders')->paginate($perPage);

    return view('orders.orders', compact('orders'));
}



}
