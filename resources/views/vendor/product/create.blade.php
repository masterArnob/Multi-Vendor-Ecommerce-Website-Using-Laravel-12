@extends('vendor.layout.master')
@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Create Product</h2>

                        <form action="{{ route('vendor.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf




                            <div class="row g-3 align-items-center">
                                <div class="col-md-7">
                                    <div class="form-label">Thumb Image</div>
                                    <div class="col-auto">
                                        <input type="file" name="thumb_image" class="form-control">
                                    </div>
                                    <x-input-error :messages="$errors->get('thumb_image')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Name</div>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                </div>

                                <!-- Category, Sub Category, Child Category side by side -->
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-label">Category</div>
                                            <select name="category_id" class="form-select category">
                                                <option>Select</option>
                                                @forelse ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse


                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-label">Sub Category</div>
                                            <select name="sub_category_id" class="form-select sub-category">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-label">Child Category</div>
                                            <select name="child_category_id" class="form-select child-category">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Brand</div>
                                    <select name="brand_id" class="form-select">
                                        @forelse ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @empty
                                            No Data Available
                                        @endforelse

                                    </select>
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Quantity</div>
                                    <input type="text" name="qty" value="{{ old('qty') }}" class="form-control">
                                    <x-input-error :messages="$errors->get('qty')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Short Description</div>
                                    <input type="text" name="short_description" value="{{ old('short_description') }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('short_description')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Long Description</div>
                                    <textarea name="long_description" class="form-control summernote">{{ old('long_description') }}</textarea>
                                    <x-input-error :messages="$errors->get('long_description')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Video Link</div>
                                    <input type="url" name="video_link" value="{{ old('video_link') }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('video_link')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Price</div>
                                    <input type="text" name="price" value="{{ old('price') }}" class="form-control">
                                    <x-input-error :messages="$errors->get('price')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Offer Price</div>
                                    <input type="text" name="offer_price" value="{{ old('offer_price') }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('offer_price')" class="mt-2 text-danger" />
                                </div>


                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-label">Offer Start Date</div>
                                            <input name="offer_start_date" class="form-control datepicker"
                                                value="{{ old('offer_start_date') }}" id="offer-start-datepicker">
                                            <x-input-error :messages="$errors->get('offer_start_date')" class="mt-2 text-danger" />
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-label">Offer End Date</div>
                                            <input name="offer_end_date" class="form-control datepicker"
                                                value="{{ old('offer_end_date') }}" id="offer-end-datepicker">
                                            <x-input-error :messages="$errors->get('offer_end_date')" class="mt-2 text-danger" />
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-7">
                                    <div class="form-label">Product Type</div>
                                    <select name="product_type" class="form-select">
                                        <option value="">Select</option>
                                        <option value="new_arrival">New Arrival</option>
                                        <option value="featured_product">Featured</option>
                                        <option value="top_product">Top Product</option>
                                        <option value="best_product">Best Product</option>
                                    </select>
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">SEO Title</div>
                                    <input type="text" name="seo_title" value="{{ old('seo_title') }}"
                                        class="form-control">
                                    <x-input-error :messages="$errors->get('seo_title')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">SEO Description</div>
                                    <textarea name="seo_description" class="form-control summernote">{{ old('seo_description') }}</textarea>

                                    <x-input-error :messages="$errors->get('seo_description')" class="mt-2 text-danger" />
                                </div>


                                 <div class="col-md-7">
                                    <div class="form-label">Status</div>
                                  <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                  </select>
                                </div>



                                <div class="mt-4">
                                    <button class="btn btn-primary">Create Product</button>
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

@push('scripts')
    <script>
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']]
            ]
        });

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
            $('.category').on('change', function() {
                //alert('aaaaaaa');
                let category_id = $(this).val()
                //alert(category_id);

                $.ajax({
                    url: "{{ route('vendor.product.get-sub-categories') }}",
                    method: 'GET',
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        let subCategorySelect = $('.sub-category');
                        subCategorySelect.html('<option value="">Select</option>');
                        if (data.status === 'success' && Array.isArray(data.subCategories)) {
                            $.each(data.subCategories, function(i, item) {
                                subCategorySelect.append(
                                    `<option value="${item.id}">${item.name}</option>`
                                    );
                            });
                        } else {
                            subCategorySelect.append(
                                '<option value="">No Subcategories Available</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })




               $('.sub-category').on('change', function() {
                //alert('aaaaaaa');
                let sub_category_id = $(this).val()
                //alert(category_id);

                $.ajax({
                    url: "{{ route('vendor.product.get-child-categories') }}",
                    method: 'GET',
                    data: {
                        sub_category_id: sub_category_id
                    },
                    success: function(data) {
                        let childCategorySelect = $('.child-category');
                        childCategorySelect.html('<option value="">Select</option>');
                        if (data.status === 'success' && Array.isArray(data.childCategories)) {
                            $.each(data.childCategories, function(i, item) {
                                childCategorySelect.append(
                                    `<option value="${item.id}">${item.name}</option>`
                                    );
                            });
                        } else {
                            childCategorySelect.append(
                                '<option value="">No Subcategories Available</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })

            
        })
    </script>
@endpush

{{-- 

    <script>
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.product.get-subcategories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.sub-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })


            /** get child categories **/
            $('body').on('change', '.sub-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.product.get-child-categories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.child-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item){
                            $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
--}}
