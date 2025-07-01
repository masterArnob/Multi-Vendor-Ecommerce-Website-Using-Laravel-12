@extends('admin.layout.master')
@section('content')
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Manage SMTP Config</h2>

                    <form action="{{ route('admin.smtp-config.update', 1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 align-items-center">
                    

                        

    
                            <div class="col-md-7">
                                <div class="form-label">Email Address</div>
                                <input type="email" name="email" class="form-control" value="{{ old('email', @$smtpConfig->email) }}">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>
                           
                          
                         
                        

                                     <div class="col-md-7">
                                <div class="form-label">Host</div>
                                <input type="text" name="host" value="{{ old('host', @$smtpConfig->host) }}" class="form-control">
                                <x-input-error :messages="$errors->get('host')" class="mt-2 text-danger" />
                            </div>


                            
                                     <div class="col-md-7">
                                <div class="form-label">User Name</div>
                                <input type="text" name="username" value="{{ old('username', @$smtpConfig->username) }}" class="form-control">
                                <x-input-error :messages="$errors->get('username')" class="mt-2 text-danger" />
                            </div>



                                        <div class="col-md-7">
                                <div class="form-label">Password</div>
                                <input type="password" name="password" value="{{ old('password', @$smtpConfig->password) }}" class="form-control">
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                            </div>


                            
                                        <div class="col-md-7">
                                <div class="form-label">Port</div>
                                <input type="text" name="port" value="{{ old('port', @$smtpConfig->port) }}" class="form-control">
                                <x-input-error :messages="$errors->get('port')" class="mt-2 text-danger" />
                            </div>


                                  <div class="col-md-7">
                                <div class="form-label">Encryption</div>
                                <select name="encryption" class="form-select">
                                    <option value="">Select</option>
                                    <option @selected($smtpConfig->encryption == 'tls') value="tls">TLS</option>
                                    <option @selected($smtpConfig->encryption == 'ssl') value="ssl">SSL</option>
                                </select>
                                 @error('encryption')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror
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

