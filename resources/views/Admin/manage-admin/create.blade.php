@extends('admin.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        Manage Admin
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
                        <h2 class="mb-4">Create Admin Account</h2>
                        <h3 class="card-title">Profile Details</h3>
                       <form action="{{ route('admin.manage-admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      
                         <div class="row align-items-center">

                            <div class="col-auto"> <input type="file" name="image" class="form-control"></div>

                        </div>
                        <h3 class="card-title mt-4"></h3>
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="form-label">Name</div>
                                <input type="text" name="name" class="form-control">
                                 <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                            </div>
                            <div class="col-md">
                                <div class="form-label">Email Address</div>
                                <input type="email" name="email" class="form-control">
                                  <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>




                            <div class="col-md">
                                <div class="form-label">Password</div>
                                <input type="password" name="password" class="form-control">
                                  <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                            </div>

                        </div>



                                  <div class="row g-3 mt-1">
                            <div class="col-md">
                                <div class="form-label">Contact</div>
                                <input type="tel" name="contact" class="form-control">
                                 <x-input-error :messages="$errors->get('contact')" class="mt-2 text-danger" />
                            </div>
                            <div class="col-md">
                                <div class="form-label">Address</div>
                                <input type="text" name="address" class="form-control">
                                  <x-input-error :messages="$errors->get('address')" class="mt-2 text-danger" />
                            </div>





                        </div>

                     
                   

                        <button class="btn btn-primary mt-4">Create Admin</button>
                       </form>

               
                    

                     
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
@endsection