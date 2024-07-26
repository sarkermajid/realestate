<?php

namespace App\Http\Controllers\Backend;

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

    public function StoreAmenitie(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Amenities::insert([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Amenitie Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.amenitie')->with($notification);
    }

    public function EditAmenitie($id)
    {
        $amenitie = Amenities::findOrFail($id);
        return view('admin.amenitie.edit_amenitie',compact('amenitie'));
    }

    public function UpdateAmenitie(Request $request)
    {
        $amenitie = Amenities::findOrFail($request->id);
        $amenitie->name = $request->name;
        $amenitie->save();

        $notification = array(
            'message' => 'Amenitie Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.amenitie')->with($notification);
    }

    public function DeleteAmenitie($id)
    {
        Amenities::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Amenitie Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.amenitie')->with($notification);
    }
}
