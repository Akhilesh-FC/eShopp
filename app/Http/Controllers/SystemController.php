<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class SystemController extends Controller 
{
    public function privacy_policy()  
    { 
        $settings = DB::select("SELECT `value`,`id` FROM `settings` "); 
        return view('system.privacypolicy', compact('settings'));
    }

    public function shipping_policy()  
    { 
        $settings = DB::select("SELECT `value`,`id` FROM `settings` "); 
        return view('system.shippingpolicy', compact('settings'));
    }
    
    public function about_us()  
    { 
        $settings = DB::select("SELECT `value`,`id` FROM `settings` "); 
        return view('system.aboutus', compact('settings'));
    }
    
    public function contact_us()  
    { 
        $settings = DB::select("SELECT `value`,`id` FROM `settings` "); 
        return view('system.contactus', compact('settings'));
    }
    
    public function return_policy()  
    { 
        $settings = DB::select("SELECT `value`,`id` FROM `settings` ");    
        return view('system.returnpolicy', compact('settings'));    
    }
    
    public function admin_policies()  
    {
        $settings =DB::table("SELECT `value`,`id` FROM `settings` ");
        return view('system.adminpolicies', compact('settings')); 
    } 
    
    public function update_privacy(Request $request)  
    {
        $id = $request->id;
        $desc = $request->description;
        //dd($id,$desc);
        $update = DB::table('settings')
                    ->where('id', $id)
                    ->update(['value' => $desc]);
    
        if ($update) {
            return redirect()->back()->with('success', 'Updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update settings.');
        }
    }
    
    
    
    
  
    
}
