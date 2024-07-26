<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use Illuminate\Http\Request;

class AmenitieController extends Controller
{

    public function AllAmenitie()
    {
        $amenities = Amenities::latest()->get();
        return view('admin.amenitie.all_amenitie',compact('amenities'));
    }

    public function AddAmenitie()
    {
        return view('admin.amenitie.add_amenitie');
    }
}
