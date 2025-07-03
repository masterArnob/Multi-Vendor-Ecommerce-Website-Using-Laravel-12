@php
    $product_list_ad = json_decode(@$product_list_ad->value);
@endphp
@if ($product_list_ad[0]->status == 1)
       <div class="col-xl-12">
                    <div class="wsus__pro_page_bammer">
                        <img src="{{ asset(@$product_list_ad[0]->banner_one) }}" alt="banner"
                            class="img-fluid w-100">
                        <div class="wsus__pro_page_bammer_text">
                            <div class="wsus__pro_page_bammer_text_center">
                                <p>up to <span>{{ @$product_list_ad[0]->offer_one }}% off</span></p>
                                <h5>{{ @$product_list_ad[0]->offer_one_name }}</h5>
                                <h3>{{ @$product_list_ad[0]->offer_one_name }}</h3>
                                <a href="{{ @$product_list_ad[0]->banner_one_url }}" class="add_cart">Discover Now</a>
                            </div>
                        </div>
                    </div>
                </div>
@endif