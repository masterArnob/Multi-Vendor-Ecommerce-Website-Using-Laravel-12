@extends('admin.layout.master')
@section('content')
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Create Roles</h2>

                        <form action="{{ route('admin.role.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3 align-items-center">


                                <div class="col-md-7">
                                    <div class="form-label">Name</div>
                                    <input type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                </div>





                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary">Update Role</button>
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
