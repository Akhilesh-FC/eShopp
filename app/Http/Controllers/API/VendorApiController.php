<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VendorApiController extends Controller
{

    // public function vendor_register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:vendor,email',
    //         'mobile' => 'required|string|unique:vendor,mobile',
    //         'adharcard' => 'required|string|unique:vendor,adharcard',
    //         'upload_adharcard' => 'required|string',
    //         'upload_photo' => 'required|string',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $validator->errors()->all()
    //         ], 200);
    //     }
    
    //     // Set default paths for the files
    //     $uploadAdharcardPath = 'vendor_adharcard/default.png';
    //     $uploadPhotoPath = 'vendor_images/default.png';
    
    //     // Process upload_adharcard if base64 is provided
    //     if ($request->has('upload_adharcard') && !empty($request->upload_adharcard)) {
    //         $uploadAdharcardData = $request->upload_adharcard;
    
    //         // Check if the data contains the base64 prefix
    //         if (strpos($uploadAdharcardData, 'data:image/') === 0) {
    //             // Remove the prefix (e.g., data:image/png;base64,)
    //             $uploadAdharcardData = explode(',', $uploadAdharcardData);
    
    //             if (count($uploadAdharcardData) == 2) {
    //                 // Decode base64 data
    //                 $fileData = base64_decode($uploadAdharcardData[1]);
    
    //                 // Check if decoding was successful
    //                 if ($fileData !== false) {
    //                     $fileName = uniqid() . '.png'; // You can change the extension based on the file type
    //                     Storage::disk('public')->put('vendor_adharcard/' . $fileName, $fileData);
    //                     $uploadAdharcardPath = 'vendor_adharcard/' . $fileName;
    //                 } else {
    //                     return response()->json([
    //                         'success' => false,
    //                         'message' => 'Failed to decode Adharcard image.'
    //                     ], 200);
    //                 }
    //             } else {
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => 'Invalid base64 data for Adharcard.'
    //                 ], 200);
    //             }
    //         } else {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Invalid Adharcard image format.'
    //             ], 200);
    //         }
    //     }
    
    //     // Process upload_photo if base64 is provided
    //     if ($request->has('upload_photo') && !empty($request->upload_photo)) {
    //         $uploadPhotoData = $request->upload_photo;
    
    //         // Check if the data contains the base64 prefix
    //         if (strpos($uploadPhotoData, 'data:image/') === 0) {
    //             // Remove the prefix (e.g., data:image/png;base64,)
    //             $uploadPhotoData = explode(',', $uploadPhotoData);
    
    //             if (count($uploadPhotoData) == 2) {
    //                 // Decode base64 data
    //                 $fileData = base64_decode($uploadPhotoData[1]);
    
    //                 // Check if decoding was successful
    //                 if ($fileData !== false) {
    //                     $fileName = uniqid() . '.png'; // You can change the extension based on the file type
    //                     Storage::disk('public')->put('vendor_images/' . $fileName, $fileData);
    //                     $uploadPhotoPath = 'vendor_images/' . $fileName;
    //                 } else {
    //                     return response()->json([
    //                         'success' => false,
    //                         'message' => 'Failed to decode Photo image.'
    //                     ], 200);
    //                 }
    //             } else {
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => 'Invalid base64 data for Photo.'
    //                 ], 200);
    //             }
    //         } else {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Invalid Photo image format.'
    //             ], 200);
    //         }
    //     }
    
    //     $baseUrl = env('APP_URL');  
    
    //     $vendor = DB::table('vendor')->insert([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'mobile' => $request->mobile,
    //         'adharcard' => $request->adharcard,
    //         'upload_adharcard' => $baseUrl . '/storage/' . $uploadAdharcardPath,
    //         'vendor_image' => $baseUrl . '/storage/' . $uploadPhotoPath,
    //     ]);
    
    //     if ($vendor) {
    //         $newVendor = DB::table('vendor')->where('mobile', $request->mobile)->first();
    //         $id = $newVendor->id;
    
    //         return response()->json([
    //             'data' => $id,
    //             'success' => true,
    //             'message' => 'Registration successful.',
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Registration failed.',
    //         ], 200);
    //     }
    // }
    
    public function vendor_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:vendor,email',
            'mobile' => 'required|string|unique:vendor,mobile',
            'adharcard' => 'required|string|unique:vendor,adharcard',
            'upload_adharcard' => 'required|string',
            'upload_photo' => 'required|string',
            'shoap_name' => 'required|string',
            'shoap_address' => 'required|string',
            'gst_no' => 'required|string',
            'pan_no' => 'required|string',
            'upload_gst' => 'required|string',
            'upload_pan' => 'required|string',
        ]);
    
      
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ], 200);
        }
    
            $uploadAdharcardData = $request->upload_adharcard;
            $upload_photo = $request->upload_photo;
            $upload_gst = $request->upload_gst;
            $upload_pan = $request->upload_pan;
            
            $uploadAdharcardDataimagePath = $this->handleBase64Image($uploadAdharcardData);
            $upload_photoimagePath = $this->handleBase64Image($upload_photo);
            $upload_gstimagePath = $this->handleBase64Image($upload_gst);
            $upload_panimagePath = $this->handleBase64Image($upload_pan);
         
            $vendor = DB::table('vendor')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'adharcard' => $request->adharcard,
                'shoap_name' => $request->shoap_name,
                'shoap_address' => $request->shoap_address,
                'gst_no' => $request->gst_no,
                'pan_no' => $request->pan_no,
                'upload_adharcard' => $uploadAdharcardDataimagePath,
                'vendor_image' => $upload_photoimagePath,
                'upload_gst' =>$upload_gstimagePath,
                'upload_pan' => $upload_panimagePath,
           ]);
        if ($vendor) {
            $newVendor = DB::table('vendor')->where('mobile', $request->mobile)->first();
            $id = $newVendor->id;
    
            return response()->json([
                'data' => $id,
                'success' => true,
                'message' => 'Registration successful.',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed.',
            ], 200);
        }
    }
   
    
   



    public function vendor_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string',  
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 2,
                'message' => $validator->errors()->first(),
            ], 200);
        }
    
        $user = DB::table('vendor')->where('mobile', $request->mobile)->first();   
    
        if ($user) {
            return response()->json([
                'success' => true,
                'status' => 0,
                'message' => 'Login successful.',
                 'data' => $user->id,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'status' => 1,
                'message' => 'You are not registered. Please register first.',
            ], 200);
        }
    }
    
    // public function viewProfile(Request $request)  
    // {
    //     $validator = Validator::make($request->all(), [
    //         'vendor_id' => 'required|exists:vendor,id', 
    //         // OR if you want to use mobile instead of ID
    //         // 'mobile' => 'required|exists:vendor,mobile', 
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $validator->errors()->all()
    //         ], 200);
    //     }
    
    //     $vendor = DB::table('vendor')->where('id', $request->vendor_id)->first();  
    
    //     if ($vendor) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Vendor profile fetched successfully.',
    //             'data' => $vendor
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Vendor not found.'
    //         ], 404);
    //     }
    // }
    public function viewProfile($vendor_id)
{
    // Validate if the vendor exists with the given ID
    $validator = Validator::make(['vendor_id' => $vendor_id], [
        'vendor_id' => 'required|exists:vendor,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->all()
        ], 200);
    }

    // Fetch the vendor details
    $vendor = DB::table('vendor')->where('id', $vendor_id)->first();

    if ($vendor) {
        return response()->json([
            'success' => true,
            'message' => 'Vendor profile fetched successfully.',
            'data' => $vendor
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Vendor not found.'
        ], 200);
    }
}

    

private function handleBase64Image($base64Image)
{
    if ($base64Image) {
            $imageData = base64_decode($base64Image);
            $imageName = 'profileimage/' . uniqid() . '.png'; 
             $baseUrl = env('APP_URL', 'https://free2kart.tirangawin.club') . '/public/';
            file_put_contents(public_path($imageName), $imageData);
           return $input = $baseUrl.$imageName; 
        }
}



    
   
    
    
}