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
    private function handleBase64Image($base64Image,$path)
    {
        if ($base64Image) {
                $imageData = base64_decode($base64Image);
                $imageName = $path.'/' . uniqid() . '.png'; 
                 $baseUrl = env('APP_URL', 'https://free2kart.tirangawin.club') . '/public/';
                file_put_contents(public_path($imageName), $imageData);
               return $input = $baseUrl.$imageName; 
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
            'size' => 'required|string',
            'color' => 'required|string',
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
        
        $imagePaths = [];
    
        if ($request->input('main_image')) {
            
            $mainImageUrl = $this->handleBase64Image($request->input('main_image'),"product");
            $imagePaths[] = $mainImageUrl;
        } elseif ($request->hasFile('main_image')) {
           
            $mainImage = $request->file('main_image');
            $mainImagePath = $mainImage->store('product', 'public');
            $mainImageUrl = asset('storage/' . $mainImagePath);  
            $imagePaths[] = $mainImageUrl;  
        }
    
        if ($request->has('other_images')) {
            
            $otherImages = is_array($request->input('other_images')) ? $request->input('other_images') : [$request->input('other_images')];
        
            foreach ($otherImages as $base64Image) {
                if ($base64Image) {
                    $imageUrl = $this->handleBase64Image($base64Image,"product");
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
        // print_r($mainImageUrl); die();
        DB::table('product_variants')->insert([
            'product_id' => $productId,
            'size' => $request->input('size'),
            'color' => $request->input('color'),
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
            $path="profileimage";
            $uploadAdharcardDataimagePath = $this->handleBase64Image($uploadAdharcardData,$path);
            $upload_photoimagePath = $this->handleBase64Image($upload_photo,$path);
            $upload_gstimagePath = $this->handleBase64Image($upload_gst,$path);
            $upload_panimagePath = $this->handleBase64Image($upload_pan,$path);
         
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
    
    public function view_products_by_vendor($vendorId)
    {
        // Step 1: Validate if the vendor exists
        $vendor = DB::table('vendor')->where('id', $vendorId)->first();
    
        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Vendor not found',
            ], 200);
        }
    
        // Step 2: Fetch all products added by this vendor
        $products = DB::table('products')
            ->where('vendor_id', $vendorId)
            ->get();
    
        if ($products->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No products found for this vendor',
            ], 200);
        }
    
        // Step 3: Prepare the product data including variants and special prices
        $productsData = [];
        foreach ($products as $product) {
            // Get product variants for each product (only fetch special price)
            $productVariants = DB::table('product_variants')
                ->where('product_id', $product->id)
                ->get();
    
            // Decode images
            $images = json_decode($product->image, true);
    
            // Prepare the data for each product
            $productsData[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'image' => $images ? $images[0] : null, // First image as main image
                'total_allowed_quantity' => $product->total_allowed_quantity, // From the products table
                'special_prices' => $productVariants->pluck('special_price'), // Get special prices from variants
            ];
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Products fetched successfully',
            'data' => $productsData,
        ], 200);
    }



   
 
}