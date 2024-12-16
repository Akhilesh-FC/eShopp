<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AddressApiController extends Controller
{
   public function add_address(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'user_id'       => 'required|integer', 
            'name'          => 'required|string|max:24',
            'mobile_number' => 'required|digits:10',
            'address'       => 'required|string',
            'city'          => 'required|string',
            'area_name'     => 'required|string',
            'pincode'       => 'required|digits:6',
            'state'         => 'required|string',
            'country'       => 'required|string',
            'address_type'  => 'required|in:Home,Office,Other',
            'set_default'   => 'required|boolean',
        ]);
    
        $validator->stopOnFirstFailure();
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }
    
        // Retrieve validated data
        $validated = $validator->validated();
    
        // Insert data into the database
        $addressId = DB::table('addresses')->insertGetId([
            'user_id'    => $validated['user_id'],
            'name'       => $validated['name'],
            'mobile'     => $validated['mobile_number'],
            'address'    => $validated['address'],
            'city'       => $validated['city'],
            'area'       => $validated['area_name'],
            'pincode'    => $validated['pincode'],
            'state'      => $validated['state'],
            'country'    => $validated['country'],
            'type'       => $validated['address_type'],
            'is_default' => $validated['set_default'],
            'created_at' => now(), 
            'updated_at' => now(),
        ]);
    
        // Fetch all addresses for the user
        $allAddresses = DB::table('addresses')->where('user_id', $validated['user_id'])->get();
    
        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Address added successfully.',
            'data'    => $allAddresses,
        ], 200);
    } 

    
    // public function view_address(Request $request)  
    // {
    //     // Validate the incoming request for user_id
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required|integer', 
    //     ]);
    
    //     $validator->stopOnFirstFailure();
        
    //     if ($validator->fails()) {
    //         $response = [
    //             'status' => false,
    //             'message' => $validator->errors()->first()
    //         ]; 
    //         return response()->json($response, 200);
    //     }
        
    //     // Get all addresses for the given user
    //     $addresses = DB::table('addresses')->where('user_id', $request->user_id)->get();
    
    //     if ($addresses->isEmpty()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'No addresses found for this user.',
                
    //         ], 200); 
    //     }
    
    //     // Return success response with the user's addresses
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Addresses fetched successfully.',
    //         'data'    => $addresses,
    //     ], 200);
    // }


    public function view_address(Request $request)  
    {
        if (!$request->has('user_id') || $request->user_id === null) { 
            return response()->json([
                'success' => false,
                'message' => 'User ID is required.',
                'data'    => [], 
            ], 200); 
        }
    
        $validator = Validator::make($request->all(), [  
            'user_id' => 'required|integer', 
        ]);
    
        $validator->stopOnFirstFailure(); 
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(), 
                'data'    => [], 
            ], 200);
        } 
        
        $addresses = DB::table('addresses')->where('user_id', $request->user_id)->get();
    
        if ($addresses->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No addresses found for this user.', 
                'data'    => [], 
            ], 200); 
        }
    
        return response()->json([
            'success' => true, 
            'message' => 'Addresses fetched successfully.',
            'data'    => $addresses,
        ], 200);
    }

    
    public function edit_address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id'    => 'required|integer|exists:addresses,id', 
            'user_id'       => 'required|integer',
            'name'          => 'sometimes|string|max:24',
            'mobile_number' => 'sometimes|digits:10',
            'address'       => 'sometimes',
            'city'          => 'sometimes',
            'area_name'     => 'sometimes',
            'pincode'       => 'sometimes', 
            'state'         => 'sometimes',
            'country'       => 'sometimes',
            'address_type'  => 'sometimes|in:Home,Office,Other', 
            'set_default'   => 'sometimes|boolean',
        ]);
        
        $validator->stopOnFirstFailure();
        
        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => $validator->errors()->first()
            ]; 
            return response()->json($response, 200);
        }
    
        // Get validated data
        $validated = $validator->validated();
        
        // Prepare update data (only the fields provided)
        $updateData = [];
        if ($request->has('name')) {
            $updateData['name'] = $validated['name'];
        }
        if ($request->has('mobile_number')) {
            $updateData['mobile'] = $validated['mobile_number'];
        }
        if ($request->has('address')) {
            $updateData['address'] = $validated['address'];
        }
        if ($request->has('city')) {
            $updateData['city'] = $validated['city'];
        }
        if ($request->has('area_name')) {
            $updateData['area'] = $validated['area_name'];
        }
        if ($request->has('pincode')) {
            $updateData['pincode'] = $validated['pincode'];
        }
        if ($request->has('state')) {
            $updateData['state'] = $validated['state'];
        }
        if ($request->has('country')) {
            $updateData['country'] = $validated['country'];
        }
        if ($request->has('address_type')) {
            $updateData['type'] = $validated['address_type'];
        }
        if ($request->has('set_default')) {
            $updateData['is_default'] = $validated['set_default'];
        }
    
        // Update the address in the database
        DB::table('addresses')
            ->where('id', $validated['address_id'])
            ->where('user_id', $validated['user_id'])
            ->update($updateData);
    
        // Fetch all addresses for the user
        $allAddresses = DB::table('addresses')->where('user_id', $validated['user_id'])->get();
    
        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Address updated successfully.',
            'data'    => $allAddresses,
        ], 200);
    }

    
    public function delete_address(Request $request) 
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(),[ 
            'address_id' => 'required|integer|exists:addresses,id',
            'user_id'    => 'required|integer',
        ]);
    
        // Stop on first validation failure
        $validator->stopOnFirstFailure(); 
    
        // Return validation errors if any
        if($validator->fails()){
            $response = [
                'status' => false,
                'message' => $validator->errors()->first()
            ]; 
            return response()->json($response, 200);
        }
    
        // Get the validated data
        $validated = $validator->validated();
    
        // Check if the address belongs to the user
        $address = DB::table('addresses')
            ->where('id', $validated['address_id'])
            ->where('user_id', $validated['user_id']) 
            ->first();
    
        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found or does not belong to the user.',
            ], 200);
        }
    
        // Delete the address
        DB::table('addresses')->where('id', $validated['address_id'])->delete(); 
    
        // Fetch all remaining addresses for the user
        $allAddresses = DB::table('addresses')->where('user_id', $validated['user_id'])->get();
    
        // Return success response with updated address list
        return response()->json([
            'success' => true,
            'message' => 'Address deleted successfully.',
            'data'    => $allAddresses,
        ], 200); 
    }


}
