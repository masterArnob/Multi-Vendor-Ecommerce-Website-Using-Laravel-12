@php
    $home_page_banner_two = json_decode(@$home_page_banner_two->value);
@endphp

<div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset(@$home_page_banner_two[0]->banner_one) }}" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>{{ @$home_page_banner_two[0]->offer_one }}% off</span></h6>
                            <h3>{{ $home_page_banner_two[0]->occassion_one }}</h3>
                            <a class="shop_btn" href="{{ @$home_page_banner_two[0]->banner_one_url }}">shop now</a>
                        </div>
                    </div>
                </div>


                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset(@$home_page_banner_two[1]->banner_two) }}" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>{{ @$home_page_banner_two[1]->offer_two }}</h6>
                            <h3>{{ @$home_page_banner_two[1]->occassion_two }}</h3>
                            <a class="shop_btn" href="{{ @$home_page_banner_two[1]->banner_two_url }}">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
</div>