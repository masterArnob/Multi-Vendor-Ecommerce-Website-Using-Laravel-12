@php
    $home_page_banner_one = json_decode(@$home_page_banner_one->value);
@endphp

@if (@$home_page_banner_one[0]->status == 1)
    <div class="wsus__monthly_top_banner">
                    <div class="wsus__monthly_top_banner_img">
                        <img src="{{ asset(@$home_page_banner_one[0]->banner) }}" alt="img"
                            class="img-fluid w-100">
                        <span></span>
                    </div>
                    <div class="wsus__monthly_top_banner_text">
                        <h4>{{ @$home_page_banner_one[0]->occassion }} Sale</h4>
                        <h3>Up To <span>{{ @$home_page_banner_one[0]->offer }}% Off</span></h3>
                        <H6>Everything</H6>
                        <a class="shop_btn" href="{{ @$home_page_banner_one[0]->banner_url }}">shop now</a>
                    </div>
</div>  
@endif







