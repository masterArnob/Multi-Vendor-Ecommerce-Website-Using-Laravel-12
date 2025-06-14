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

                    <div class="card-body p-2 pb-4">
                        <form action="{{ route('admin.flash-sale.update', 1) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <input type="hidden" name="date" value="date">
                            <div class="col-md-5">
                                <div class="form-label">End Date</div>
                                <input name="end_date" class="form-control datepicker" value="{{ @$flashSale->end_date }}"
                                    id="offer-start-datepicker">
                                <x-input-error :messages="$errors->get('end_date')" class="mt-2 text-danger" />
                            </div>


                            <div class="mt-4">
                                <button class="btn btn-primary">Create End Date</button>
                            </div>

                        </form>
                    </div>
                </div>



                <div class="card mt-4">

                    <div class="card-body p-2 pb-4">
                        <form action="{{ route('admin.flash-sale.update', 1) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <input type="hidden" name="flash_products" value="flash_products">
                            <div class="col-md-5">
                                <div class="form-label">Add Products</div>
                                <select class="js-example-basic-multiple form-control" name="product_id[]"
                                    multiple="multiple">
                                    @forelse ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @empty
                                        No Data Available
                                    @endforelse
                                </select>
                                @if ($errors->has('product_id') || $errors->has('product_id.*'))
                                    <div class="mt-2 text-danger">
                                        {{ $errors->first('product_id') ?: $errors->first('product_id.*') }}
                                    </div>
                                @endif


                            </div>



                            <div class="col-md-5 mt-3">
                                <div class="form-label">Show At Home</div>
                                <select class="form-control" name="show_at_home">
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>

                            </div>


                                <div class="col-md-5 mt-3">
                                <div class="form-label">Status</div>
                                <select class="form-control" name="status">
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>

                            </div>


                            <div class="mt-4">
                                <button class="btn btn-primary">Add</button>
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
@push('scripts')
    <script>
        // Initialize all datepickers with class 'datepicker'
        document.addEventListener("DOMContentLoaded", function() {
            window.Litepicker && document.querySelectorAll('.datepicker').forEach(function(element) {
                new Litepicker({
                    element: element,
                    buttonText: {
                        previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                    },
                });
            });
        });


        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
