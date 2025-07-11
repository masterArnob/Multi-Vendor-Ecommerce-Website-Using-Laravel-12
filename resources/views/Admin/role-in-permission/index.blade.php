@extends('admin.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
             
                    <h2 class="page-title">
                        Manage Role in Permission
                    </h2>
                </div>
                <!-- Page title actions -->
                   <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                      
                        <a href="{{ route('admin.role-in-permission.create') }}" class="btn btn-primary d-none d-sm-inline-block" >
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new 
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
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Role Name</th>
                          <th>Permissions</th>
                          <th>Actions</th>
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td width="70%">
                               
                                    @foreach($role->permissions as $permission)
                                        <span class="badge bg-success text-white mt-2">{{ $permission->name }}</span>
                                    @endforeach
                         
                                </td>
                                <td>
                                    <a href="{{ route('admin.role-in-permission.edit', $role->id) }}" class="btn btn btn-primary">Edit</a>
                                     <a href="{{ route('admin.role-in-permission.destroy', $role->id) }}" class="btn btn-danger delete-item">Delete</a>
                                   
                                   
                                   
                                
                                </td>
                            </tr>
                        @endforeach
                      
                      </tbody>
                    </table>
                  </div>
                </div>








              


            </div>
        </div>
    </div>
    <!-- Page body -->





@endsection
