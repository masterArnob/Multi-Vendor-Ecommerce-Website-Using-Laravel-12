@extends('admin.layout.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#tabs-home-8" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                        role="tab">Paypal Settings</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-profile-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab"
                        tabindex="-1">Stripe Settings</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#tabs-activity-8" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab"
                        tabindex="-1">SslCommerz Settings</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="tabs-home-8" role="tabpanel">
                    <h4>Paypal Settings</h4>
                    <div>
                        <form action="{{ route('admin.payment-settings.update', 1) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <input type="hidden" name="payment_method" value="paypal">

                            <div class="col-md-7 mt-3">
                                <div class="form-label">Mode</div>
                                <select name="paypal_mode" class="form-control">
                                    <option value="">Select</option>
                                    <option @selected(@$paymentSettings['paypal_mode'] === 'live') value="live">Live</option>
                                    <option @selected(@$paymentSettings['paypal_mode'] === 'sandbox') value="sandbox">Sandbox
                                    </option>

                                </select>
                            </div>


                            <div class="col-md-7 mt-3">
                                <div class="form-label">Currency</div>
                                <select name="paypal_currency" class="js-example-basic form-control">
                                    <option value="">Select</option>
                                    @forelse (config('settings.currency_list') as $currency)
                                        <option @selected(@$paymentSettings['paypal_currency'] === $currency)
                                            value="{{ $currency }}">{{ $currency }}</option>
                                    @empty
                                        No Data Available
                                    @endforelse

                                </select>
                            </div>


                            <div class="col-md-7 mt-3">
                                <div class="form-label">Rate</div>
                                <input type="text" name="paypal_rate" class="form-control"
                                    value="{{ @$paymentSettings['paypal_rate'] }}">
                                <x-input-error :messages="$errors->get('paypal_rate')" class="mt-2 text-danger" />
                            </div>


                            <div class="col-md-7 mt-3">
                                <div class="form-label">Client ID</div>
                                <input type="text" name="paypal_client_id" class="form-control"
                                    value="{{ @$paymentSettings['paypal_client_id'] }}">
                                <x-input-error :messages="$errors->get('paypal_client_id')" class="mt-2 text-danger" />
                            </div>


                            <div class="col-md-7 mt-3">
                                <div class="form-label">Client Secret</div>
                                <input type="text" name="paypal_client_secret" class="form-control"
                                    value="{{ @$paymentSettings['paypal_client_secret'] }}">
                                <x-input-error :messages="$errors->get('paypal_client_secret')" class="mt-2 text-danger" />
                            </div>


                            <div class="col-md-7 mt-3">
                                <div class="form-label">App ID</div>
                                <input type="text" name="paypal_app_id" class="form-control"
                                    value="{{ @$paymentSettings['paypal_app_id'] }}">
                                <x-input-error :messages="$errors->get('paypal_app_id')" class="mt-2 text-danger" />
                            </div>







                            <div class="mt-4">
                                <button class="btn btn-primary">Update</button>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="tab-pane fade" id="tabs-profile-8" role="tabpanel">
                    <h4>Stripe Settings</h4>
                    <form action="{{ route('admin.payment-settings.update', 1) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')


                        <input type="hidden" name="payment_method" value="stripe">
                        <div class="col-md-7 mt-3">
                            <div class="form-label">Stripe Status</div>
                            <select name="stripe_status" class="form-control">
                                <option value="">Select</option>
                                <option @selected(@$paymentSettings['stripe_status'] === 'active') value="active">Active</option>
                                <option @selected(@$paymentSettings['stripe_status'] === 'inactive') value="inactive">Inactive
                                </option>

                            </select>
                        </div>





                        <div class="col-md-7 mt-3">
                            <div class="form-label">Currency</div>
                            <select name="stripe_currency" class="js-example-basic form-control">
                                <option value="">Select</option>
                                @forelse (config('settings.currency_list') as $currency)
                                    <option @selected(@$paymentSettings['stripe_currency'] === $currency) value="{{ $currency }}">
                                        {{ $currency }}</option>
                                @empty
                                    No Data Available
                                @endforelse

                            </select>
                        </div>


                        <div class="col-md-7 mt-3">
                            <div class="form-label">Rate</div>
                            <input type="text" name="stripe_rate" class="form-control"
                                value="{{ @$paymentSettings['stripe_rate'] }}">
                            <x-input-error :messages="$errors->get('stripe_rate')" class="mt-2 text-danger" />
                        </div>


                        <div class="col-md-7 mt-3">
                            <div class="form-label">Publish Key</div>
                            <input type="text" name="stripe_publish_key" class="form-control"
                                value="{{ @$paymentSettings['stripe_publish_key'] }}">
                            <x-input-error :messages="$errors->get('stripe_publish_key')" class="mt-2 text-danger" />
                        </div>


                        <div class="col-md-7 mt-3">
                            <div class="form-label">Client Secret</div>
                            <input type="text" name="stripe_client_secret" class="form-control"
                                value="{{ @$paymentSettings['stripe_client_secret'] }}">
                            <x-input-error :messages="$errors->get('stripe_client_secret')" class="mt-2 text-danger" />
                        </div>



                        <div class="mt-4">
                            <button class="btn btn-primary">Update</button>
                        </div>

                    </form>

                </div>
                <div class="tab-pane fade" id="tabs-activity-8" role="tabpanel">
                    <h4>SslCommerz Settings</h4>
                       <form action="{{ route('admin.payment-settings.update', 1) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')


                        <input type="hidden" name="payment_method" value="ssl">

                             <div class="col-md-7 mt-3">
                                <div class="form-label">Mode</div>
                                <select name="ssl_mode" class="form-control">
                                    <option value="">Select</option>
                                    <option @selected(@$paymentSettings['ssl_mode'] === 'live') value="live">Live</option>
                                    <option @selected(@$paymentSettings['ssl_mode'] === 'sandbox') value="sandbox">Sandbox
                                    </option>

                                </select>
                            </div>


                        <div class="col-md-7 mt-3">
                            <div class="form-label">SslCommerz Status</div>
                            <select name="ssl_status" class="form-control">
                                <option value="">Select</option>
                                <option @selected(@$paymentSettings['ssl_status'] === 'active') value="active">Active</option>
                                <option @selected(@$paymentSettings['ssl_status'] === 'inactive') value="inactive">Inactive
                                </option>

                            </select>
                        </div>





                        <div class="col-md-7 mt-3">
                            <div class="form-label">Currency</div>
                            <select name="ssl_currency" class="js-example-basic form-control">
                                <option value="">Select</option>
                                @forelse (config('settings.currency_list') as $currency)
                                    <option @selected(@$paymentSettings['ssl_currency'] === $currency) value="{{ $currency }}">
                                        {{ $currency }}</option>
                                @empty
                                    No Data Available
                                @endforelse

                            </select>
                        </div>


                     


                        <div class="col-md-7 mt-3">
                            <div class="form-label">Store ID</div>
                            <input type="text" name="ssl_store_id" class="form-control"
                                value="{{ @$paymentSettings['ssl_store_id'] }}">
                            <x-input-error :messages="$errors->get('ssl_store_id')" class="mt-2 text-danger" />
                        </div>


                        <div class="col-md-7 mt-3">
                            <div class="form-label">Store Password</div>
                            <input type="text" name="store_pass" class="form-control"
                                value="{{ @$paymentSettings['store_pass'] }}">
                            <x-input-error :messages="$errors->get('store_pass')" class="mt-2 text-danger" />
                        </div>



                        <div class="mt-4">
                            <button class="btn btn-primary">Update</button>
                        </div>

                    </form>
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
        document.addEventListener("DOMContentLoaded", function () {
            window.Litepicker && document.querySelectorAll('.datepicker').forEach(function (element) {
                new Litepicker({
                    element: element,
                    buttonText: {
                        previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                    },
                });
            });
        });

        $(document).ready(function () {
            $('.js-example-basic').select2();
        });

    </script>
@endpush