<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function AuthLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            return redirect()->intended('/dashboard');
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    public function AuthIndex()
    {
        return view('Auth.login');
    }

    
    public function register(Request $request){
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        if($validate->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validate->errors()->first(),
            ],401);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            //'data'=> $user->id()
        ],200);
    }
}




