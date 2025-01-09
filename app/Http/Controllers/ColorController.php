<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ColorController extends Controller
{
    public function color()
    {
        $colors = DB::table('color')->get();
        return view('color', compact('colors'));
    }
    
    public function color_store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',    
            'color' => 'required',     
        ]);
        
        $store= DB::table('color')->insert([
        'name' => $request->name,      
        'color' => $request->color,    
       
    ]);
        return redirect()->back()->with('success', 'Color added successfully!');
    }
    
    public function setActiveStatus($id)
    {
        // Update the status to 1 where the color ID matches
        $updated = DB::table('color')->where('id', $id)->update(['status' => 1]);
    
        if ($updated) {
            return redirect()->back()->with('success', "Color activated successfully.");
        } else {
            return redirect()->back()->with('error', "Color not found.");
        }
    }

    public function setInactiveStatus($id)
    {
        $updated = DB::table('color')->where('id', $id)->update(['status' => 0]);
    
       if ($updated) {
            return redirect()->back()->with('success', "Color Inactivated successfully.");
        } else {
            return redirect()->back()->with('error', "Color not found.");
        }
    }
    
    public function edit($id)
    {
        $color = DB::table('color')->where('id', $id)->first();
        return response()->json($color);
    }
    
    public function update(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'name' => 'required',
        'color' => 'required',
    ]);

    // Find the color by ID and update the values
    $color = DB::table('color')->where('id', $id)->first();

    if ($color) {
        DB::table('color')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'color' => $request->color,
            ]);
        
        return redirect()->route('color')->with('success', 'Color updated successfully');
    } else {
        return redirect()->route('color')->with('error', 'Color not found');
    }
}



    
}