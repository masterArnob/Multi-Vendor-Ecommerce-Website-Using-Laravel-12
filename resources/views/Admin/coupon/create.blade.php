@extends('admin.layout.master')
@section('content')
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Create Coupon</h2>

                    <form action="{{ route('admin.coupon.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 align-items-center">
                          

                            <div class="col-md-7">
                                <div class="form-label">Name</div>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                            </div>


                               <div class="col-md-7">
                                <div class="form-label">Code</div>
                                <input type="text" name="code" value="{{ old('code') }}" class="form-control">
                                <x-input-error :messages="$errors->get('code')" class="mt-2 text-danger" />
                            </div>
                          
                         
                               <div class="col-md-7">
                                <div class="form-label">Qty</div>
                                <input type="text" name="quantity" value="{{ old('quantity') }}" class="form-control">
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2 text-danger" />
                            </div>


                            <div class="col-md-7">
                                <div class="form-label">Max Use</div>
                                <input type="text" name="max_use" value="{{ old('max_use') }}" class="form-control">
                                <x-input-error :messages="$errors->get('max_use')" class="mt-2 text-danger" />
                            </div>



                              <div class="col-md-7">
                                <div class="form-label">Start Date</div>
                                     <input name="start_date" class="form-control datepicker"
                                                value="{{ old('start_date') }}" id="offer-start-datepicker">
                                            <x-input-error :messages="$errors->get('start_date')" class="mt-2 text-danger" />
                            </div>


                                 <div class="col-md-7">
                                <div class="form-label">End Date</div>
                                <input name="end_date" class="form-control datepicker"
                                                value="{{ old('end_date') }}" id="offer-end-datepicker">
                                            <x-input-error :messages="$errors->get('end_date')" class="mt-2 text-danger" />
                            </div>


                                 <div class="col-md-7">
                                <div class="form-label">Discount Type</div>
                                <select name="discount_type" class="form-select">
                                    <option value="">Select</option>
                                    <option value="percent">Percent</option>
                                    <option value="amount">Amount</option>
                                </select>
                            </div>
                        </div>


                             <div class="col-md-7 mt-3">
                                <div class="form-label">Discount</div>
                                <input type="text" name="discount" value="{{ old('discount') }}" class="form-control">
                                <x-input-error :messages="$errors->get('discount')" class="mt-2 text-danger" />
                            </div>

                         
                            <div class="col-md-7 mt-3">
                                <div class="form-label">Status</div>
                                <select name="status" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary">Create Coupon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
@endsection
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



    </script>
@endpush
