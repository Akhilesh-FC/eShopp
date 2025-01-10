<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{ 
    public function enable_vendor($v_id, $status)
    {
        if (!in_array($status, [0, 1])) {
            return redirect()->back()->with('error', 'Invalid status value');
        }
    
        $vendor = DB::table('vendor')->where('id', $v_id)->first();
    
        if (!$vendor) {
            return redirect()->back()->with('error', 'Vendor not found');
        }
    
        // Update the 'active' field, not 'status'
        $update = DB::table('vendor')->where('id', $v_id)->update(['active' => $status]);
    
        if ($update) {
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
        $search = $request->input('search');
        $perPage = $request->input('per_page', 5);
    
        $vendors = DB::table('vendor')
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('mobile', 'like', "%{$search}%")
                             ->orWhere('address', 'like', "%{$search}%");
            })
            ->orderby('id', 'desc')
            ->paginate($perPage);
    
        return view('vendor.vendor', compact('vendors'));
    }

        
    public function showDetails($id)
    {
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

 