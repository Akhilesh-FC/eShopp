<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ListController extends Controller
{
      public function tokens()
    { 
    $token = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);

      //dd($token);
        $insert = DB::table('token')->insert(['token' => $token]);
    
        if ($insert) {
            return response()->json([
                'message' => 'Success',
                'status' => true,
                'data' => ['token' => $token] 
            ]);
        } else {
            return response()->json([
                'message' => 'failed',
                'status' => false,
                'data' => []
            ], 400);
        }
    }
    
}