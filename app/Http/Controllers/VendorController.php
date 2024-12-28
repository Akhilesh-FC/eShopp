<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class VendorController extends Controller
{ 
   
    public function index()
    {
        $vendors = DB::table('vendor')->orderby('id', 'desc')->get();

        return view('vendor.vendor', compact('vendors'));
    }

    public function updateStatus(Request $request, $id)
    {
        $vendor = Vendor::find($id);
        $vendor->status = $request->status;
        $vendor->save();
    
        return redirect()->route('vendor.index')->with('success', 'Vendor status updated successfully.');
    }
    
    public function showDetails($id)
    {
        //echo('hiio'); die;
     
        $vendor = DB::table('vendor')->where('id', $id)->first();
    
        if (!$vendor) {
            abort(404, 'Vendor not found');
        }
        //echo('hii'); die;
    
        return view('vendor.vendordetails', compact('vendor'));
    }
    
//   public function showProductDetails($id)
// {
//     // Vendor ko fetch karna, assuming aapke paas vendor model hai
//     $vendor = DB::table('vendor')->where('id', $id)->first();

//     // Vendor data ko pass karte hue view ko return karna
//     return view('vendor.vendorproductdetails', compact('vendor'));
// }

    public function showProductDetails($id)
{
    // Fetch vendor details
    $vendor = DB::table('vendor')->where('id', $id)->first();

    // Fetch products uploaded by the vendor along with product variants, price, discount, and other details
    $products = DB::table('products')
        ->where('vendor_id', $id)  // Match vendor's id with products
        ->get(); // Fetch all products for this vendor
    
    // Fetch variants for each product (if necessary)
    $productVariants = DB::table('product_variants')
        ->whereIn('product_id', $products->pluck('id'))  // Match the products' IDs
        ->get();
    
    // Return the data to the view
    return view('vendor.vendorproductdetails', compact('vendor', 'products', 'productVariants'));
}

    
}

 