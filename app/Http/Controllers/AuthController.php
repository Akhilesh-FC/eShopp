<?php
namespace App\Http\Controllers;

use Validator;

use App\Http\Controllers\AuthController;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user && $user->password == $request->password) {
            session(['user_id' => $user->id, 'email' => $user->email]);

            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['Invalid credentials.']);
        }
    }
    public function logout()
    {
        session()->flush(); 
        return redirect()->route('login');
    }
}
