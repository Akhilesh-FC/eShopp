<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard_index(){
        
        $userId = $request->session()->get('id');

        if (!empty($userId))
        {
            return view('index');
        } else {
        return redirect()->route('login');  
    }
        
        
    }
}
