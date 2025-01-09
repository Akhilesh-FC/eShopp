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
    public function notifications(Request $request)
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
    
        $user = DB::table('users')
            ->where('id', $request->user_id)
            ->first();
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'No users found for this user ID'
            ], 200);
        }
    
        $cartProducts = DB::table('cart')
            ->where('user_id', $request->user_id)
            ->where('status', 0)  // Status 0 means "product add to cart"
            ->get();
    
        if ($cartProducts->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No products added to the cart with status 0'
            ], 200);
        }
    
        $productDetails = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id') 
            ->where('cart.user_id', $request->user_id)
            ->where('cart.status', 0)  // Status 0 means "product add to cart"
            ->select('products.id as id', 'products.name','products.short_description','products.image', 'cart.special_price', 'cart.quantity')  
            ->get();
    
        if ($productDetails->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No products found in the cart matching the criteria',
            ], 200);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'There are products in your cart with status 0',
            'products' => $productDetails
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




