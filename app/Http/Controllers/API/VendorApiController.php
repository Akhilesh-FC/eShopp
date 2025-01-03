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
            'vendor_id' => 'required|string',
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
            'vendor_id' => $request->input('vendor_id'),
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
            $login_status = $user->active;
            
        if ($login_status == 1) {
                return response()->json([
                    'success' => true,
                    'status' => 0,
                    'active'=> 1,
                    'message' => 'Login successful.',
                    'data' => $user->id,
                ], 200);
            } 
            
            else {
                return response()->json([
                    'success' => false,
                    'status' => 1,
                    'active' => 0,
                    'message' => 'You are blocked by admin. Please contact the admin.',
                ], 200);
            }
        } 
         else {
            return response()->json([
                'success' => false,
                'status' => 1,
                'message' => 'You are not registered. Please register first.',
            ], 200);
        }
    }
   
    public function viewProfile($vendor_id)
    {
        $validator = Validator::make(['vendor_id' => $vendor_id], [
            'vendor_id' => 'required|exists:vendor,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ], 200);
        }
    
        $vendor = DB::table('vendor')->where('id', $vendor_id)->first();
    
        if ($vendor) {
            // Check if the user is active (status = 1)
            if ($vendor->active == 1) {
                return response()->json([
                    'success' => true,
                    'status_message' => 'Vendor is active.',
                    'active'=> 1,
                    'data' => $vendor,
                    
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'active' => 0,
                    'message' => 'Vendor is inactive.',
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Vendor not found.',
            ], 200);
        }
    }
   
    public function view_products_by_vendor($vendorId)
    {
        
        $vendor = DB::table('vendor')->where('id', $vendorId)->first();
    
        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Vendor not found',
            ], 200);
        }
    
        
        $products = DB::table('products')
            ->where('vendor_id', $vendorId)
            ->where('is_vendor', '!=', 2)
           
            ->get();
            
        //  $products = DB::select("SELECT * FROM products WHERE is_vendor != 2 AND vendor_id = ?", [$vendorId]);
    
        if ($products->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No products found for this vendor',
                'data'=>$products
            ], 200);
        }
    
    
        $productsData = [];
        foreach ($products as $product) {
            // Get product variants for each product (only fetch special price)
            $productVariants = DB::table('product_variants')
                ->where('product_id', $product->id)
                ->get();
    
            // Decode images
            $images = json_decode($product->image, true);
    
           
            $specialPrices = null; // Default to null if no special prices are found
                if ($productVariants->isNotEmpty()) {
                    $specialPrices = $productVariants->first()->special_price; // Get the first variant's special price
                }
    
            $productsData[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'image' => $images ? $images[0] : null, // First image as main image
                'total_allowed_quantity' => $product->total_allowed_quantity, // From the products table
                'special_prices' => $specialPrices, // Array of special prices
                'is_vender' => $product->is_vendor, // Array of special prices
            ];
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Products fetched successfully',
            'data' => $productsData,
        ], 200);
    }
    
    public function product_remove(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|integer',
            'product_id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(), 
            ], 200);
        }
    
        $vendor_id = $request->input('vendor_id');
        $product_id = $request->input('product_id');
    
        $product = DB::table('products')
            ->where('id', $product_id)
            ->where('vendor_id', $vendor_id)  
            ->first(); 
    
        // If the product exists, proceed to check and update
        if ($product) {
            // Check if the product's 'is_vendor' status is already 2
            if ($product->is_vendor == 2) {
                // If it's already 2, return a message that no action is needed
                return response()->json([
                    'success' => false,
                    'message' => 'Product is already removed or marked.'
                ], 200);
            }
    
            // Otherwise, update the 'is_vendor' status to 2
            DB::table('products')
                ->where('id', $product_id)
                ->where('vendor_id', $vendor_id)
                ->update(['is_vendor' => 2]); 
    
            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Product removed successfully.'
            ]);
        } else {
            // Return error response if product not found
            return response()->json([
                'success' => false,
                'message' => 'Product not found or does not belong to this vendor.'
            ], 200);
        }
    }
    
    public function enable_disable_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|integer',
            'product_id' => 'required|integer',
            'status' => 'required|in:0,1',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }
    
        $vendor_id = $request->input('vendor_id');
        $product_id = $request->input('product_id');
        $status = $request->input('status');  // 0 for disable, 1 for enable
    
        $product = DB::table('products')
            ->where('id', $product_id)
            ->where('vendor_id', $vendor_id)
            ->first();
    
        if ($product) {
            DB::table('products')
                ->where('id', $product_id)
                ->where('vendor_id', $vendor_id)
                ->update(['is_vendor' => $status]);
    
            return response()->json([
                'success' => true,
                'message' => $status == 1 ? 'Product enabled successfully.' : 'Product disabled successfully.',
            ]);
        } else {
            // Return error response if product not found
            return response()->json([
                'success' => false,
                'message' => 'Product not found or does not belong to this vendor.',
            ], 200);
        }
    }
    
    public function vendor_order_history(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|integer|exists:vendor,id', 
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $orders = DB::table('orders') // Start with the orders table
            ->join('cart', 'orders.user_id', '=', 'cart.user_id')  // Join orders and carts on user_id
            ->join('products', 'cart.product_id', '=', 'products.id')  // Join carts and products on product_id
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')  // Join products and product_variants on product_id 
            ->where('products.vendor_id', $request->vendor_id)  // Filter by vendor_id in the products table
            ->select('orders.created_at','orders.vendor_order_status','orders.order_id', 'products.name', 'products.image', 'product_variants.special_price', 'cart.quantity', 'products.id as product_id')  
            ->get();

        if ($orders->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Order history retrieved successfully.',
                'data' => $orders,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No orders found for this Vendor.',
            ], 200);
        }
    }
    
    public function vendor_order_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|string|exists:vendor,id',
            'product_id' => 'required|string|exists:products,id',
            'vendor_order_status' => 'required|string|in:0,1,4', 
            'order_id' => 'required|string|exists:orders,order_id',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        
        $product = DB::table('products')
            ->where('vendor_id', $request->vendor_id)
            ->where('id', $request->product_id)
            ->first();
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found for the given vendor.',
            ], 200);
        }
        
        $cartEntries = DB::table('cart')
            ->where('product_id', $request->product_id)
            ->get();
        
        if ($cartEntries->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No users have added this product to their cart.',
            ], 200);
        }
        $userIds = $cartEntries->pluck('user_id')->toArray();
 
        $orders = DB::table('orders')
            ->whereIn('user_id', $userIds)
            ->where('order_id', $request->order_id)
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No matching orders found for updating status.',
            ], 200);
        }
        
        $statusMessage = '';
        $newStatus = $request->vendor_order_status;
    
        foreach ($orders as $order) {
        switch ($newStatus) {
            case 0:
                
                DB::table('orders')
                    ->where('id', $order->id)
                    ->update(['vendor_order_status' => 0]);
                $statusMessage = 'Order rejected';
                break;

            case 1:
               
                DB::table('orders')
                    ->where('id', $order->id)
                    ->update(['vendor_order_status' => 1]);
                $statusMessage = 'Order accepted';
                break;

            case 4:
                
                DB::table('orders')
                    ->where('id', $order->id)
                    ->update(['status' => 4]);
                $statusMessage = 'Order dispatched successfully'; 
                break;

            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid order status.',
                ], 200);
        }
    }
    
    
        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully: ' . $statusMessage,
        ], 200);
    }

    // public function vendor_order_dispatch(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'vendor_id' => 'required|integer|exists:vendor,id',
    //         'product_id' => 'required|integer|exists:products,id',
    //         'order_id' => 'required|integer|exists:orders,order_id',
    //         'vendor_order_status' => 'required|integer|in:4',
    //     ]);
        
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $validator->errors()->first(),
    //         ], 200);
    //     }
        
    //     $product = DB::table('products')
    //         ->where('vendor_id', $request->vendor_id)
    //         ->where('id', $request->product_id)
    //         ->first();
        
    //     if (!$product) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Product not found for the given vendor.',
    //         ], 200);
    //     }
    
    //     $currentStatus = DB::table('orders')
    //         ->where('order_id', $request->order_id)
    //         ->where('vendor_id', $request->vendor_id)
    //         ->value('vendor_order_status'); 
    
    //     if ($currentStatus != 1) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Order is not accepted. Cannot dispatch.',
    //         ], 200);
    //     }
    
    //     $updated = DB::table('orders')
    //         ->where('order_id', $request->order_id)
    //         ->update(['status' => 4]); 
    
    //     if ($updated) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Order dispatched successfully.',
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to dispatch the order.',
    //         ], 200);
    //     }
    // }
    
    // public function vendor_order_dispatch(Request $request)
    // {
    //       //dd($request);
    //     $validator = Validator::make($request->all(), [
    //         'vendor_id' => 'required|integer|exists:vendor,id',
    //         'product_id' => 'required|integer|exists:products,id',
    //         'order_id' => 'required|string|exists:orders,order_id',
    //         'vendor_order_status' => 'required|string|in:4', 
    //     ]);
       
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $validator->errors()->first(),
    //         ], 200);
    //     }
    
    
    //     $product = DB::table('products')
    //         ->where('vendor_id', $request->vendor_id)
    //         ->where('id', $request->product_id)
    //         ->first();
            
    //     if (!$product) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Product not found for the given vendor.',
    //         ], 200);
    //     }
       
    //     $currentStatus = DB::table('orders')
    //         ->join('products', 'orders.product_id', '=', 'products.id')
    //         ->where('orders.order_id', $request->order_id)
    //         ->where('products.vendor_id', $request->vendor_id)
    //         ->value('orders.status');
    
    //     if ($currentStatus != 1) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Order is not accepted. Cannot dispatch.',
    //         ], 200);
    //     }
    
    
    //     $updated = DB::table('orders')
    //         ->where('order_id', $request->order_id)
    //         ->update(['status' => $request->status]);
    
       
    //     if ($updated) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Order dispatched successfully.',
    //         ], 200);
    //     } else {
            
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to dispatch the order.',
    //         ], 200);
    //     }
    // }
    
            
        
       

   
 
}