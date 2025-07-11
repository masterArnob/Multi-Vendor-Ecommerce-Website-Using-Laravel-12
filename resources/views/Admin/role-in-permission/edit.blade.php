@extends('admin.layout.master')
@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Manage Roles in Permission</h2>

                        <form action="{{ route('admin.role-in-permission.update', $roleInPermission->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3 align-items-center">

                                <div class="col-md-7 mt-3">
                                    <div class="form-label">Role</div>
                                    <select name="role_id" class="form-select">
                                       
                                        @forelse ($roles as $role)
                                            <option @selected($roleInPermission->id == $role->id) value="{{ $role->id }}">{{ $role->name }}</option>
                                        @empty
                                            No Data Available
                                        @endforelse


                                    </select>
                                    @error('role_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>




                                <div class="col-md-7">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" id="select-all">
                                        <span class="form-check-label">All Permissions</span>
                                    </label>
                                </div>



                          



                   @forelse ($permission_group_names as $name)
    <div class="row mb-4">
        <div class="col-3">
            <label class="form-check">
              
                <span class="form-check-label">{{ $name }}</span>
            </label>
        </div>

        <div class="col-9">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    @foreach($getPermissionByGroupNames->where('group_name', $name)->take(ceil($getPermissionByGroupNames->where('group_name', $name)->count()/2)) as $permission)
                        <label class="form-check d-block mb-2">
                            <input class="form-check-input permission-checkbox" 
                                   name="permissions[]" 
                                   value="{{ $permission->id }}" 
                                   type="checkbox"
                                   data-group="{{ $name }}"
                                   @checked($roleInPermission->permissions->contains($permission->id))
                                   >
                            <span class="form-check-label">{{ $permission->name }}</span>
                        </label>
                    @endforeach
                </div>
                
                <!-- Right Column -->
                <div class="col-md-6">
                    @foreach($getPermissionByGroupNames->where('group_name', $name)->slice(ceil($getPermissionByGroupNames->where('group_name', $name)->count()/2)) as $permission)
                        <label class="form-check d-block mb-2">
                            <input class="form-check-input permission-checkbox" 
                                   name="permissions[]" 
                                   value="{{ $permission->id }}" 
                                   type="checkbox"
                                   data-group="{{ $name }}">
                            <span class="form-check-label">{{ $permission->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">No Data Available</div>
@endforelse



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
            // Select/Deselect all checkboxes
            $('#select-all').click(function() {
                $('.permission-checkbox').prop('checked', this.checked);
            });

            // Deselect "Select All" if any checkbox is unchecked
            $('.permission-checkbox').change(function() {
                if (!this.checked) {
                    $('#select-all').prop('checked', false);
                }
            });

            // Group checkbox functionality
            $('.group-checkbox').click(function() {
                var group = $(this).data('group');
                $('.permission-checkbox[data-group="' + group + '"]').prop('checked', this.checked);
            });
        }); 
    </script>
@endpush
