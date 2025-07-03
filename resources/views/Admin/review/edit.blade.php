@extends('admin.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Product Review
                    </div>
                   
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="{{ route('admin.review.index') }}" class="btn btn-primary">
                                Back
                            </a>
                        </span>
                   
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
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <tbody>
                           

                           
                               

                                <tr>
                                    <th>Product Name</th>
                                    <td><a href="{{ route('product-details.show', $review->product_id) }}">{{ $review->product->name }}</a></td>
                                </tr>
                              
                                <tr>
                                    <th>Rating</th>
                                    <td>{{ $review->rating }} Star
                                    </td>
                                </tr>
                                <tr>
                                    <th>Review</th>
                                    <td>{{ $review->review }}</td>
                                </tr>
                             


                              

        

                                <tr>
                                    <th>Approved Status</th>

                                    <td>
                                        <form action="{{ route('admin.review.update', $review->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <select name="status" class="form-select">
                                                <option @selected($review->status === 1) value="1">
                                                    Approved</option>
                                                <option @selected($review->status === 0) value="0">
                                                    Pending</option>
                                               


                                            </select>

                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-outline-primary mt-5">Update 
                                            </button>
                                    </td>
                                </tr>

                                </form>

                                </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
@endsection
