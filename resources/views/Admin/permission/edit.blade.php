@extends('admin.layout.master')
@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Create Permissions</h2>

                        <form action="{{ route('admin.permission.update', $permission->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3 align-items-center">


                                <div class="col-md-7">
                                    <div class="form-label">Name</div>
                                    <input type="text" name="name" value="{{ old('name', $permission->name) }}" class="form-control">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                </div>





                                <div class="col-md-7 mt-3">
                                    <div class="form-label">Group Name</div>
                                    <select name="group_name" class="form-select">
                                    
                                        <option @selected($permission->group_name == 'manage_vendors') value="manage_vendors">Manage Vendors</option>
                                        <option @selected($permission->group_name == 'manage_users') value="manage_users">Manage Users</option>
                                        <option @selected($permission->group_name == 'manage_admins') value="manage_admins">Manage Admins</option>
                                        <option @selected($permission->group_name == 'manage_category') value="manage_category">Manage Category</option>
                                        <option @selected($permission->group_name == 'manage_sections') value="manage_sections">Manage Sections</option>
                                        <option @selected($permission->group_name == 'manage_pages') value="manage_pages">Manage Pages</option>
                                        <option @selected($permission->group_name == 'manage_products') value="manage_products">Manage Products</option>
                                        <option @selected($permission->group_name == 'manage_coupons') value="manage_coupons">Manage Coupons</option>
                                        <option @selected($permission->group_name == 'manage_reviews') value="manage_reviews">Manage Reviews</option>
                                        <option @selected($permission->group_name == 'manage_orders') value="manage_orders">Manage Orders</option>
                                        <option @selected($permission->group_name == 'manage_roles_and_permissions') value="manage_roles_and_permissions">Manage Roles and Permissions</option>
                                        <option @selected($permission->group_name == 'manage_settings') value="manage_settings">Manage Settings</option>


                                    </select>
                                    @error('group_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary">Update Permission</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
@endsection

