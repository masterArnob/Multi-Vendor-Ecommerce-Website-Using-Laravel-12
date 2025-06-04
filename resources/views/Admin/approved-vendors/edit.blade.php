@extends('admin.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Approved Vendors Edit
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
                                            style="background-image: url({{ asset($request->image) }})"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Banner</th>
                                    <td>
                                        <div class="img-responsive img-responsive-3x1 rounded-3 border"
                                            style="background-image: url({{ asset($request->banner) }})"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $request->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><a href="mailto:{{ $request->email }}" class="text-reset">{{ $request->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Contact</th>
                                    <td><a href="tel:{{ $request->contact }}" class="text-reset">{{ $request->contact }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>{{ $request->role }}</td>
                                </tr>
                                <tr>
                                    <th>Vendor Request</th>
                                    <td>{{ $request->vendor_request === 1 ? 'yes' : 'no' }}</td>
                                </tr>

                                <tr>
                                    <th>Address</th>
                                    <td>{{ $request->address }}</td>
                                </tr>

                                <tr>
                                    <th>Description</th>
                                    <td>{{ $request->desc }}</td>
                                </tr>


                                <tr>
                                    <th>FaceBook Link</th>
                                    <td><a href="{{ $request->fb_link }}">{{ $request->fb_link }}</a></td>
                                </tr>

                                <tr>
                                    <th>X Link</th>
                                    <td><a href="{{ $request->tw_link }}">{{ $request->tw_link }}</a></td>
                                </tr>


                                <tr>
                                    <th>Instagram Link</th>
                                    <td><a href="{{ $request->insta_link }}">{{ $request->insta_link }}</a></td>
                                </tr>


                                <tr>
                                    <th>Tik Tok Link</th>
                                    <td><a href="{{ $request->tiktok_link }}">{{ $request->tiktok_link }}</a></td>
                                </tr>

                                <tr>
                                    <th>YouTube Link</th>
                                    <td><a href="{{ $request->yt_link }}">{{ $request->yt_link }}</a></td>
                                </tr>

                                <tr>
                                    <th>Document</th>
                                    <td>
                                        @if ($request->document)
                                            @php
                                                $extension = pathinfo($request->document, PATHINFO_EXTENSION);
                                                $viewableExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'gif'];
                                            @endphp
                                            @if (in_array(strtolower($extension), $viewableExtensions))
                                                <div class="mb-3">
                                                    <iframe src="{{ asset($request->document) }}"
                                                        style="width: 100%; height: 500px; border: none;"
                                                        title="Document Preview"></iframe>
                                                </div>
                                            @endif
                                            <a href="{{ asset($request->document) }}" download class="btn btn-outline-primary">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/download -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-download" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                    <path d="M7 11l5 5l5 -5" />
                                                    <path d="M12 4v12" />
                                                </svg>
                                                Download Document
                                            </a>
                                        @else
                                            <p>No document available</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Vendor Status</th>

                                    <td>
                                        <form action="{{ route('admin.approved-vendors.update', $request->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <select name="vendor_status" class="form-select">
                                                <option @selected($request->vendor_status === 'approved') value="approved">
                                                    Approved</option>
                                                <option @selected($request->vendor_status === 'pending') value="pending">
                                                    Pending</option>
                                                <option @selected($request->vendor_status === 'rejected') value="rejected">
                                                    Rejected</option>
                                                <option @selected($request->vendor_status === 'banned') value="banned">Banned
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