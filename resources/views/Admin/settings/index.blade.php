@extends('admin.layout.master')
@section('content')
<div class="card">
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">General Settings</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a href="#tabs-profile-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Profile</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a href="#tabs-activity-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Activity</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="tabs-home-8" role="tabpanel">
                        <h4>General Settings</h4>
                        <div>
                            <form action="{{ route('admin.settings.update', 1) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="general_settings" value="general_settings">

                              <div class="col-md-7">
                                <div class="form-label">Site Name</div>
                                <input type="text" name="site_name" class="form-control" value="{{ @$settings->site_name }}">
                                <x-input-error :messages="$errors->get('site_name')" class="mt-2 text-danger" />
                            </div>

                              <div class="col-md-7 mt-3">
                                <div class="form-label">Layout</div>
                                <select name="layout" class="form-select">
                                    <option @selected(@$settings->layout === 'RTL') value="RTL">RTL</option>
                                    <option @selected(@$settings->layout === 'LTR') value="LTR">LTR</option>
                                </select>
                            </div>

                               <div class="col-md-7 mt-3">
                                <div class="form-label">Contact Email</div>
                                <input type="email" name="contact_email" class="form-control" value="{{ @$settings->contact_email }}">
                                <x-input-error :messages="$errors->get('contact_email')" class="mt-2 text-danger" />
                            </div>


                                <div class="col-md-7 mt-3">
                                <div class="form-label">Contact Phone</div>
                                <input type="tel" name="contact_phone" class="form-control" value="{{ @$settings->contact_phone }}">
                                <x-input-error :messages="$errors->get('contact_phone')" class="mt-2 text-danger" />
                            </div>


                               <div class="col-md-7 mt-3">
                                    <div class="form-label">Contact Address</div>
                                    <textarea name="contact_address" class="form-control summernote">{!! @$settings->contact_address !!}</textarea>
                                    <x-input-error :messages="$errors->get('contact_address')" class="mt-2 text-danger" />
                                </div>


                                      <div class="col-md-7 mt-3">
                                <div class="form-label">Map</div>
                                <input type="text" name="map" class="form-control" value="{{ @$settings->map }}">
                                <x-input-error :messages="$errors->get('map')" class="mt-2 text-danger" />
                            </div>


                              <div class="col-md-7 mt-3">
                                <div class="form-label">Currency Name</div>
                                <select name="currency_name" class="js-example-basic form-control">
                                    <option value="">Select</option>
                                    @forelse (config('settings.currency_list') as $currency)
                                         <option @selected(@$settings->currency_name === $currency) value="{{ $currency }}">{{ $currency }}</option>
                                    @empty
                                   No Data Available     
                                    @endforelse
                                   
                                </select>
                            </div>


                                  <div class="col-md-7 mt-3">
                                <div class="form-label">Currency Icon</div>
                                <input type="text" name="currency_icon" class="form-control" value="{{ @$settings->currency_icon }}">
                                <x-input-error :messages="$errors->get('currency_icon')" class="mt-2 text-danger" />
                            </div>


                              <div class="col-md-7 mt-3">
                                <div class="form-label">Time Zone</div>
                                <select name="time_zone" class="js-example-basic form-control">
                                    <option value="">Select</option>
                                    @forelse (config('settings.time_zone') as $key => $time_zone)
                                         <option @selected(@$settings->time_zone === $key) value="{{ $key }}">{{ $key }}</option>
                                    @empty
                                   No Data Available     
                                    @endforelse
                                   
                                </select>
                            </div>


                                 <div class="mt-4">
                            <button class="btn btn-primary">Update</button>
                        </div>

                            </form>

                        </div>
                      </div>
                      <div class="tab-pane fade" id="tabs-profile-8" role="tabpanel">
                        <h4>Profile tab</h4>
                        <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc amet, pellentesque id egestas velit sed</div>
                      </div>
                      <div class="tab-pane fade" id="tabs-activity-8" role="tabpanel">
                        <h4>Activity tab</h4>
                        <div>Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi sit mauris accumsan nibh habitant senectus</div>
                      </div>
                    </div>
                  </div>
                </div>
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

        // Initialize all datepickers with class 'datepicker'
        document.addEventListener("DOMContentLoaded", function() {
            window.Litepicker && document.querySelectorAll('.datepicker').forEach(function(element) {
                new Litepicker({
                    element: element,
                    buttonText: {
                        previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                    },
                });
            });
        });

        $(document).ready(function() {
            $('.js-example-basic').select2();
        });

    </script>
@endpush


