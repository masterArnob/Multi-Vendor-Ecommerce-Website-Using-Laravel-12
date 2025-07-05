@extends('admin.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
             
                    <h2 class="page-title">
                        Vendor Withdraw Requests
                    </h2>
                </div>
                <!-- Page title actions -->
                   <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                      
                
                    
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

                {{ $dataTable->table() }}


            </div>
        </div>
    </div>
    <!-- Page body -->





@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush