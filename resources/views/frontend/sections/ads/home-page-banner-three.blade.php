@php
    $home_page_banner_three = json_decode(@$home_page_banner_three->value);
@endphp

@if ($home_page_banner_three[0]->status == 1)
    <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="wsus__single_banner_content banner_1">
                            <div class="wsus__single_banner_img">
                                <img src="{{ asset(@$home_page_banner_three[0]->banner_one) }}" alt="banner"
                                    class="img-fluid w-100">
                            </div>
                            <div class="wsus__single_banner_text">
                                <h6>sell on <span>{{ @$home_page_banner_three[0]->offer_one }}% off</span></h6>
                                <h3>{{ @$home_page_banner_three[0]->occassion_one }}</h3>
                                <a class="shop_btn" href="{{ @$home_page_banner_three[0]->banner_one_url }}">shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="wsus__single_banner_content single_banner_2">
                                    <div class="wsus__single_banner_img">
                                        <img src="{{ asset(@$home_page_banner_three[1]->banner_two) }}"
                                            alt="banner" class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__single_banner_text">
                                        <h6>{{ @$home_page_banner_three[1]->offer_two }}</h6>
                                        <h3>{{ @$home_page_banner_three[1]->occassion_two }}</h3>
                                        <a class="shop_btn" href="{{ @$home_page_banner_three[1]->banner_two_url }}">shop now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-lg-4">
                                <div class="wsus__single_banner_content">
                                    <div class="wsus__single_banner_img">
                                        <img src="{{ asset(@$home_page_banner_three[2]->banner_three) }}"
                                            alt="banner" class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__single_banner_text">
                                        <h6>sell on <span>{{ @$home_page_banner_three[2]->offer_three }}% off</span></h6>
                                        <h3>{{ @$home_page_banner_three[2]->occassion_three }}</h3>
                                        <a class="shop_btn" href="{{ @$home_page_banner_three[2]->banner_three_url }}">shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endif