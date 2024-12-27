<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CustomerController extends Controller
{
    
    public function ViewCustomers(Request $request)
    {
        $perPage = $request->input('per_page', 5); 
        $viewCustomers = User::latest()->paginate($perPage);
        return view('customer.viewcustomer', compact('viewCustomers', 'perPage'));
    }
 
    public function toggleStatus($id)
    {
        $customer = DB::table('users')->where('id', $id)->first();
        if (!$customer) {
            return redirect()->route('view_customer')->with('error', 'Customer not found.');
        }
    
        $newStatus = $customer->status == 1 ? 0 : 1;

        DB::table('users')->where('id', $id)->update(['status' => $newStatus]);
    
        $statusMessage = $newStatus == 1 ? 'activated' : 'deactivated';
    
        return redirect()->route('view_customer')->with('success', "Customer $statusMessage successfully.");
    }
    
    public function ViewAddress(Request $request) 
    { 
        $perPage = $request->input('per_page', 5); // Default pagination to 10 per page
        $viewAddress = DB::table('addresses')->latest()->paginate($perPage); // Paginate the addresses table
        return view('customer.address', compact('viewAddress', 'perPage'));
    }  

    
     
}
