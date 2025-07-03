@php
    $cart_ad = json_decode(@$cart_ad->value);
@endphp
@if ($cart_ad[0]->status == 1)
<div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset($cart_ad[0]->banner_one) }}" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>{{ $cart_ad[0]->offer_one }}% off</span></h6>
                            <h3>{{ $cart_ad[0]->occassion_one }}</h3>
                            <a class="shop_btn" href="{{ $cart_ad[0]->banner_one_url }}">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset($cart_ad[1]->banner_two) }}" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>{{ $cart_ad[1]->offer_two }}</h6>
                            <h3>{{ $cart_ad[1]->occassion_two }}</h3>
                            <a class="shop_btn" href="{{ $cart_ad[1]->banner_two_url }}">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
@endif
