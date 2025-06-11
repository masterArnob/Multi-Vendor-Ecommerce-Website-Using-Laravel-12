@extends('admin.layout.master')
@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                                                    <h2 class="mb-4">Create Vendor Product Variant</h2>

                                                  <a href="{{ route('vendor.product-variant.index', ['product_id' => $product->id]) }}" class="btn btn-primary d-none d-sm-inline-block" >
<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                            Back 
                        </a>
                        </div>
                        
                        <form action="{{ route('vendor.product-variant.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf




                            <div class="row g-3 align-items-center">
                  


                                

                                  <div class="col-md-7">
                                    <div class="form-label">Product Name</div>
                                    <input type="text" name="name" value="{{ $product->name }}" disabled class="form-control">
                                 
                                </div>

                                  <div class="col-md-7">
                                    <div class="form-label">Thumb Image</div>
                                    <div class="col-auto">
                                           <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                            style="background-image: url({{ asset($product->thumb_image) }})"></div>
                                            <br>
                                    </div>
                                </div>

                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="col-md-7">
                                    <div class="form-label">Variant Name</div>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                </div>

                     

                   




                   


                                 <div class="col-md-7">
                                    <div class="form-label">Status</div>
                                  <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                  </select>
                                </div>



                                <div class="mt-4">
                                    <button class="btn btn-primary">Create Variant</button>
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


