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
}
