<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class SystemController extends Controller 
{
    public function privacy_policy()  
    { 
        $settings = DB::select("SELECT `value` FROM `settings` WHERE `id`=2"); 
        return view('system.privacypolicy', compact('settings'));
    }
    
    public function term_condition()
    {
        $settings = DB::select("SELECT 'value' FROM 'Settings' WHERE 'id'=3");
        return view('system.privacypolicy', compact('settings'));
    }
    
  
    
}
