@extends('frontend.layout.master')
@section('content')
    <!--============================
                BREADCRUMB START
            ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>check out</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">check out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                BREADCRUMB END
            ==============================-->


    <!--============================
                CHECK OUT PAGE START
            ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <form class="wsus__checkout_form">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="wsus__check_form">
                            <h5>Billing Details <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">add
                                    new address</a></h5>

                            <div class="row">
                                @forelse ($addresses as $address)
                                    <div class="col-xl-6">
                                        <div class="wsus__checkout_single_address">
                                            <div class="form-check">
                                                <input class="form-check-input shipping_address_id" data-id="{{ $address->id }}" type="radio" name="flexRadioDefault"
                                                    id="{{ $address->id }}">
                                                <label class="form-check-label" for="{{ $address->id }}">
                                                    Select Address
                                                </label>
                                            </div>
                                            <ul>
                                                <li><span>Name :</span> {{ $address->name }}</li>
                                                <li><span>Contact :</span> {{ $address->phone }}</li>
                                                <li><span>Email :</span> {{ $address->email }}</li>
                                                <li><span>Country :</span> {{ $address->country }}</li>
                                                <li><span>City :</span> {{ $address->city }}</li>
                                                <li><span>Zip Code :</span> {{ $address->zip }}</li>
                                                <li><span>Address :</span> {!! $address->address !!}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @empty
                                    No Data Available
                                @endforelse


                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="wsus__order_details" id="sticky_sidebar">
                            <p class="wsus__product">shipping Methods</p>
                            @forelse ($rules as $rule)
                            @if ($rule->type === 'min_cost' &&  getSubTotal() >= $rule->min_cost)
                                <div class="form-check">
                                    <input class="form-check-input shipping_rule_id" type="radio" name="exampleRadios" id="{{ $rule->id }}"
                                        value="{{ $rule->id }}" data-id="{{ $rule->cost }}">
                                    <label class="form-check-label" for="{{ $rule->id }}">
                                        {{ $rule->name }}
                                        <span>Cost: (+{{ $settings->currency_icon }}{{ $rule->cost }})</span>
                                    </label>
                                </div>
                            @elseif($rule->type === 'flat_cost')
                                    <div class="form-check">
                                    <input class="form-check-input shipping_rule_id" type="radio" name="exampleRadios" id="{{ $rule->id }}"
                                        value="{{ $rule->id }}" data-id="{{ $rule->cost }}">
                                    <label class="form-check-label" for="{{ $rule->id }}">
                                        {{ $rule->name }}
                                        <span>Cost: (+{{ $settings->currency_icon }}{{ $rule->cost }})</span>
                                    </label>
                                </div>
                            @endif
                            
                            @empty
                                No Data Available
                            @endforelse


                            <div class="wsus__order_details_summery">
                                <p>subtotal: <span>{{ $settings->currency_icon }}{{ getSubTotal() }}</span></p>
                                <p>discount: <span
                                        class="text-danger">(-){{ $settings->currency_icon }}{{ discount() }}</span></p>
                                <p>shipping fee: <span class="shipping_fee">(+){{ $settings->currency_icon }}0</span></p>
                                <p><b>total:</b> <span class="total_cost" data-id="{{ mainCartTotal() }}"><b class="final_cost">{{ $settings->currency_icon }}{{ mainCartTotal() }}</b></span>
                                </p>
                            </div>
                           
                            <form action="">
                                <input type="hidden" id="shipping_rule_id" name="shipping_rule_id" value="">
                                <input type="hidden" id="shipping_address_id" name="shipping_address_id" value="">
                                <button class="common_btn" type="submit">Place Order</button>
                            </form>
                        
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('user.address.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="checkout" value="checkout">

                        <div class="modal-body p-0">
                            <div class="wsus__check_form p-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Name" name="name"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="email" placeholder="Email Address" name="email"
                                                value="{{ old('email') }}">

                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="tel" placeholder="Contact" name="phone"
                                                value="{{ old('phone') }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="">
                                            <select name="country" class="form-control">
                                                <option value="">Country</option>
                                                @forelse (config('settings.country_list') as $country)
                                                    <option value="{{ $country }}">{{ $country }}</option>
                                                @empty
                                                    No Data Available
                                                @endforelse
                                            </select>
                                            @error('country')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="State" name="state"
                                                value="{{ old('state') }}">
                                            @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="City" name="city"
                                                value="{{ old('city') }}">
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Zip" name="zip"
                                                value="{{ old('zip') }}">
                                            @error('zip')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <label for="">Address</label>
                                            <textarea name="address" class="form-control summernote">{{ old('address') }}</textarea>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>





                                    <div class="col-xl-12">
                                        <div class="wsus__check_single_form">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--============================
                CHECK OUT PAGE END
            ==============================-->
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
