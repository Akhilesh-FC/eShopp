<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class VendorApiController extends Controller
{
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
    
    public function vendor_register(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:vendor,email',
            'mobile' => 'required|string|unique:vendor,mobile',
            'address' => 'required|string',
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
                'address' => $request->address,
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
  
public function add_product(Request $request)
{
    $validator = Validator::make($request->all(), [
        'categories' => 'required|string',
        'subcategories' => 'required|string',
        'name' => 'required|string|max:255',
        'tags' => 'required|string|max:255',
        'short_description' => 'required|string',
        'total_allowed_quantity' => 'required|integer|min:1',
        'minimum_order_quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'discount' => 'required|numeric|min:0',
        'special_price' => 'required|numeric|min:0',
        'main_image' => 'required|string', 
        'other_images.*' => 'required|string', 
    ]);
    
    $validator->stopOnFirstFailure();
    
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => $validator->errors()->first(),
        ], 200);
    }
    
    $productFolderName = Str::slug($request->input('name'));
    $imagePaths = [];
    
    if ($request->input('main_image')) {
        $mainImageUrl = $this->handleBase64Image($request->input('main_image'), $productFolderName);
        $imagePaths[] = $mainImageUrl;
    } elseif ($request->hasFile('main_image')) {
        $mainImage = $request->file('main_image');
        $mainImagePath = $mainImage->storeAs('product/' . $productFolderName, $mainImage->getClientOriginalName(), 'public');
        $mainImageUrl = asset('public/' . $mainImagePath);
        $imagePaths[] = $mainImageUrl;
    }
    
    if ($request->has('other_images')) {
        $otherImages = is_array($request->input('other_images')) ? $request->input('other_images') : [$request->input('other_images')];
        foreach ($otherImages as $base64Image) {
            if ($base64Image) {
                $imageUrl = $this->handleBase64Image($base64Image, $productFolderName);
                $imagePaths[] = $imageUrl;
            }
        }
    }
    
 
    $encodedImagePaths = json_encode($imagePaths);
    
 
    $productId = DB::table('products')->insertGetId([
        'name' => $request->input('name'),
        'tags' => $request->input('tags'),
        'short_description' => $request->input('short_description'),
        'total_allowed_quantity' => $request->input('total_allowed_quantity'),
        'minimum_order_quantity' => $request->input('minimum_order_quantity'),
        'category_id' => $request->input('categories'),
        'image' => $encodedImagePaths,
    ]);
    
    DB::table('product_variants')->insert([
        'product_id' => $productId,
        'price' => $request->input('price'),
        'percentage_off' => $request->input('discount'),
        'special_price' => $request->input('special_price'),
    ]);
    
    return response()->json([
        'success' => true,
        'message' => 'Product added successfully',
        'data' => [
            'product_id' => $productId,
            'images' => json_decode($encodedImagePaths),
        ],
    ], 200);
}

//Handle base64 image data (helper function)
// private function handleBase64Image($base64Image, $folderName)
// {
//     $imageData = explode(',', $base64Image)[1];
//     $imageData = base64_decode($imageData);
//     $imageName = uniqid() . '.png'; // Generate a unique name for the image
//     $path = public_path('storage/product/' . $folderName . '/' . $imageName); 
    
//     // Ensure the directory exists
//     if (!file_exists(dirname($path))) {
//         mkdir(dirname($path), 0777, true);
//     }
    
//     // Save the image to the folder
//     file_put_contents($path, $imageData);
    
