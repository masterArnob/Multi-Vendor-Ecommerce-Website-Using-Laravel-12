@extends('admin.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        Flash Sale Products
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                        <a href="{{ route('admin.flash-sale.index') }}" class="btn btn-primary">Back</a>

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

           



                <div class="card mt-4">
                    

                    <div class="card-body p-2 pb-4">
                        <form action="{{ route('admin.flash-sale.update', $flashSaleItem->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="col-md-5 mt-3">
                                <div class="form-label">Product Name</div>
                                 <input type="disabled" class="form-control" value="{{ $flashSaleItem->product->name }}">

                            </div>

                                 <div class="col-md-7">
                                    <div class="form-label">Product Image</div>
                                    <div class="col-auto">
                                              <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{ asset($flashSaleItem->product->thumb_image) }})"></span>
                                    </div>
                                </div>
                         

                            <input type="hidden" name="item_edit" value="item_edit">


                            <div class="col-md-5 mt-3">
                                <div class="form-label">Show At Home</div>
                                <select class="form-control" name="show_at_home">
                                    <option @selected($flashSaleItem->show_at_home === 1) value="1">Yes</option>
                                    <option @selected($flashSaleItem->show_at_home === 0) value="0">No</option>
                                </select>

                            </div>


                                <div class="col-md-5 mt-3">
                                <div class="form-label">Status</div>
                                <select class="form-control" name="status">
                                    <option @selected($flashSaleItem->status === 1) value="1">Active</option>
                                    <option @selected($flashSaleItem->status === 0) value="0">Inactive</option>
                                </select>

                            </div>


                            <div class="mt-4">
                                <button class="btn btn-primary">Update</button>
                            </div>






                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Page body -->


    <!-- Page body -->
@endsection

