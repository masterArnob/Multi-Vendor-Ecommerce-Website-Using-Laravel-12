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
                        <h2 class="mb-4">Top Category Section</h2>

                        <form action="{{ route('admin.top-category.update', 1) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3 align-items-center">



                                <div class="col-md-12">
                                    <div class="row">
                                        <h3>Category 1</h3>
                                        <div class="col-md-4">
                                            <div class="form-label">Category</div>
                                            <select name="cat_one" class="form-select category">
                                                <option value="">Select</option>
                                                @forelse ($categories as $category)
                                                    <option @selected($category->id == @$topCat[0]->category) value="{{ $category->id }}">{{ $category->name }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse
                                            </select>
                                                <x-input-error :messages="$errors->get('cat_one')" class="mt-2 text-danger" />
                                        </div>

                                        <div class="col-md-4">
                                            @php
                                                $subCats = App\Models\SubCategory::where('category_id', @$topCat[0]->category)
                                                ->where('status', 1)
                                                ->get();
                                            @endphp
                                            <div class="form-label">Sub Category</div>
                                            <select name="sub_cat_one" class="form-select sub-category">
                                                <option value="">Select</option>
                                               @forelse ($subCats as $subCat)
                                                   <option @selected($subCat->id == @$topCat[0]->sub_category) value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                                               @empty
                                                   No Data Available
                                               @endforelse
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            @php
                                                $childCats = App\Models\ChildCategory::where('sub_category_id', @$topCat[0]->sub_category)
                                                ->where('status', 1)
                                                ->get();
                                            @endphp
                                            <div class="form-label">Child Category</div>
                                            <select name="child_cat_one" class="form-select child-category">
                                                <option value="">Select</option>
                                                @forelse ($childCats as $childCat)
                                                    <option @selected($childCat->id == @$topCat[0]->child_category) value="{{ $childCat->id }}">{{ $childCat->name }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="row">
                                        <h3>Category 2</h3>
                                        <div class="col-md-4">
                                            <div class="form-label">Category</div>
                                            <select name="cat_two" class="form-select category">
                                                <option value="">Select</option>
                                                @forelse ($categories as $category)
                                                    <option @selected($category->id == @$topCat[1]->category) value="{{ $category->id }}">{{ $category->name }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse


                                            </select>
                                                <x-input-error :messages="$errors->get('cat_two')" class="mt-2 text-danger" />
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-label">Sub Category</div>
                                              @php
                                                $subCats = App\Models\SubCategory::where('category_id', @$topCat[1]->category)
                                                ->where('status', 1)
                                                ->get();
                                            @endphp

                                            <select name="sub_cat_two" class="form-select sub-category">
                                                <option value="">Select</option>
                                                 @forelse ($subCats as $subCat)
                                                   <option @selected($subCat->id == @$topCat[1]->sub_category) value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                                               @empty
                                                   No Data Available
                                               @endforelse

                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                              @php
                                                $childCats = App\Models\ChildCategory::where('sub_category_id', @$topCat[1]->sub_category)
                                                ->where('status', 1)
                                                ->get();
                                            @endphp
                                            <div class="form-label">Child Category</div>
                                            <select name="child_cat_two" class="form-select child-category">
                                                <option value="">Select</option>
                                                  @forelse ($childCats as $childCat)
                                                    <option @selected($childCat->id == @$topCat[1]->child_category) value="{{ $childCat->id }}">{{ $childCat->name }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse

                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="row">
                                        <h3>Category 3</h3>
                                        <div class="col-md-4">
                                            <div class="form-label">Category</div>
                                            <select name="cat_three" class="form-select category">
                                                <option value="">Select</option>
                                                @forelse ($categories as $category)
                                                    <option @selected($category->id == @$topCat[2]->category) value="{{ $category->id }}">{{ $category->name }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse


                                            </select>
                                                <x-input-error :messages="$errors->get('cat_three')" class="mt-2 text-danger" />
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-label">Sub Category</div>
                                               @php
                                                $subCats = App\Models\SubCategory::where('category_id', @$topCat[2]->category)
                                                ->where('status', 1)
                                                ->get();
                                            @endphp
                                            <select name="sub_cat_three" class="form-select sub-category">
                                                <option value="">Select</option>
                                                  @forelse ($subCats as $subCat)
                                                   <option @selected($subCat->id == @$topCat[2]->sub_category) value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                                               @empty
                                                   No Data Available
                                               @endforelse

                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-label">Child Category</div>
                                            @php
                                                $childCats = App\Models\ChildCategory::where('sub_category_id', @$topCat[2]->sub_category)
                                                ->where('status', 1)
                                                ->get();
                                            @endphp
                                            <select name="child_cat_three" class="form-select child-category">
                                                <option value="">Select</option>
                                                 @forelse ($childCats as $childCat)
                                                    <option @selected($childCat->id == @$topCat[2]->child_category) value="{{ $childCat->id }}">{{ $childCat->name }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="row">
                                        <h3>Category 4</h3>
                                        <div class="col-md-4">
                                            <div class="form-label">Category</div>
                                            <select name="cat_four" class="form-select category">
                                                <option value="">Select</option>
                                                @forelse ($categories as $category)
                                                    <option @selected($category->id == @$topCat[3]->category) value="{{ $category->id }}">{{ $category->name }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse

                                            </select>
                                                <x-input-error :messages="$errors->get('cat_four')" class="mt-2 text-danger" />
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-label">Sub Category</div>
                                            @php
                                                $subCats = App\Models\SubCategory::where('category_id', @$topCat[3]->category)
                                                ->where('status', 1)
                                                ->get();
                                            @endphp
                                            <select name="sub_cat_four" class="form-select sub-category">
                                                <option value="">Select</option>
                                                 @forelse ($subCats as $subCat)
                                                   <option @selected($subCat->id == @$topCat[3]->sub_category) value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                                               @empty
                                                   No Data Available
                                               @endforelse
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-label">Child Category</div>
                                            @php
                                                $childCats = App\Models\ChildCategory::where('sub_category_id', @$topCat[3]->sub_category)
                                                ->where('status', 1)
                                                ->get();
                                            @endphp
                                            <select name="child_cat_four" class="form-select child-category">
                                                <option value="">Select</option>
                                                  @forelse ($childCats as $childCat)
                                                    <option @selected($childCat->id == @$topCat[3]->child_category) value="{{ $childCat->id }}">{{ $childCat->name }}</option>
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