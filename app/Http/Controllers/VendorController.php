<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{ 
    // public function enable_vendor(?string $v_id,?string $status){
    //     $a = DB::table('vendor')->where('id',$v_id)->update(['active'=>$status]);
    //     if($a)
    //     {
    //         return redirect()->back()->with('success','Updated successfully');
    //     }
    //     else
    //     {
    //         return redirect()->back()->with('error','Something went wrong!');
    //     }
    // }
    
  public function enable_vendor($v_id, $status)
{
    // Validate the status value (only 0 or 1 is allowed)
    if (!in_array($status, [0, 1])) {
        return redirect()->back()->with('error', 'Invalid status value');
    }

    // Find the vendor
    $vendor = DB::table('vendor')->where('id', $v_id)->first();

    if (!$vendor) {
        return redirect()->back()->with('error', 'Vendor not found');
    }

    // Update the active status
    $update = DB::table('vendor')->where('id', $v_id)->update(['active' => $status]);

    if ($update) {
        // Show success message after status update
        if ($status == 1) {
            return redirect()->back()->with('success', 'Vendor is now active.');
        } else {
            return redirect()->back()->with('success', 'Vendor is now inactive.');
        }
    } else {
        return redirect()->back()->with('error', 'Something went wrong!');
    }
}




   
    public function index(Request $request)
    {
         $perPage = $request->input('per_page', 5);
        $vendors = DB::table('vendor')->orderby('id', 'desc')->paginate($perPage);;

        return view('vendor.vendor', compact('vendors'));
    }

//   public function updateStatus(Request $request, $id)
//     {
       
//         $status = ($request->status == 'Inactive') ? 1 : 0;
    
//         DB::table('vendor')
//             ->where('id', $id)
//             ->update(['active' => $status]);
    
//         return redirect()->route('vendor')->with('success', 'Vendor status updated successfully.');
//     }
    
        
    public function showDetails($id)
    {
        //echo('hiio'); die;
     
        $vendor = DB::table('vendor')->where('id', $id)->first();
    
        if (!$vendor) {
            abort(200, 'Vendor not found');
        }
        //echo('hii'); die;
    
        return view('vendor.vendordetails', compact('vendor'));
    }

    public function showProductDetails($id)
    {
        $vendor = DB::table('vendor')->where('id', $id)->first();

        $products = DB::table('products')
            ->where('vendor_id', $id)  
            ->get(); 
        
        $productVariants = DB::table('product_variants')
            ->whereIn('product_id', $products->pluck('id')) 
            ->get();
        
        return view('vendor.vendorproductdetails', compact('vendor', 'products', 'productVariants'));
    }
    
  




        
}

 