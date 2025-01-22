<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CustomerController extends Controller
{
    
    public function ViewCustomers(Request $request)
    {
         $search = $request->input('search');
        $perPage = $request->input('per_page', 5); 
        $viewCustomers = User::latest()
        ->when($search, function($query, $search) {
            return $query->where('username', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('mobile', 'like', "%{$search}%");
        })
        ->orderby('id', 'desc')
        ->paginate($perPage);
        return view('customer.viewcustomer', compact('viewCustomers', 'perPage'));
    }
 
    public function toggleStatus($id)
    {
        $customer = DB::table('users')->where('id', $id)->first();
        if (!$customer) {
            return redirect()->route('view_customer')->with('error', 'Customer not found.');
        }
    
        $newStatus = $customer->active == 1 ? 0 : 1;

        DB::table('users')->where('id', $id)->update(['active' => $newStatus]);
    
        $statusMessage = $newStatus == 1 ? 'activated' : 'deactivated';
    
        return redirect()->route('view_customer')->with('success', "Customer $statusMessage successfully.");
    }
    
    public function ViewAddress(Request $request) 
{ 
    $perPage = $request->input('per_page', 5); // Rows per page
    $search = $request->input('search'); // Search query

    // Build query
    $query = DB::table('addresses')->latest();

    // If search term is provided, apply the search filter
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('mobile', 'like', '%' . $search . '%')
              ->orWhere('city', 'like', '%' . $search . '%')
              ->orWhere('state', 'like', '%' . $search . '%');
        });
    }

    // Paginate the results
    $viewAddress = $query->paginate($perPage);

    return view('customer.address', compact('viewAddress', 'perPage', 'search'));
}


    
     
}
