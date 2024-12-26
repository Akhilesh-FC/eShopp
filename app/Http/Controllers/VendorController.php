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
    
}

 