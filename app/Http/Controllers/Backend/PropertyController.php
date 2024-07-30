<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function AllProperty()
    {
        $properties = Property::latest()->get();
        return view('admin.property.all_property',compact('properties'));
    }

    public function AddProperty()
    {
        $propertyTypes = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgents = User::where('status', 'active')->where('role','agent')->latest()->get();
        return view('admin.property.add_property',compact(
            'propertyTypes',
            'amenities',
            'activeAgents'
        ));
    }
}
