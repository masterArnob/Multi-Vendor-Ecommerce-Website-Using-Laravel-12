@extends('admin.layout.master')
@section('content')
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Edit Brand Details</h2>

                    <form action="{{ route('admin.brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 align-items-center">
                          

                            <div class="col-md-7">
                                  <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                            style="background-image: url({{ asset($brand->logo) }})"></div>
                                <div class="form-label">Logo</div>
                                   <div class="col-auto"> <input type="file" name="logo" class="form-control"></div>
                                 <x-input-error :messages="$errors->get('logo')" class="mt-2 text-danger" />
                            </div>

                                  <div class="col-md-7">
                                <div class="form-label">Name</div>
                                <input type="text" name="name" value="{{ old('name', $brand->name) }}" class="form-control">
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                            </div>


                                <div class="col-md-7">
                                <div class="form-label">Is Featured</div>
                                <select name="is_featured" class="form-select">
                                    <option @selected($brand->is_featured === 1) value="1">Yes</option>
                                    <option @selected($brand->is_featured === 0) value="0">No</option>
                                </select>
                            </div>
                         
                         
                            <div class="col-md-7">
                                <div class="form-label">Status</div>
                                <select name="status" class="form-select">
                                    <option @selected($brand->status === 1) value="1">Active</option>
                                    <option @selected($brand->status === 0) value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary">Update Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
@endsection
