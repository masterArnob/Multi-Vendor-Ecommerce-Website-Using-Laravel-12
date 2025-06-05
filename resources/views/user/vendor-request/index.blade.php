@extends('user.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        Vendor Request
                    </h2>
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
                        <h2 class="mb-4">Send Request To Be Vendor</h2>
                        <h3 class="card-title">Profile Details</h3>
                       <form action="{{ route('user.vendor-request.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                         <div class="row align-items-center">
                     
                            <div class="form-label">Document</div>
                            <div class="col-auto"> <input type="file" name="document" class="form-control"></div>
                             <x-input-error :messages="$errors->get('document')" class="mt-2" />

                        </div>
                        <h3 class="card-title mt-4"></h3>
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="form-label">Contact</div>
                                <input type="tel" name="contact" class="form-control">
                                 <x-input-error :messages="$errors->get('contact')" class="mt-2 text-danger" />
                            </div>
                         

                        </div>



                        <button class="btn btn-primary mt-4">Send Request</button>
                       </form>

                    

                         
                 
                    

                     
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
@endsection


{{-- 
<x-guest-layout>
    <form method="POST" action="{{ route('user.vendor-request.update', Auth::user()->id) }}" enctype="multipart/form-data">
        @csrf

        @method('PUT')

        <h1>Vendor Request</h1>
   
         <div>
            <x-input-label for="Document" :value="__('Document')" />
            <x-text-input id="document" class="block mt-1 w-full" type="file" name="document" :value="old('document')" required autofocus />
            <x-input-error :messages="$errors->get('document')" class="mt-2" />
        </div>


    




           <div class="mt-4">
            <x-input-label for="contact" :value="__('contact')" />
            <x-text-input id="contact" class="block mt-1 w-full" type="number" name="contact" :value="old('contact')" required autocomplete="contact" />
            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
        </div>




        <div class="flex items-center justify-end mt-4">
          

            <x-primary-button class="ms-4">
                {{ __('Send Request') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

--}}
