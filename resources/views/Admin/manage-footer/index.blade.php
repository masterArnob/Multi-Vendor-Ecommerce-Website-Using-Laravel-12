@extends('admin.layout.master')
@section('content')
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Manage Footer</h2>

                    <form action="{{ route('admin.footer-section.update', 1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 align-items-center">
                            @if (@$footer->logo !== null)
                                <div class="col-5 bg-black">
                                    <img src="{{ asset(@$footer->logo) }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
                                </div>
                                <br>
                            @endif

                            <div class="col-7">
                                
                                <div class="form-label">Logo</div>
                                <input type="file" name="logo" class="form-control">
                            </div>



                            <br>
                              @if (@$footer->logo !== null)
                                <div class="col-5 bg-black mt-3">
                                    <img src="{{ asset(@$footer->gateway_logo) }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
                                </div>
                                <br>
                            @endif
                                <div class="col-7">
                                
                                <div class="form-label">Payment Methds Logo</div>
                                <input type="file" name="gateway_logo" class="form-control">
                            </div>

                            <div class="col-md-7">
                                <div class="form-label">Conact</div>
                                <input type="text" name="phone" value="{{ old('phone', @$footer->phone) }}" class="form-control">
                                <x-input-error :messages="$errors->get('phone')" class="mt-2 text-danger" />
                            </div>
                            <div class="col-md-7">
                                <div class="form-label">Email Address</div>
                                <input type="email" name="email" class="form-control" value="{{ old('email', @$footer->email) }}">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>
                           
                          
                               <div class="col-md-7">
                                    <div class="form-label">Address</div>
                                    <textarea name="address" class="form-control summernote">{{ old('address', @$footer->address) }}</textarea>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2 text-danger" />
                                </div>
                        

                                     <div class="col-md-7">
                                <div class="form-label">Copyright</div>
                                <input type="text" name="copyright" value="{{ old('copyright', @$footer->copyright) }}" class="form-control">
                                <x-input-error :messages="$errors->get('copyright')" class="mt-2 text-danger" />
                            </div>


                            
                                     <div class="col-md-7">
                                <div class="form-label">Facebook</div>
                                <input type="url" name="fb_link" value="{{ old('fb_link', @$footer->fb_link) }}" class="form-control">
                                <x-input-error :messages="$errors->get('fb_link')" class="mt-2 text-danger" />
                            </div>



                                        <div class="col-md-7">
                                <div class="form-label">Twitter</div>
                                <input type="url" name="twitter_link" value="{{ old('twitter_link', @$footer->twitter_link) }}" class="form-control">
                                <x-input-error :messages="$errors->get('twitter_link')" class="mt-2 text-danger" />
                            </div>


                            
                                        <div class="col-md-7">
                                <div class="form-label">Instagram</div>
                                <input type="url" name="instagram_link" value="{{ old('instagram_link', @$footer->instagram_link) }}" class="form-control">
                                <x-input-error :messages="$errors->get('instagram_link')" class="mt-2 text-danger" />
                            </div>


                                     <div class="col-md-7">
                                <div class="form-label">YouTube</div>
                                <input type="url" name="youtube_link" value="{{ old('youtube_link', @$footer->youtube_link) }}" class="form-control">
                                <x-input-error :messages="$errors->get('youtube_link')" class="mt-2 text-danger" />
                            </div>


                                  <div class="col-md-7">
                                <div class="form-label">Linkdin</div>
                                <input type="url" name="linkedin_link" value="{{ old('linkedin_link', @$footer->linkedin_link) }}" class="form-control">
                                <x-input-error :messages="$errors->get('linkedin_link')" class="mt-2 text-danger" />
                            </div>


                                    <div class="col-md-7">
                                <div class="form-label">Pinterest</div>
                                <input type="url" name="pinterest_link" value="{{ old('pinterest_link', @$footer->pinterest_link) }}" class="form-control">
                                <x-input-error :messages="$errors->get('pinterest_link')" class="mt-2 text-danger" />
                            </div>


                                     <div class="col-md-7">
                                <div class="form-label">TikTok</div>
                                <input type="url" name="tiktok_link" value="{{ old('tiktok_link', @$footer->tiktok_link) }}" class="form-control">
                                <x-input-error :messages="$errors->get('tiktok_link')" class="mt-2 text-danger" />
                            </div>


                                <div class="col-md-7">
                                <div class="form-label">Whatsapp</div>
                                <input type="url" name="whatsapp_link" value="{{ old('whatsapp_link', @$footer->whatsapp_link) }}" class="form-control">
                                <x-input-error :messages="$errors->get('whatsapp_link')" class="mt-2 text-danger" />
                            </div>


                      
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary">Update Footer</button>
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
    </script>
@endpush
