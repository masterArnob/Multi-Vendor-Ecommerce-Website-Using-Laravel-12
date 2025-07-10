@extends('admin.layout.master')
@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Create Permissions</h2>

                        <form action="{{ route('admin.permission.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3 align-items-center">


                                <div class="col-md-7">
                                    <div class="form-label">Name</div>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                </div>





                                <div class="col-md-7 mt-3">
                                    <div class="form-label">Group Name</div>
                                    <select name="group_name" class="form-select">
                                        <option value="">Select</option>
                                        <option value="manage_vendors">Manage Vendors</option>
                                        <option value="manage_users">Manage Users</option>
                                        <option value="manage_admins">Manage Admins</option>
                                        <option value="manage_category">Manage Category</option>
                                        <option value="manage_sections">Manage Sections</option>
                                        <option value="manage_pages">Manage Pages</option>
                                        <option value="manage_products">Manage Products</option>
                                        <option value="manage_coupons">Manage Coupons</option>
                                        <option value="manage_reviews">Manage Reviews</option>
                                        <option value="manage_orders">Manage Orders</option>
                                        <option value="manage_roles_and_permissions">Manage Roles and Permissions</option>
                                        <option value="manage_settings">Manage Settings</option>


                                    </select>
                                    @error('group_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary">Create Permission</button>
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
