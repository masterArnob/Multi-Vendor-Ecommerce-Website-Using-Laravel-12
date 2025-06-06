@extends('admin.layout.master')
@section('content')
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Child Category Details</h2>

                    <form action="{{ route('admin.child-category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 align-items-center">
                          

                              <div class="col-md-7">
                                <div class="form-label">Category</div>
                                <select name="category_id" class="form-select">
                                    @forelse ($cats as $cat)
                                       <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @empty
                                        No Data Available
                                    @endforelse
                                   
                                   
                                </select>
                            </div>


                                    <div class="col-md-7">
                                <div class="form-label">Sub Category</div>
                                <select name="sub_category_id" class="form-select">
                                    @forelse ($subcats as $subcat)
                                       <option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
                                    @empty
                                        No Data Available
                                    @endforelse
                                   
                                   
                                </select>
                            </div>


                            <div class="col-md-7">
                                <div class="form-label">Name</div>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
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
                            <button class="btn btn-primary">Create Child Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
@endsection
