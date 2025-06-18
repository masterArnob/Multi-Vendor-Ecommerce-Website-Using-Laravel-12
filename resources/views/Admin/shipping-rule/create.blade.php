@extends('admin.layout.master')
@section('content')
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Shipping Rule Details</h2>

                    <form action="{{ route('admin.shipping-rule.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 align-items-center">
                         

                             <div class="col-md-7">
                                <div class="form-label">Name</div>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Type</div>
                                <select name="type" class="form-control type">
                                <option value="">Select</option>
                                <option value="flat_cost">Flat Cost</option>
                                 <option value="min_cost">Minimum Order Amount</option>
                                </select>
                            </div>
                            <div class="col-md-7">
                                <div class="form-label">Minimim Cost</div>
                                <input type="text" name="min_cost" class="form-control min_cost" value="{{ old('min_cost') }}">
                                <x-input-error :messages="$errors->get('min_cost')" class="mt-2 text-danger" />
                            </div>

                              <div class="col-md-7">
                                <div class="form-label">Cost</div>
                                <input type="text" name="cost" class="form-control cost" value="{{ old('cost') }}">
                                <x-input-error :messages="$errors->get('cost')" class="mt-2 text-danger" />
                            </div>

                  
                            <div class="col-md-7">
                                <div class="form-label">Status</div>
                                <select name="status" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary">Create Shipping Rule</button>
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
        // Function to toggle visibility of min_cost field based on type
        function toggleMinCostField(type) {
            if (type === 'min_cost') {
                $('.min_cost').closest('.col-md-7').show(); // Show min_cost field
            } else {
                $('.min_cost').closest('.col-md-7').hide(); // Hide min_cost field
            }
        }

        // Initialize visibility based on the default selected value
        toggleMinCostField($('.type').val());

        // Update visibility when the type select changes
        $('.type').on('change', function() {
            let type = $(this).val();
            console.log('Selected type:', type); // For debugging
            toggleMinCostField(type);
        });
    });
</script>
@endpush