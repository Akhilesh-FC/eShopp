<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CustomerController extends Controller
{
    
    public function ViewCustomers(Request $request)
    {
        $perPage = $request->input('per_page', 10); 
        $viewCustomers = User::latest()->paginate($perPage);
        return view('customer.viewcustomer', compact('viewCustomers', 'perPage'));
    }
    
    public function ViewAddress(Request $request) 
    { 
        $perPage = $request->input('per_page', 10); // Default pagination to 10 per page
        $viewAddress = DB::table('addresses')->latest()->paginate($perPage); // Paginate the addresses table
        return view('customer.address', compact('viewAddress', 'perPage'));
    }  

    
     
}
