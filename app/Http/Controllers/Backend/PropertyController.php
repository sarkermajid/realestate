<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function AllProperty()
    {
        $properties = Property::latest()->get();
        return view('admin.property.all_property',compact('properties'));
    }
}
