<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function viewCustomers(Request $request)
    {
        $search = $request->get('search');
        $users = User::query();

        if ($search) {
            $users->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('mobile', 'LIKE', "%$search%");
        }

        $users = $users->paginate(10);

        return view('admin.view_customers', compact('users'));
    }
}
