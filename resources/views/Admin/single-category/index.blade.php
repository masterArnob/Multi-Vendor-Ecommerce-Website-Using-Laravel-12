@extends('admin.layout.master')
@section('content')
@php
    @$topCat = json_decode($topCat->value);
    //dd($topCat[0]->cat_one);
@endphp
<!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Single Category Section One</h2>

                        <form action="{{ route('admin.single-category.update', 1) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="single_cat_value" value="1">

                            <div class="row g-3 align-items-center">



                                <div class="col-md-12">
                                    <div class="row">
                                    
                                       

                                        @php
                                            @$singleCat = json_decode($singleCatOne->value);
                                            //dd($singleCat);
                                        @endphp
                                        <div class="col-md-4">
                                            <div class="form-label">Category</div>
                                            <select name="cat_one" class="form-select category">
                                                <option value="">Select</option>
                                                @forelse ($categories as $category)
                                                    <option @selected($category->id == @$singleCat[0]->category) value="{{ $category->id }}">{{ $category->name }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse
                                            </select>
                                                <x-input-error :messages="$errors->get('cat_one')" class="mt-2 text-danger" />
                                        </div>

                                        <div class="col-md-4">
                                            @php
                                                $subCats = App\Models\SubCategory::where('category_id', @$singleCat[0]->category)
                                                ->where('status', 1)
                                                ->get();
                                            @endphp
                                            <div class="form-label">Sub Category</div>
                                            <select name="sub_cat_one" class="form-select sub-category">
                                                <option value="">Select</option>
                                               @forelse ($subCats as $subCat)
                                                   <option @selected($subCat->id == $singleCat[0]->sub_category) value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                                               @empty
                                                   No Data Available
                                               @endforelse
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            @php
                                                $childCats = App\Models\ChildCategory::where('sub_category_id', @$singleCat[0]->sub_category)
                                                ->where('status', 1)
                                                ->get();
                                            @endphp
                                            <div class="form-label">Child Category</div>
                                            <select name="child_cat_one" class="form-select child-category">
                                                <option value="">Select</option>
                                                @forelse ($childCats as $childCat)
                                                    <option @selected($childCat->id == @$singleCat[0]->child_category) value="{{ $childCat->id }}">{{ $childCat->name }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            





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
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Single Category Section Two</h2>

                        <form action="{{ route('admin.single-category.update', 1) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="single_cat_value" value="2">

                            <div class="row g-3 align-items-center">



                                <div class="col-md-12">
                                    <div class="row">
                                    
                                       

                                        @php
                                            @$singleCat2 = json_decode($singleCatTwo->value);
                                            //dd($singleCat);
                                        @endphp
                                        <div class="col-md-4">
                                            <div class="form-label">Category</div>
                                            <select name="cat_one" class="form-select category">
                                                <option value="">Select</option>
                                                @forelse ($categories as $category)
                                                    <option @selected($category->id == @$singleCat2[0]->category) value="{{ $category->id }}">{{ $category->name }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse
                                            </select>
                                                <x-input-error :messages="$errors->get('cat_one')" class="mt-2 text-danger" />
                                        </div>

                                        <div class="col-md-4">
                                            @php
                                                $subCats = App\Models\SubCategory::where('category_id', @$singleCat2[0]->category)
                                                ->where('status', 1)
                                                ->get();
                                            @endphp
                                            <div class="form-label">Sub Category</div>
                                            <select name="sub_cat_one" class="form-select sub-category">
                                                <option value="">Select</option>
                                               @forelse ($subCats as $subCat)
                                                   <option @selected($subCat->id == $singleCat2[0]->sub_category) value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                                               @empty
                                                   No Data Available
                                               @endforelse
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            @php
                                                $childCats = App\Models\ChildCategory::where('sub_category_id', @$singleCat2[0]->sub_category)
                                                ->where('status', 1)
                                                ->get();
                                            @endphp
                                            <div class="form-label">Child Category</div>
                                            <select name="child_cat_one" class="form-select child-category">
                                                <option value="">Select</option>
                                                @forelse ($childCats as $childCat)
                                                    <option @selected($childCat->id == @$singleCat2[0]->child_category) value="{{ $childCat->id }}">{{ $childCat->name }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            





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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Category change event
            $('body').on('change', '.category', function() {
                let category_id = $(this).val();
                let row = $(this).closest('.row');
                console.log('Category selected:', category_id); // Debug: Log category ID

                // Clear sub-category and child-category dropdowns
                let subCategorySelect = row.find('.sub-category');
                let childCategorySelect = row.find('.child-category');
                subCategorySelect.html('<option value="">Select</option>');
                childCategorySelect.html('<option value="">Select</option>');

                if (!category_id) {
                    console.log('No category selected, exiting');
                    return;
                }

                $.ajax({
                    url: "{{ route('admin.product.get-sub-categories') }}", // Revert to original route
                    method: 'GET',
                    data: { category_id: category_id }, // Match previous code's parameter
                    success: function(data) {
                        console.log('Subcategories response:', data); // Debug: Log response
                        subCategorySelect.html('<option value="">Select</option>');

                        // Handle both response formats
                        let subCategories = Array.isArray(data) ? data : (data.subCategories || []);
                        if (subCategories.length > 0) {
                            $.each(subCategories, function(i, item) {
                                if (item.id && item.name) {
                                    subCategorySelect.append(
                                        `<option value="${item.id}">${item.name}</option>`
                                    );
                                } else {
                                    console.warn('Invalid subcategory item:', item);
                                }
                            });
                        } else {
                            console.log('No subcategories available');
                            subCategorySelect.append(
                                '<option value="">No Subcategories Available</option>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Subcategory AJAX error:', xhr.responseText, status, error);
                        subCategorySelect.html(
                            '<option value="">Error loading subcategories</option>'
                        );
                    }
                });
            });

            // Subcategory change event
            $('body').on('change', '.sub-category', function() {
                let sub_category_id = $(this).val();
                let row = $(this).closest('.row');
                console.log('Subcategory selected:', sub_category_id); // Debug: Log subcategory ID

                // Clear child-category dropdown
                let childCategorySelect = row.find('.child-category');
                childCategorySelect.html('<option value="">Select</option>');

                if (!sub_category_id) {
                    console.log('No subcategory selected, exiting');
                    return;
                }

                $.ajax({
                    url: "{{ route('admin.product.get-child-categories') }}",
                    method: 'GET',
                    data: { sub_category_id: sub_category_id }, // Match previous code's parameter
                    success: function(data) {
                        console.log('Child categories response:', data); // Debug: Log response
                        childCategorySelect.html('<option value="">Select</option>');

                        // Handle both response formats
                        let childCategories = Array.isArray(data) ? data : (data.childCategories || []);
                        if (childCategories.length > 0) {
                            $.each(childCategories, function(i, item) {
                                if (item.id && item.name) {
                                    childCategorySelect.append(
                                        `<option value="${item.id}">${item.name}</option>`
                                    );
                                } else {
                                    console.warn('Invalid child category item:', item);
                                }
                            });
                        } else {
                            console.log('No child categories available');
                            childCategorySelect.append(
                                '<option value="">No Child Categories Available</option>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Child category AJAX error:', xhr.responseText, status, error);
                        childCategorySelect.html(
                            '<option value="">Error loading child categories</option>'
                        );
                    }
                });
            });
        });
    </script>
@endpush