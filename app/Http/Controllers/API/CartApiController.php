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
        // Validate incoming request
        $request->validate([
            'user_id' => 'required|integer|exists:users,id', // Ensure user exists
            'product_id' => 'required|integer|exists:products,id', // Ensure product exists
            'quantity' => 'required|integer|min:1', // Ensure quantity is a positive integer
        ]);
    
        // Check if the product already exists in the user's cart using a raw query
        $existingCartItem = DB::table('cart')
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();
    
        if ($existingCartItem) {
            // If the item exists, update the quantity
            DB::table('cart')
                ->where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->update([
                    'quantity' => $existingCartItem->quantity + $request->quantity
                ]);
        } else {
            // If the item does not exist, insert a new record into the cart table
            DB::table('cart')->insert([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'created_at' => now(), // Set current timestamp
                'updated_at' => now(), // Set current timestamp
            ]);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Product added to the cart successfully',
        ], 200);
    }



}