@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Property</h6>
                        <form method="POST" action="{{ route('store.property') }}" class="forms-sample" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Property Name</label>
                                        <input type="text" name="name" class="form-control" id="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="icon" class="form-label">Icon</label>
                                        <select name="property_status" class="form-select" id="property_status">
                                            <option selected disabled>Select Status</option>
                                            <option value="rent">For Rent</option>
                                            <option value="buy">For Buy</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="min_price" class="form-label">Minimum Price</label>
                                        <input type="text" name="min_price" class="form-control" id="min_price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="max_price" class="form-label">Maximum Price</label>
                                        <input type="text" name="max_price" class="form-control" id="max_price">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="min_price" class="form-label">Main Thumbnail Image</label>
                                        <input type="file" name="property_thambnail" class="form-control" id="propertyThumbnail">

                                        <img src="" id="showPhoto">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="max_price" class="form-label">Multiple Image</label>
                                        <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple="" >

                                        <div class="row" id="preview_img"> </div>
                                    </div>
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

// js validation error show
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                icon: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter Property Type Name',
                },
                icon: {
                    required : 'Please Enter Property Type Icon',
                },

            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>

// property thumbnail image preview js
<script type="text/javascript">
    $(document).ready(function(){
        $('#propertyThumbnail').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showPhoto').attr('src',e.target.result).width(100).height(80);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

// multiple image preview js
<script type="text/javascript">
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data

            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(80); //create image element
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });

        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
</script>

@endsection
