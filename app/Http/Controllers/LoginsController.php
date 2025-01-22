<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session; // Don't forget to import Session
use Illuminate\Http\RedirectResponse;


class LoginsController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Load your login view
    }
    
    public function login(Request $request)
    {
        // Validate the login data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Query the user with email and id = 1
        $user = DB::table('users')->where('email', $request->email)->where('id', 1)->first();
    
        // Check if user exists and password matches
        if (!$user) {
            // If user does not exist
            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }
    
        // Check password match
        if ($user->password !== $request->password) {
            // If password does not match
            return back()->withErrors(['password' => 'Invalid credentials.'])->withInput();
        }
    
        // If everything matches, store user data in session
        Session::put('user_id', $user->id);
        Session::put('user_email', $user->email);
    
        // Redirect to the dashboard
        return redirect()->route('dashboard'); // Change this to your desired route
    }



    // public function login(Request $request)
    // {
    //     // Validate the login data
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // Query the user with email and ID = 1
    //     $user = DB::table('users')->where('email', $request->email)->where('id', 1)->first();

    //     // Check if user exists and password matches
    //     if ($user && $user->password == $request->password) {
    //         // Store user data in session
    //         Session::put('user_id', $user->id);
    //         Session::put('user_email', $user->email);

    //         // Redirect to the dashboard
    //         return redirect()->route('dashboard'); // Change this to your desired route
    //     }

    //     // Return back with an error if login fails
    //     return back()->withErrors(['email' => 'Invalid credentials.']);
    // }

    // public function logout()
    // {
    //     // Clear the session data on logout
    //     Session::flush();
    //     return redirect()->route('login'); // Redirect to login
    // }
//     public function logout(Request $request)
// {
//     // Clear specific session data
//     Session::forget('user_id');
//     Session::forget('user_email');
    
//     //Or, to clear all session data (this is useful if you want to clear all session data)
//     Session::flush();

//     // Redirect the user to the login page
//     return redirect()->route('login');
// }

    public function logout(Request $request): RedirectResponse
    {
        
           $request->session()->forget('id');
		 session()->flash('msg_class','success');
            session()->flash('msg','Logout Successfully ..!');
     
         return redirect()->route('login')->with('success','Logout Successfully ..!');
    }
    
//     public function password_change(Request $request)
//     {
	 
	   
//         $validator = Validator::make($request->all(), [
//             'email' => 'required|email',
//             'password' => 'required',
//             'npassword' => 'required|min:6',
// 			'otp' => 'required'
//         ]);
    
//         if ($validator->fails()) {
//             return redirect()->route('change_password')
//                 ->withErrors($validator)
//                 ->withInput();
//         }
    
//         $user = DB::table('users')->where('email', $request->input('email'))->first();
    
//         if ($user) {
//             if ($request->input('password') === $user->password) {
//     $otp=DB::table('otp_sms')->where('otp', $request->input('otp'))->where('mobile','6306790692')->first();
// 				if($otp==null)
// 				{
// 				session()->flash('msg_class', 'danger');
//                 session()->flash('msg', 'Please Enter valid OTP.');	
// 				}
// 				else
// 				{
// 					DB::table('users')
// 						->where('email', $request->input('email'))
// 						->update(['password' => $request->input('npassword')]);

// 					session()->flash('msg_class', 'success');
// 					session()->flash('msg', 'Password successfully changed.');
// 					return redirect()->route('dashboard');
// 				}
//             } else {
//                 session()->flash('msg_class', 'danger');
//                 session()->flash('msg', 'Current password is incorrect.');
//             }
//         } else {
//             session()->flash('msg_class', 'danger');
//             session()->flash('msg', 'The provided email does not match our records.');
//         }
    
//         return redirect()->route('change_password')->withInput();
//     }
    
}

