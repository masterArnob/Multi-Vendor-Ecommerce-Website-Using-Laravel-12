@extends('admin.layout.master')
@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                                                    <h2 class="mb-4">Edit Product Variant</h2>

                                                  <a href="{{ route('admin.product-variant.index', ['product_id' => $product->id]) }}" class="btn btn-primary d-none d-sm-inline-block" >
<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                            Back 
                        </a>
                        </div>
                        
                        <form action="{{ route('admin.product-variant.update', $variant->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')



                            <div class="row g-3 align-items-center">
                  


                                

                                  <div class="col-md-7">
                                    <div class="form-label">Product Name</div>
                                    <input type="text" name="name" value="{{ $product->name }}" disabled class="form-control">
                                 
                                </div>

                                  <div class="col-md-7">
                                    <div class="form-label">Thumb Image</div>
                                    <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{ asset($product->thumb_image) }})"></span>
                             
                                </div>

                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                 <input type="hidden" name="variant_id" value="{{ $variant->id }}">

                                <div class="col-md-7">
                                    <div class="form-label">Variant Name</div>
                                    <input type="text" name="name" value="{{ old('name', $variant->name) }}" class="form-control">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                </div>

                     

                   




                   


                                 <div class="col-md-7">
                                    <div class="form-label">Status</div>
                                  <select name="status" class="form-control">
                                    <option @selected($variant->status === 1) value="1">Active</option>
                                    <option @selected($variant->status === 0) value="0">Inactive</option>
                                  </select>
                                </div>



                                <div class="mt-4">
                                    <button class="btn btn-primary">Update Variant</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
@endsection
