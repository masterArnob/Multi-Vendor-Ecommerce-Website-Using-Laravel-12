@php
    $product_ad_one = json_decode(@$product_ad_one->value);
@endphp
@if ($product_ad_one[0]->status == 1)
 <div class="wsus__det_sidebar_banner">
                            <img src="{{ $product_ad_one[0]->banner_one }}" alt="banner" class="img-fluid w-100">
                            <div class="wsus__det_sidebar_banner_text_overlay">
                                <div class="wsus__det_sidebar_banner_text">
                                    <p>{{ $product_ad_one[0]->offer_one_name }} Sale</p>
                                    <h4>Up To {{ $product_ad_one[0]->offer_one }}% Off</h4>
                                    <a href="{{ $product_ad_one[0]->banner_one_url }}" class="common_btn">shop now</a>
                                </div>
                            </div>
                        </div>
    
@endif