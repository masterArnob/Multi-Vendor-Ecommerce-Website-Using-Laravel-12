@extends('user.layout.master')
@section('content')
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Edit Billing Address</h2>

                    <form action="{{ route('user.address.update', $address->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 align-items-center">
                          

                            <div class="col-md-7">
                                <div class="form-label">Name</div>
                                <input type="text" name="name" value="{{ old('name', $address->name) }}" class="form-control">
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                            </div>


                               <div class="col-md-7">
                                <div class="form-label">Email Address</div>
                                <input type="email" name="email" value="{{ old('email', $address->email) }}" class="form-control">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>
                          
                         
                               <div class="col-md-7">
                                <div class="form-label">Contact</div>
                                <input type="tel" name="phone" value="{{ old('phone', $address->phone) }}" class="form-control">
                                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-danger" />
                            </div>


                                      <div class="col-md-7 mt-3">
                                <div class="form-label">Country Name</div>
                                <select name="country" class="js-example-basic form-control">
                                  
                                    @forelse (config('settings.country_list') as $country)
                                         <option @selected($address->country === $country) value="{{ $country }}">{{ $country }}</option>
                                    @empty
                                   No Data Available     
                                    @endforelse
                                   
                                </select>
                            </div>


                                <div class="col-md-7">
                                <div class="form-label">State</div>
                                <input type="text" name="state" value="{{ old('state', $address->state) }}" class="form-control">
                                <x-input-error :messages="$errors->get('state')" class="mt-2 text-danger" />
                            </div>


                                <div class="col-md-7">
                                <div class="form-label">City</div>
                                <input type="text" name="city" value="{{ old('city', $address->city) }}" class="form-control">
                                <x-input-error :messages="$errors->get('city')" class="mt-2 text-danger" />
                            </div>


                                  <div class="col-md-7">
                                <div class="form-label">Zip</div>
                                <input type="text" name="zip" value="{{ old('zip', $address->zip) }}" class="form-control">
                                <x-input-error :messages="$errors->get('zip')" class="mt-2 text-danger" />
                            </div>


                               <div class="col-md-7">
                                    <div class="form-label">Address</div>
                                    <textarea name="address" class="form-control summernote">{!! $address->address !!}</textarea>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2 text-danger" />
                                </div>



                           


                           


                            


                       

                        <div class="mt-4">
                            <button class="btn btn-primary">Update Address</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
@endsection
@push('scripts')
    <script>
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']]
            ]
        });

    

        $(document).ready(function() {
            $('.js-example-basic').select2();
        });

    </script>
@endpush
