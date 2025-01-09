<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    public function size()
    {
        $sizes = DB::table('size')->get();
        return view('size', compact('sizes'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'size' => 'required|string|max:11',    
        ]);
        
        DB::table('size')->insert([
            'size' => $request->size,      
        ]);

        return redirect()->route('size')->with('success', 'Size added successfully!');
    }
    
    public function setActiveStatus($id)
    {
        // Update the status to 1 where the color ID matches
        $updated = DB::table('size')->where('id', $id)->update(['status' => 1]);
    
        if ($updated) {
            return redirect()->back()->with('success', "Size activated successfully.");
        } else {
            return redirect()->back()->with('error', "Size not found.");
        }
    }

    public function setInactiveStatus($id)
    {
        $updated = DB::table('size')->where('id', $id)->update(['status' => 0]);
    
       if ($updated) {
            return redirect()->back()->with('success', "Size Inactivated successfully.");
        } else {
            return redirect()->back()->with('error', "Size not found.");
        }
    }
    
    public function update(Request $request, $id)
{
    
    dd($id);
    $request->validate([
        'size' => 'required|string|max:255',
    ]);

    $affected = DB::table('sizes')
        ->where('id', $id)
        ->update(['size' => $request->size]);

    if ($affected) {
        return redirect()->route('size')->with('success', 'Size updated successfully.');
    } else {
        return redirect()->route('size.update')->with('error', 'Size update failed.');
    }
}
    
}