//     // Return the URL of the saved image
//     return asset('storage/product/' . $folderName . '/' . $imageName);
// }

    
    
    
    
    // public function add_product(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'categories' => 'required|string',
    //         'subcategories' => 'required|string',
    //         'name' => 'required|string|max:255',
    //         'tags' => 'required|string|max:255',
    //         'short_description' => 'required|string',
    //         'total_allowed_quantity' => 'required|integer|min:1',
    //         'minimum_order_quantity' => 'required|integer|min:1',
    //         'price' => 'required|numeric|min:0',
    //         'discount' => 'required|numeric|min:0',
    //         'special_price' => 'required|numeric|min:0',
    //         'main_image' => 'required|string', 
    //         'other_images.*' => 'required|string', 
    //     ]);
    
    //     $validator->stopOnFirstFailure();
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $validator->errors()->first(),
    //         ], 200);
    //     }
        
    //     $imagePaths = [];
    
       
    //     if ($request->input('main_image')) {
            
    //         $mainImageUrl = $this->handleBase64Image($request->input('main_image'));
    //         $imagePaths[] = $mainImageUrl;
    //     } elseif ($request->hasFile('main_image')) {
           
    //         $mainImage = $request->file('main_image');
    //         $mainImagePath = $mainImage->store('product', 'public');
    //         $mainImageUrl = asset('storage/' . $mainImagePath);  
    //         $imagePaths[] = $mainImageUrl;  
    //     }
    
    //     if ($request->has('other_images')) {
            
    //         $otherImages = is_array($request->input('other_images')) ? $request->input('other_images') : [$request->input('other_images')];
        
    //         foreach ($otherImages as $base64Image) {
    //             if ($base64Image) {
    //                 $imageUrl = $this->handleBase64Image($base64Image,);
    //                 $imagePaths[] = $imageUrl;
    //             }
    //         }
    //     }
       
    
    //     $encodedImagePaths = json_encode($imagePaths);
    // //print_r($imagePaths); die();
       
    //     $productId = DB::table('products')->insertGetId([
    //         'name' => $request->input('name'),
    //         'tags' => $request->input('tags'),
    //         'short_description' => $request->input('short_description'),
    //         'total_allowed_quantity' => $request->input('total_allowed_quantity'),
    //         'minimum_order_quantity' => $request->input('minimum_order_quantity'),
    //         'category_id' => $request->input('categories'),
    //         'image' => $encodedImagePaths,
    //     ]);
    //     // print_r($mainImageUrl); die();
    
    //     DB::table('product_variants')->insert([
    //         'product_id' => $productId,
    //         'price' => $request->input('price'),
    //         'percentage_off' => $request->input('discount'),
    //         'special_price' => $request->input('special_price'),
    //     ]);
    
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Product added successfully',
    //         'data' => [
    //             'product_id' => $productId,
    //             'images' => json_decode($encodedImagePaths),
    //         ],
    //     ], 200);
    // }
 
    // public function add_product(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'categories' => 'required|string',
    //         'subcategories' => 'required|string',
    //         'name' => 'required|string|max:255',
    //         'tags' => 'required|string|max:255',
    //         'short_description' => 'required|string',
    //         'total_allowed_quantity' => 'required|integer|min:1',
    //         'minimum_order_quantity' => 'required|integer|min:1',
    //         'price' => 'required|numeric|min:0',
    //         'discount' => 'required|numeric|min:0',
    //         'special_price' => 'required|numeric|min:0',
    //         'main_image' => 'required|string',
    //         'other_images.*' => 'required|string',
    //     ]);
    
    //     $validator->stopOnFirstFailure();
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $validator->errors()->first(),
    //         ], 200);
    //     }
        
    //     $imagePaths = [];
    
    //     $mainImagePath = '';
    //     if ($request->hasFile('main_image')) {
    //         $mainImage = $request->file('main_image');
    //         // Store the main image and get its URL path
    //         $mainImagePath = $mainImage->store('products', 'public');
    //         $mainImageUrl = asset('storage/' . $mainImagePath);  
    //         $imagePaths[] = $mainImageUrl;  
    //     }
    
    //     if ($request->hasFile('other_images')) {
    //         foreach ($request->file('other_images') as $image) {
    //             $imagePath = $image->store('products/other_images', 'public');    
    //             $imageUrl = asset('storage/' . $imagePath);  
    //             $imagePaths[] = $imageUrl;  
    //         }
    //     }
    
    //     $encodedImagePaths = json_encode($imagePaths);
    
    //     $productId = DB::table('products')->insertGetId([
    //         'name' => $request->input('name'),
    //         'tags' => $request->input('tags'),
    //         'short_description' => $request->input('short_description'),
    //         'total_allowed_quantity' => $request->input('total_allowed_quantity'),
    //         'minimum_order_quantity' => $request->input('minimum_order_quantity'),
    //         'category_id' => $request->input('categories'),
    //         'image' => $encodedImagePaths,
    //     ]);
        
    //     DB::table('product_variants')->insert([
    //         'product_id' => $productId,
    //         'price' => $request->input('price'),
    //         'percentage_off' => $request->input('discount'),
    //         'special_price' => $request->input('special_price'),
    //     ]);
        
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Product added successfully',
    //         'data' => [
    //             'product_id' => $productId,
    //             'images' => json_decode($encodedImagePaths),
    //         ],
    //     ], 200);
        
    // }
    
}