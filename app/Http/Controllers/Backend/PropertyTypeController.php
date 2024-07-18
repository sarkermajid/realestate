<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function AllTypes()
    {
        $propertyTypes = PropertyType::latest()->get();
        return view('admin.propertyTypes.all_types',compact('propertyTypes'));
    }

    public function AddType()
    {
        return view('admin.propertyTypes.add_type');
    }

    public function StoreType(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:property_types|max:200',
            'icon' => 'required',
        ]);

        PropertyType::insert([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);
        $notification = array(
            'message' => 'Property Type Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.types')->with($notification);

    }
}
