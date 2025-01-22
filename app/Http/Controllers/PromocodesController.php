<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class PromocodesController extends Controller
{
    public function promo_code(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        $data = DB::table('promo_codes')->paginate($perPage);
        return view('promocode.promocode', ['promo_codes' => $data]);
    }
    
    public function add_promo_code()
    {
        return view('promocode.add_promo_code'); // or whatever your view is named
    }

  public function add_promo_code_store(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'promo_code' => 'required|string|max:255',
        'promo_code_name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'message' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'discount' => 'required|numeric|min:0',
        'discount_type' => 'required|string',
        'min_discount_amount' => 'required|numeric|min:0',
        'min_order_amount' => 'required|numeric|min:0',
    ]);

    // Initialize an array to store the promo code data
    $promoCodeData = [
        'promo_code' => $request->promo_code,
        'promo_code_name' => $request->promo_code_name,
        'message' => $request->message,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'discount' => $request->discount,
        'discount_type' => $request->discount_type,
        'max_discount_amount' => $request->max_discount_amount,
        'minimum_order_amount' => $request->minimum_order_amount,
    ];

    // Check if there is an image uploaded and store it
    if ($request->hasFile('image')) {
        // Attempt to store the image
        try {
            // Store the image and make it publicly accessible
            $imagePath = $request->file('image')->store('promo_images', 'public');
            
            // Generate the public URL for the image
            $promoCodeData['image'] = asset('storage/' . $imagePath);
        } catch (\Exception $e) {
            // If the image upload fails, return with an error message
            return redirect()->back()->with('error', 'Image upload failed: ' . $e->getMessage());
        }
    }

    // Insert the promo code data into the database using DB facade
    try {
        // Check if promo code already exists
        $existingPromoCode = DB::table('promo_codes')->where('promo_code', $request->promo_code)->first();
        if ($existingPromoCode) {
            return redirect()->back()->with('error', 'Promo code already exists.');
        }

        // Insert the promo code data
        DB::table('promo_codes')->insert($promoCodeData);

        // Redirect with success message
        return redirect()->route('promocode.promocode')->with('success', 'Promo Code added successfully!');
    } catch (\Exception $e) {
        // If insertion fails, return with an error message
        return redirect()->back()->with('error', 'Failed to add promo code: ' . $e->getMessage());
    }
}


    public function edit($id)
    {
        $promo = DB::table('promo_codes')->where('id', $id)->first();
        return view('promocode.edit_promo_code', ['promo' => $promo]);
    }

    public function destroy($id)
    {
        DB::table('promo_codes')->where('id', $id)->delete();
        return redirect()->route('promo_code')->with('success', 'Promo code deleted successfully.');
    }
    
   public function update(Request $request, $id)
{
    // Validate input fields
    $request->validate([
        'promo_code' => 'required|string|max:255',
        'promo_code_name' => 'required|string|max:255',
        'message' => 'nullable|string|max:1000',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'minimum_order_amount' => 'nullable|numeric',
        'discount' => 'nullable|numeric',
        'discount_type' => 'nullable|string|in:percentage,flat',
        'max_discount_amount' => 'nullable|numeric'
    ]);

    // Update the promo code in the database
    DB::table('promo_codes')->where('id', $id)->update([
        'promo_code' => $request->promo_code,
        'promo_code_name' => $request->promo_code_name,
        'message' => $request->message,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'minimum_order_amount' => $request->minimum_order_amount,
        'discount' => $request->discount,
        'discount_type' => $request->discount_type,
        'max_discount_amount' => $request->max_discount_amount
    ]);

    return redirect()->route('promo_code')->with('success', 'Promo code updated successfully.');
}



}
