@extends('admin.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
             
                    <h2 class="page-title">
                        Manage Subscribers
                    </h2>
                </div>
                <!-- Page title actions -->
               
    
            </div>
        </div>
    </div>
    <!-- Page header -->
        <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-8">

               <form action="{{ route('admin.news-letter.store') }}" method="POST">
                @csrf
                <label for="" class="form-label">Subjact</label>
                <input type="text" name="subject" class="form-control mb-2" placeholder="Enter Subject">
                 <x-input-error :messages="$errors->get('subject')" class="mt-2 text-danger" />
                <label for="" class="form-label mt-2">Message</label>
                <textarea name="message" class="form-control mb-2" placeholder="Enter Message"></textarea>
                 <x-input-error :messages="$errors->get('message')" class="mt-2 text-danger" />
                <button type="submit" class="btn btn-primary mt-3">Send</button>
               </form>


            </div>
        </div>
    </div>
    <!-- Page body -->

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