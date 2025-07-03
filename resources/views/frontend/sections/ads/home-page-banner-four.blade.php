@php
    $home_page_banner_four = json_decode(@$home_page_banner_four->value);
@endphp
<div class="container">
            <div class="row">
                <div class="cl-xl-12">
                    <div class="wsus__large_banner_content" style="background: url({{ asset(@$home_page_banner_four[0]->banner_one) }});">
                        <div class="wsus__large_banner_content_overlay">
                            <div class="row">
                                <div class="col-xl-6 col-12 col-md-6">
                                    <div class="wsus__large_banner_text">
                                        <h3>This Week's {{ @$home_page_banner_four[0]->offer_one_name }}</h3>
                                     
                                     
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-md-6">
                                    <div class="wsus__large_banner_text wsus__large_banner_text_right">
                                        <h3>{{ @$home_page_banner_four[0]->occassion_one }}</h3>
                                        <h5>up to {{ @$home_page_banner_four[0]->offer_one }}% off</h5>
                                        <p>collection has discounted now!</p>
                                        <a class="shop_btn" href="{{ @$home_page_banner_four[0]->banner_one_url }}">shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>