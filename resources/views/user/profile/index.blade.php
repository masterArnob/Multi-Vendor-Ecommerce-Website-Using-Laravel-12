@extends('user.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        User Profile
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
                    <div class="card-body">
                        <h2 class="mb-4">My Account</h2>
                        <h3 class="card-title">Profile Details</h3>
                       <form action="{{ route('user.profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                         <div class="row align-items-center">
                            <div class="col-auto"><span class="avatar avatar-xl"
                                    style="background-image: url({{ Auth::user()->image }})"></span>
                            </div>
                            <div class="col-auto"> <input type="file" name="image" class="form-control"></div>

                        </div>
                        <h3 class="card-title mt-4"></h3>
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="form-label">Name</div>
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                 <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                            </div>
                            <div class="col-md">
                                <div class="form-label">Email Address</div>
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                                  <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>

                        </div>

                        <input type="hidden" name="update_type" value="profile_update">

                        <button class="btn btn-primary mt-4">Update Details</button>
                       </form>

                        <h3 class="card-title mt-4">Password</h3>
                        <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login
                            codes.</p>

                         
                       <form action="{{ route('user.profile.update', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                             <div class="col-5">
                                 <div class="form-label">Current Password</div>
                                  <input class="form-control" name="current_password" type="password">
                                   <x-input-error :messages="$errors->get('current_password')" class="mt-2 text-danger" />

                                   <div class="form-label mt-3">New Password</div>
                                  <input class="form-control" name="password" type="password">
                                  <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />

                                   <div class="form-label mt-3">Confirm Password</div>
                                  <input class="form-control" name="password_confirmation" type="password">
                                   <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                            </div>

                              <input type="hidden" name="update_type" value="password_update">

                             <button class="btn btn-primary mt-4">Update Password</button>
                       </form>
                    

                     
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
@endsection