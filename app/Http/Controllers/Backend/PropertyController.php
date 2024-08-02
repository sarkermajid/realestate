<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
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

    public function StoreProperty(Request $request)
    {
        // dd($request->all());
        $property = new Property();
        $property->ptype_id = $request->ptype_id;

        $amenitie_id = $request->amenitie_id;
        $property->amenitie_id = implode(',',$amenitie_id);

        $property->agent_id = $request->agent_id;
        $property->name = $request->name;
        $property->slug = strtolower(str_replace(' ','-',$request->name));

        $property->code = IdGenerator::generate([
            'table'=>'properties',
            'field'=>'code',
            'length'=>5,
            'prefix'=>'PC'
        ]);

        // Image upload with resize
        if ($request->hasFile('property_thumbnail')) {
            $image = $request->file('property_thumbnail');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/property/thumbnail', $imageName);

            // Initialize ImageManager instance
            $imageManager =  new ImageManager(new Driver());
            $img = $imageManager->read('uploads/property/thumbnail/' . $imageName);
            $img->resize(370, 250)->save('uploads/property/thumbnail/' . $imageName);

            $save_url = 'uploads/property/thumbnail/' . $imageName;
            $property->property_thumbnail = $save_url;
        }

        $property->property_status = $request->property_status;
        $property->min_price = $request->min_price;
        $property->max_price = $request->max_price;
        $property->short_des = $request->short_des;
        $property->long_des = $request->long_des;

        $property->bedrooms = $request->bedrooms;
        $property->bathrooms = $request->bathrooms;
        $property->garage = $request->garage;
        $property->garage_size = $request->garage_size;
        $property->size = $request->size;
        $property->video = $request->video;

        $property->address = $request->address;
        $property->city = $request->city;
        $property->state = $request->state;
        $property->postal_code = $request->postal_code;
        $property->neighbourhood = $request->neighbourhood;

        $property->latitude = $request->latitude;
        $property->longitude = $request->longitude;

        $property->featured = $request->featured;
        $property->hot = $request->hot;
        $property->status = 1;
        $property->created_at = Carbon::now();
        $property->save();

        // multiple image uploads
        if($request->hasFile('multi_img')){
            $images = $request->file('multi_img');
            foreach($images as $image){
                if($image->isValid()){
                    $make_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/property/multi-images'), $make_name);
                    // Initialize ImageManager instance
                    $imageManager2 =  new ImageManager(new Driver());
                    $img2 = $imageManager2->read('uploads/property/multi-images/' . $make_name);
                    $img2->resize(770, 520)->save('uploads/property/multi-images/' . $make_name);
                    $upload_path = 'uploads/property/multi-images/'. $make_name;

                    $multiImages = new MultiImage();
                    $multiImages->property_id = $property->id;
                    $multiImages->image = $upload_path;
                    $multiImages->created_at = Carbon::now();
                    $multiImages->save();
                }
            }
        }

        // facilities functionality
        $facilities_count = count($request->facility_name);
        if($facilities_count != null){
            for($i=0;$i<$facilities_count;$i++){
                $facility = new Facility();
                $facility->property_id = $property->id;
                $facility->name = $request->facility_name[$i];
                $facility->distance = $request->distance[$i];
                $facility->created_at = Carbon::now();
                $facility->save();
            }
        }

        $notification = array(
            'message' => 'Property Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.property')->with($notification);

    }

    public function EditProperty($id)
    {
        $property = Property::findOrfail($id);

        $amenitie_selected = explode(',',$property->amenitie_id);

        $propertyTypes = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgents = User::where('status', 'active')->where('role','agent')->latest()->get();

        return view('admin.property.edit_property',compact(
            'property',
            'propertyTypes',
            'amenities',
            'activeAgents',
            'amenitie_selected'
        ));

    }
}
