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
                        <h4>payment</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">payment</a></li>
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
                PAYMENT PAGE START
            ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row">

                    <div class="col-xl-8 col-lg-8 d-flex justify-content-start">


                        <div class="col-xl-3 col-lg-3">
                            <a href="{{ route('user.payment.pypal') }}">
                                <img src="{{ asset('frontend/assets/images/payment-gateway/paypal.webp') }}" width="100%">
                            </a>
                        </div>


                        @if (@$paymentSettings['stripe_status'] === 'active')
                            <div class="col-xl-3 col-lg-3 ">
                                <a href="{{ route('user.payment.stripe') }}">
                                    <img src="{{ asset('frontend/assets/images/payment-gateway/stripe.png') }}"
                                        width="100%">
                                </a>
                            </div>
                        @endif

                        @if (@$paymentSettings['ssl_status'] === 'active')
                            <div class="col-xl-3 col-lg-3 mx-2">
                                <form action="{{ route('user.payment.ssl') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-transparent border-0">
                                        <img src="{{ asset('frontend/assets/images/payment-gateway/ssl.png') }}"
                                            width="100%">
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="col-xl-4 col-lg-4">
                        <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                            <h5>Order Summary</h5>
                            <p>subtotal: <span>{{ $settings->currency_icon }}{{ getSubTotal() }}</span></p>
                            <p>discount: <span
                                    class="text-danger">(-){{ $settings->currency_icon }}{{ discount() }}</span></p>
                            <p>shipping fee: <span
                                    class="text-success">(+){{ $settings->currency_icon }}{{ shippingFee() }} </span></p>
                            <h6>total <span>{{ $settings->currency_icon }} {{ finalCost() }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                PAYMENT PAGE END
            ==============================-->
@endsection
