<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session; // Don't forget to import Session

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

        // Query the user with email and ID = 1
        $user = DB::table('users')->where('email', $request->email)->where('id', 1)->first();

        // Check if user exists and password matches
        if ($user && $user->password == $request->password) {
            // Store user data in session
            Session::put('user_id', $user->id);
            Session::put('user_email', $user->email);

            // Redirect to the dashboard
            return redirect()->route('dashboard'); // Change this to your desired route
        }

        // Return back with an error if login fails
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // public function logout()
    // {
    //     // Clear the session data on logout
    //     Session::flush();
    //     return redirect()->route('login'); // Redirect to login
    // }
    public function logout(Request $request)
{
    // Clear specific session data
    Session::forget('user_id');
    Session::forget('user_email');
    
    // Or, to clear all session data (this is useful if you want to clear all session data)
    // Session::flush();

    // Redirect the user to the login page
    return redirect()->route('login');
}

    
}
