<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function dashboard_index(){
        
        // $userId = $request->session()->get('id');

        // if (!empty($userId))
        // {
             $totalorders = DB::table('orders')->count();
            //  dd($totalorders);
              $newsingup = DB::table('users')->count();
              
              $vendor = DB::table('vendor')->count();
              $products = DB::table('products')->count();
            
            return view('admin.index')->with('totalorders',$totalorders)->with('newsingup',$newsingup)->with('vendor',$vendor)->with('products',$products);
    //     } else {
    //     return redirect()->route('login');  
    // }
    }
    
   
}
 