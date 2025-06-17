@extends('user.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        My Addresses
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                        <a href="{{ route('user.address.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#modal-report" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
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


                <div class="row g-2">
                    @forelse ($addresses as $address)
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Billing Address</h3>
                                    <div class="card-actions">
                                        <a href="{{ route('user.address.edit', $address->id) }}" class="btn btn-primary">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 5l0 14"></path>
                                                <path d="M5 12l14 0"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <a href="{{ route('user.address.destroy', $address->id) }}"
                                            class="btn btn-danger delete-item">
                                            Delete
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body px-3">
                                    <div class="datagrid">
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Name</div>
                                            <div class="datagrid-content">{{ $address->name }}</div>
                                        </div>

                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Email Address</div>
                                            <div class="datagrid-content">{{ $address->email }}</div>
                                        </div>

                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Contact</div>
                                            <div class="datagrid-content">{{ $address->phone }}</div>
                                        </div>

                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Country</div>
                                            <div class="datagrid-content">{{ $address->country }}</div>
                                        </div>


                                        <div class="datagrid-item">
                                            <div class="datagrid-title">State</div>
                                            <div class="datagrid-content">{{ $address->state }}</div>
                                        </div>

                                        <div class="datagrid-item">
                                            <div class="datagrid-title">City</div>
                                            <div class="datagrid-content">{{ $address->city }}</div>
                                        </div>


                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Zip</div>
                                            <div class="datagrid-content">{{ $address->zip }}</div>
                                        </div>

                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Address</div>
                                            <div class="datagrid-content">{!! $address->address !!}</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        No Data Available
                    @endforelse
                </div>

                {{-- 
                 <div class="col-6 col-sm-4">
                        <label class="form-imagecheck mb-2">
                            <input name="form-imagecheck-radio" type="radio" value="1" class="form-imagecheck-input">
                            <span class="form-imagecheck-figure">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Base info</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="datagrid">
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Registrar</div>
                                                <div class="datagrid-content">Third Party</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Nameservers</div>
                                                <div class="datagrid-content">Third Party</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Port number</div>
                                                <div class="datagrid-content">3306</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Expiration date</div>
                                                <div class="datagrid-content">–</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Creator</div>
                                                <div class="datagrid-content">
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-xs me-2 rounded"
                                                            style="background-image: url(./static/avatars/000m.jpg)"></span>
                                                        Paweł Kuna
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Age</div>
                                                <div class="datagrid-content">15 days</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Edge network</div>
                                                <div class="datagrid-content">
                                                    <span class="status status-green">
                                                        Active
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Avatars list</div>
                                                <div class="datagrid-content">
                                                    <div class="avatar-list avatar-list-stacked">
                                                        <span class="avatar avatar-xs rounded"
                                                            style="background-image: url(./static/avatars/000m.jpg)"></span>
                                                        <span class="avatar avatar-xs rounded">JL</span>
                                                        <span class="avatar avatar-xs rounded"
                                                            style="background-image: url(./static/avatars/002m.jpg)"></span>
                                                        <span class="avatar avatar-xs rounded"
                                                            style="background-image: url(./static/avatars/003m.jpg)"></span>
                                                        <span class="avatar avatar-xs rounded"
                                                            style="background-image: url(./static/avatars/000f.jpg)"></span>
                                                        <span class="avatar avatar-xs rounded">+3</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Checkbox</div>
                                                <div class="datagrid-content">
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" checked="">
                                                        <span class="form-check-label">Click me</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Icon</div>
                                                <div class="datagrid-content">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M5 12l5 5l10 -10"></path>
                                                    </svg>
                                                    Checked
                                                </div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Form control</div>
                                                <div class="datagrid-content">
                                                    <input type="text" class="form-control form-control-flush"
                                                        placeholder="Input placeholder">
                                                </div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Longer description</div>
                                                <div class="datagrid-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </span>
                        </label>
                    </div>   
                --}}

            </div>
        </div>
    </div>
    <!-- Page body -->
@endsection
