@extends('admin.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Manage Users
                    </div>
                    <h2 class="page-title">
                        People Who wants to be a vendor
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn">
                                New view
                            </a>
                        </span>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new report
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#modal-report" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </a>
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
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <tbody>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        <span class="avatar avatar-xl"
                                            style="background-image: url({{ asset($user->image) }})"></span>
                                    </td>
                                </tr>

                            
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><a href="mailto:{{ $user->email }}" class="text-reset">{{ $user->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Contact</th>
                                    <td><a href="tel:{{ $user->contact }}" class="text-reset">{{ $user->contact }}</a>
                                    </td>
                                </tr>


                                  <tr>
                                    <th>Applied For Vendor</th>
                                    <td>
                                        <span class="{{ $user->vendor_request === 1 ? 'badge bg-green-lt' : 'badge bg-orange-lt' }}">{{ $user->vendor_request === 1 ? 'Yes' : 'No' }}</span>
                                    </td>
                                </tr>
                               

                              


                           


                            
                              
                              
                                <tr>
                                    <th>User Status</th>

                                    <td>
                                        <form action="{{ route('admin.manage-user.update', $user->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <select name="user_status" class="form-select">
                                                <option @selected($user->user_status === 'active') value="active">
                                                    Active</option>
                                                <option @selected($user->user_status === 'inactive') value="inactive">
                                                    Inactive</option>
    
                                                <option @selected($user->user_status === 'banned') value="banned">Banned
                                                </option>


                                            </select>

                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-outline-primary mt-5">Update Vendor
                                            Status</button>
                                    </td>
                                </tr>

                                </form>

                                </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
@endsection