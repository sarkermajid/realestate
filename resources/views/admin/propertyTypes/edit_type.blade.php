@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="row profile-body">
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Property Type</h6>
                        <form method="POST" action="{{ route('update.type') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $propertyType->id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $propertyType->name }}" class="form-control @error('name') is-invalid @enderror"  id="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon</label>
                                <input type="text" name="icon" value="{{ $propertyType->icon }}" class="form-control @error('icon') is-invalid @enderror"  id="icon">
                                @error('icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
