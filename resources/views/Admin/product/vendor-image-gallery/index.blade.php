@extends('admin.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
             
                    <h2 class="page-title">
                        Vendor Product Image Gallery
                    </h2>
                </div>
                <!-- Page title actions -->
                   <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                      
                  
                  
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    <!-- Page header -->
    <!-- Page body -->
        <div class="page-body">
        <div class="container-xl">
            <div class="col-12">

<div class="card">
                  <div class="card-header">
                 
                    <div class="card-actions">
                      <a href="{{ route('admin.vendor-product.index') }}" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                        Back
                      </a>
                    </div>
                  </div>
                  <div class="card-body p-2 pb-4">
                    <form action="{{ route('admin.vendor-image-gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                             <div class="col-md-7">
                                    <div class="form-label">Product Name</div>
                                    <input type="text" value="{{ $product->name }}" disabled class="form-control">
                                </div>


                               <div class="col-md-7">
                                    <div class="form-label">Product Image</div>
                                    <div class="col-auto">
                                              <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{ asset($product->thumb_image) }})"></span>
                                    </div>
                                </div>


           
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                             <div class="col-md-7 mt-3">
                                    <div class="form-label">Image</div>
                                    <input type="file" name="image[]" multiple class="form-control" required>
                                    <x-input-error :messages="$errors->get('image')" class="mt-2 text-danger" />
                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-primary">Upload</button>
                                </div>
                    </form>
                  </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Page body -->

    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">

                {{ $dataTable->table() }}


            </div>
        </div>
    </div>
    <!-- Page body -->





@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush