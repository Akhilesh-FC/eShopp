f<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PublicApiController extends Controller
{
    // Registration API
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string|unique:users,mobile',
        ]);
        
        $mobile = $request->mobile;

        if ($validator->fails()) {
            return response()->json([
                'success' => 400,
                'message' => $validator->errors()->first()
            ], 200);
        }

        $user = DB::table('users')->insert([
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $mobile,
        ]);
        if ($user) {
            $userss = DB::table('users')->where('mobile', $mobile)->first();
            $id=$userss->id;
           // dd($id);
            // OTP sending logic can be added here
            return response()->json([
                'data'=> $id,
                'success' => 200,
                'message' => 'Registration successful. OTP sent!',
            ], 200);
        } else {
            return response()->json([
                'success' => 400,
                'message' => 'Registration failed',
            ], 200);
        }
    }

    // Login API
    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'mobile' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => 200,
    //             'message' => $validator->errors()
    //         ], 400);
    //     }
        

    //     $user = DB::table('users')->where('mobile', $request->mobile)->first();
       
    //     if ($user) {
    //         // Here you would integrate your OTP sending logic
    //         $otp = rand(100000, 999999); // Generating a 6-digit OTP
    //         // Send OTP using a third-party service
    //         // Example: Http::post('your-otp-api-endpoint', ['otp' => $otp, 'mobile' => $request->mobile]);

    //         return response()->json([
    //             'success' => 200,
    //             'message' => 'OTP sent successfully',
    //         ], 200);
    //     } else {
            
    //         return response()->json([
    //             'success' => 400,
    //             'message' => 'You are not registered. Please register first.',
    //         ], 200);
    //     }
    // }
    
    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 2,
                'message' => $validator->errors()->first(),
            ], 400);
        }
    
        // Check if the user exists
        $user = DB::table('users')->where('mobile', $request->mobile)->first();
    
        if ($user) {
            // Generate and send OTP
            $otp = rand(100000, 999999);
            // Example: Call your OTP service here
            // Http::post('your-otp-api-endpoint', ['otp' => $otp, 'mobile' => $request->mobile]);
    
            return response()->json([
                'success' => true,
                'status' => 0,
                'message' => 'OTP sent successfully.',
                'data' => $user->id,
            ], 200);
        } else {
            // User not registered
            return response()->json([
                'success' => false,
                'status' => 1,
                'message' => 'You are not registered. Please register first.',
            ], 200);
        }
    }
    
    
        // Verify OTP API
    public function verifyOtp(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'mobile' => 'required|string',
                'otp' => 'required|numeric',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ], 400);
            }
    
            // Example OTP verification logic
            // This should be replaced with the actual verification method
            if ($request->otp == '123456') { // Replace '123456' with your actual OTP verification logic
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP',
                ], 400);
            }
        }
        
    public function showSliders()
    {
            // Fetch all sliders from the database
            $sliders = DB::table('sliders')->select('id', 'type', 'type_id', 'image', 'date_added')->get();
    
            // Return the sliders as a JSON response
            return response()->json([
                'success' => true,
                'data' => $sliders,
            ], 200);
        }
        
    }
