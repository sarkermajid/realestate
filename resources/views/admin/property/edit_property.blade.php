@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Edit Property</h6>
                            <form method="POST" action="{{ route('update.property') }}" class="forms-sample" id="myForm"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Property Name</label>
                                            <input type="text" name="name" value="{{ $property->name }}" class="form-control" id="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="icon" class="form-label">Propery Status</label>
                                            <select name="property_status" class="form-select" id="property_status">
                                                <option selected disabled>Select Status</option>
                                                <option value="rent" {{ $property->property_status == 'rent' ? 'selected' : ''}}>For Rent</option>
                                                <option value="buy" {{ $property->property_status == 'buy' ? 'selected' : '' }}>For Buy</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="min_price" class="form-label">Minimum Price</label>
                                            <input type="text" name="min_price" value="{{ $property->min_price }}" class="form-control" id="min_price">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="max_price" class="form-label">Maximum Price</label>
                                            <input type="text" name="max_price" value="{{ $property->max_price }}" class="form-control" id="max_price">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="bedrooms" class="form-label">Bedrooms</label>
                                            <input type="text" name="bedrooms" value="{{ $property->bedrooms }}" class="form-control" id="bedrooms">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="bathrooms" class="form-label">Bathrooms</label>
                                            <input type="text" name="bathrooms" value="{{ $property->bathrooms }}" class="form-control" id="bathrooms">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="garage" class="form-label">Garage</label>
                                            <input type="text" name="garage" value="{{ $property->garage }}" class="form-control" id="garage">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="garage_size" class="form-label">Garage Size</label>
                                            <input type="text" name="garage_size" value="{{ $property->garage_size }}" class="form-control"
                                                id="garage_size">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" name="address" value="{{ $property->address }}" class="form-control" id="address">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" name="city" value="{{ $property->city }}" class="form-control" id="city">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" name="state" value="{{ $property->state }}" class="form-control" id="state">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label for="postal_code" class="form-label">Postal Code</label>
                                            <input type="text" name="postal_code" value="{{ $property->postal_code }}" class="form-control"
                                                id="postal_code">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="size" class="form-label">Property Size</label>
                                            <input type="text" name="size" value="{{ $property->size }}" class="form-control" id="size">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="video" class="form-label">Property Video</label>
                                            <input type="text" name="video" value="{{ $property->video }}" class="form-control" id="video">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="neighbourhood" class="form-label">Neighbourhood</label>
                                            <input type="text" name="neighbourhood" value="{{ $property->neighbourhood }}" class="form-control"
                                                id="neighbourhood">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="latitude" class="form-label">Latitude</label>
                                            <input type="text" name="latitude" value="{{ $property->latitude }}" class="form-control" id="latitude">
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                target="_blank">Go here to get Latitude from address</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="longitude" class="form-label">Longitude</label>
                                            <input type="text" name="longitude" value="{{ $property->longitude }}" class="form-control" id="longitude">
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                target="_blank">Go here to get Longitude from address</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="ptype_id" class="form-label">Property Type</label>
                                            <select name="ptype_id" class="form-select" id="ptype_id">
                                                <option selected disabled>Select Property Type</option>
                                                @foreach ($propertyTypes as $propertyType)
                                                    <option  value="{{ $propertyType->id }}" {{ $propertyType->id == $property->ptype_id ? 'selected' : ''}}>{{ $propertyType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="amenitie_id" class="form-label">Property Amenitie</label>
                                            <select name="amenitie_id[]" class="js-example-basic-multiple form-select"
                                                multiple="multiple" id="amenitie_id">
                                                @foreach ($amenities as $amenity)
                                                    <option value="{{ $amenity->id }}" {{ in_array($amenity->id,$amenitie_selected) ? 'selected' : '' }}>{{ $amenity->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="agent_id" class="form-label">Agent</label>
                                            <select name="agent_id" class="form-select" id="agent_id">
                                                <option selected disabled>Select Agent</option>
                                                @foreach ($activeAgents as $agent)
                                                    <option value="{{ $agent->id }}" {{ $agent->id == $property->agent_id ? 'selected' : '' }}>{{ $agent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="latitude" class="form-label">Short Description</label>
                                            <textarea name="short_des" class="form-control" rows="3">{{ $property->short_des }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="latitude" class="form-label">Long Description</label>
                                            <textarea name="long_des" class="form-control" id="tinymceExample" rows="3">{!! $property->long_des !!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="featured" value="1" class="form-check-input"
                                            id="checkInline1" {{ $property->featured == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkInline1">
                                            Features Property
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="hot" value="1" class="form-check-input"
                                            id="checkInline" {{ $property->hot == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkInline">
                                            Hot Property
                                        </label>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- /// Property Thumbnail Image --}}

    <div class="page-content" style="margin-top:-35px;">
        <div class="row profile-body">
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Edit Property Thumbnail Image</h6>
                            <form method="POST" action="{{ route('update.property.thumbnail') }}" class="forms-sample" id="myForm"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <input type="hidden" name="old_property_thumbnail" value="{{ $property->property_thumbnail }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="min_price" class="form-label">Thumbnail Image</label>
                                            <input type="file" name="property_thumbnail" class="form-control"
                                                id="propertyThumbnail">

                                            <img src="" id="showPhoto">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{ asset($property->property_thumbnail) }}" alt="" style="height: 100px; width:100px;">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Property Multiple Image --}}

    <div class="page-content" style="margin-top: -35px;">
        <div class="row profile-body">
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Edit Multi Images </h6>
                            <form method="post" action="{{ route('update.property.multiimage') }}" id="myForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Image</th>
                                                <th>Change Image </th>
                                                <th>Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($multiImages as $key => $img)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="py-1">
                                                        <img src="{{ asset($img->image) }}" alt="image" style="width:50px; height:50px;">
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control" name="multi_img[{{ $img->id }}]">
                                                    </td>
                                                    <td>
                                                        <input type="submit" class="btn btn-primary px-4"
                                                            value="Update Image">

                                                        <a href="{{ route('delete.property.multiimage',['id'=>$img->id]) }}" class="btn btn-danger" id="delete">Delete </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>


                            <form method="post" action="{{ route('store.new.multiimage') }}" id="myForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="file" required class="form-control" name="multi_img">
                                            </td>
                                            <td>
                                                <input type="submit" class="btn btn-info px-4" value="Add Image">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- js validation error show --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    property_status: {
                        required: true,
                    },
                    min_price: {
                        required: true,
                    },
                    max_price: {
                        required: true,
                    },
                    property_thumbnail: {
                        required: true,
                    },
                    ptype_id: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please Enter Property Name',
                    },
                    property_status: {
                        required: 'Please Enter Property Status',
                    },
                    min_price: {
                        required: 'Please Enter Minimum Price',
                    },
                    max_price: {
                        required: 'Please Enter Maximum Price',
                    },
                    property_thumbnail: {
                        required: 'Please Enter Thumbnail Image',
                    },
                    ptype_id: {
                        required: 'Please Select Property Type',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

    {{-- property thumbnail image preview js --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#propertyThumbnail').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showPhoto').attr('src', e.target.result).width(100).height(80);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    {{-- multiple image preview js --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                            .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(
                                    img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

    <!----For facilities Section-------->
    <script type="text/javascript">
        $(document).ready(function(){
        var counter = 0;
        $(document).on("click",".addeventmore",function(){
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
        });
        $(document).on("click",".removeeventmore",function(event){
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
        });
        });
    </script>
@endsection
