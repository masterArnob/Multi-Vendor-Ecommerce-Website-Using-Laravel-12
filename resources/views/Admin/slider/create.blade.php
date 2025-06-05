@extends('admin.layout.master')
@section('content')
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Slider Details</h2>

                    <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 align-items-center">
                            <div class="col-7">
                                <div class="form-label">Banner</div>
                                <input type="file" name="banner" class="form-control">
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Type</div>
                                <input type="text" name="type" value="{{ old('type') }}" class="form-control">
                                <x-input-error :messages="$errors->get('type')" class="mt-2 text-danger" />
                            </div>
                            <div class="col-md-7">
                                <div class="form-label">Title</div>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2 text-danger" />
                            </div>
                            <div class="col-md-7">
                                <div class="form-label">Starting Price</div>
                                <input type="text" name="starting_price" value="{{ old('starting_price') }}" class="form-control">
                                <x-input-error :messages="$errors->get('starting_price')" class="mt-2 text-danger" />
                            </div>
                            <div class="col-md-7">
                                <div class="form-label">Button URL</div>
                                <input type="url" name="btn_url" value="{{ old('btn_url') }}" class="form-control">
                                <x-input-error :messages="$errors->get('btn_url')" class="mt-2 text-danger" />
                            </div>
                            <div class="col-md-7">
                                <div class="form-label">Serial</div>
                                <input type="number" name="serial" value="{{ old('serial') }}" class="form-control">
                                <x-input-error :messages="$errors->get('serial')" class="mt-2 text-danger" />
                            </div>
                            <div class="col-md-7">
                                <div class="form-label">Status</div>
                                <select name="status" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary">Create Slider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
@endsection
