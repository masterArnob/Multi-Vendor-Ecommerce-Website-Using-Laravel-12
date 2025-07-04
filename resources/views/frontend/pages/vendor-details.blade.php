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
                        <h4>products</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
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
                    PRODUCT PAGE START
                ==============================-->
    <section id="wsus__product_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_page_bammer vendor_det_banner">
                        <img src="{{ asset($vendor->banner) }}" alt="banner" class="img-fluid w-100">
                        <div class="wsus__pro_page_bammer_text wsus__vendor_det_banner_text">
                            <div class="wsus__vendor_text_center">
                                <h4>{{ $vendor->name }}</h4>
                            
                                <a href="callto:{{ $vendor->contact }}"><i class="far fa-phone-alt" aria-hidden="true"></i> {{ $vendor->contact }}</a>
                                <a href="mailto:{{ $vendor->email }}"><i class="far fa-envelope" aria-hidden="true"></i> {{ $vendor->email }}</a>
                                <p class="wsus__vendor_location"><i class="fal fa-map-marker-alt" aria-hidden="true"></i> {{ $vendor->address }}</p>
                              
                                <ul class="d-flex">
                                    @if (!empty($vendor->fb_link))
                                    <li><a class="facebook" href="{{ $vendor->fb_link }}"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>     
                                    @endif


                                       @if (!empty($vendor->tw_link))
                                  <li><a class="twitter" href="{{ $vendor->tw_link }}"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                    @endif


                                         @if (!empty($vendor->tiktok))
                                  <li><a class="tiktok" href="{{ $vendor->tiktok }}"><i class="fab fa-tiktok" aria-hidden="true"></i></a></li>
                                    @endif
                                   
                                  

                                            @if (!empty($vendor->insta_link))
                                  <li><a class="instagram" href="{{ $vendor->insta_link }}"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                    @endif

                                              @if (!empty($vendor->yt_link))
                                 <li><a class="instagram" href="{{ $vendor->yt_link }}"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                    @endif
                                  
                                  
                                  
                                </ul>
                              
                            </div>
                        </div>
                    </div>
                </div>
             
              
                <div class="col-xl-12 col-lg-8">
                    <div class="row">
                     
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">

                                    @forelse ($products as $item)
                                        <div class="col-xl-3  col-sm-6">
                                            <div class="wsus__product_item">
                                                <span class="wsus__new">
                                                    @if ($item->product_type === 'new_arrival')
                                                        New Arrival
                                                    @elseif($item->product_type === 'top_product')
                                                        Top
                                                    @elseif($item->product_type === 'featured_product')
                                                        Featured
                                                    @elseif($item->product_type === 'best_product')
                                                        Best
                                                    @endif
                                                </span>
                                                @if ($item->offer_price > 0 && $item->offer_start_date <= now() && $item->offer_end_date >= now())
                                                    <span class="wsus__minus">

                                                        @php
                                                            $discountAmount = $item->price - $item->offer_price;
                                                            $percent = ($discountAmount / $item->price) * 100;
                                                            $percent = round($percent);
                                                        @endphp
                                                        -{{ $percent }}%

                                                    </span>
                                                @endif
                                                <a class="wsus__pro_link"
                                                    href="{{ route('product-details.show', $item->id) }}">
                                                    <img src="{{ asset($item->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100 img_1" />
                                                    <img src="
                                        @if (isset($item->productGallery[0]->image)) {{ asset($item->productGallery[0]->image) }}
                                        @else
                                        {{ asset($item->thumb_image) }} @endif
                                        "
                                                        alt="product" class="img-fluid w-100 img_2" />
                                                </a>

                                                <div class="wsus__product_details">
                                                    <a class="wsus__category" href="#">{{ $item->category->name }}
                                                    </a>
                                                    <p class="wsus__pro_rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <span>(133 review)</span>
                                                    </p>

                         <ul class="wsus__single_pro_icon">
                             <li><a class="add_wishlist" data-id="{{ $item->id }}"><i class="fal fa-heart"></i></a></li>
                        </ul>

                                                    <a class="wsus__pro_name"
                                                        href="{{ route('product-details.show', $item->id) }}">{{ $item->name }}</a>
                                                    <p class="wsus__price">
                                                        @if ($item->offer_price > 0 && $item->offer_start_date <= now() && $item->offer_end_date >= now())
                                                            {{ @$settings->currency_icon }}{{ $item->offer_price }}
                                                            <del>{{ @$settings->currency_icon }}{{ $item->price }}</del>
                                                        @else
                                                            {{ @$settings->currency_icon }}{{ $item->price }}
                                                        @endif

                                                    </p>
                                                    <form class="shopping_cart_form">
                                                        @forelse ($item->variants as $variant)
                                                            @if ($variant->status === 1)
                                                                <div class="wsus_pro_det_color" hidden>
                                                                    <h5>{{ $variant->name }} :</h5>
                                                                    <ul>
                                                                        <select name="variants_items[]"
                                                                            class="form-control" hidden>
                                                                            @forelse ($variant->variantItem as $variantItem)
                                                                                @if ($variantItem->status === 1)
                                                                                    <option @selected($variantItem->is_default === 1)
                                                                                        value="{{ $variantItem->id }}">
                                                                                        {{ $variantItem->name }}
                                                                                        (+${{ $variantItem->price }})
                                                                                    </option>
                                                                                @endif

                                                                            @empty
                                                                            @endforelse

                                                                        </select>
                                                                    </ul>
                                                            @endif
                                                </div>
                                            @empty
                                    @endforelse

                                    <input type="text" name="product_id" value="{{ $item->id }}" hidden>
                                    <input type="hidden" name="qty" value="1">
                                    <button class="add_cart" type="submit">Add to Cart</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div>
                            <h5 class="text-center mt-5">Product not found!</h5>
                        </div>
                        @endforelse


                    </div>
                </div>




                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="row">

                        @forelse ($products as $item)
                            <div class="col-xl-12">
                                <div class="wsus__product_item wsus__list_view">
                                    <span class="wsus__new">
                                        @if ($item->product_type === 'new_arrival')
                                            New Arrival
                                        @elseif($item->product_type === 'top_product')
                                            Top
                                        @elseif($item->product_type === 'featured_product')
                                            Featured
                                        @elseif($item->product_type === 'best_product')
                                            Best
                                        @endif
                                    </span>

                                    @if ($item->offer_price > 0 && $item->offer_start_date <= now() && $item->offer_end_date >= now())
                                        <span class="wsus__minus">

                                            @php
                                                $discountAmount = $item->price - $item->offer_price;
                                                $percent = ($discountAmount / $item->price) * 100;
                                                $percent = round($percent);
                                            @endphp
                                            -{{ $percent }}%

                                        </span>
                                    @endif

                                    <a class="wsus__pro_link" href="{{ route('product-details.show', $item->id) }}">
                                        <img src="{{ asset($item->thumb_image) }}" alt="product"
                                            class="img-fluid w-100 img_1" />
                                        <img src="
                                        @if (isset($item->productGallery[0]->image)) {{ asset($item->productGallery[0]->image) }}
                                        @else
                                        {{ asset($item->thumb_image) }} @endif
                                        "
                                            alt="product" class="img-fluid w-100 img_2" />
                                    </a>
                                    <div class="wsus__product_details">
                                        <a class="wsus__category" href="#">{{ $item->category->name }} </a>
                                        <p class="wsus__pro_rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <span>(17 review)</span>
                                        </p>
                                        <a class="wsus__pro_name"
                                            href="{{ route('product-details.show', $item->id) }}">{{ $item->name }}</a>
                                        <p class="wsus__price">
                                            @if ($item->offer_price > 0 && $item->offer_start_date <= now() && $item->offer_end_date >= now())
                                                {{ @$settings->currency_icon }}{{ $item->offer_price }}
                                                <del>{{ @$settings->currency_icon }}{{ $item->price }}</del>
                                            @else
                                                {{ @$settings->currency_icon }}{{ $item->price }}
                                            @endif
                                        </p>
                                        <p class="list_description">{{ $item->short_description }}</p>
                                        <ul class="wsus__single_pro_icon">
                                            <li>
                                                <form class="shopping_cart_form">
                                                    @forelse ($item->variants as $variant)
                                                        @if ($variant->status === 1)
                                                            <div class="wsus_pro_det_color" hidden>
                                                                <h5>{{ $variant->name }} :</h5>
                                                                <ul>
                                                                    <select name="variants_items[]" class="form-control"
                                                                        hidden>
                                                                        @forelse ($variant->variantItem as $variantItem)
                                                                            @if ($variantItem->status === 1)
                                                                                <option @selected($variantItem->is_default === 1)
                                                                                    value="{{ $variantItem->id }}">
                                                                                    {{ $variantItem->name }}
                                                                                    (+${{ $variantItem->price }})
                                                                                </option>
                                                                            @endif

                                                                        @empty
                                                                        @endforelse

                                                                    </select>
                                                                </ul>
                                                        @endif
                                    </div>
                                @empty
                        @endforelse

                        <input type="text" name="product_id" value="{{ $item->id }}" hidden>
                        <input type="hidden" name="qty" value="1">
                        <button class="add_cart mx-2" type="submit">Add to Cart</button>
                        </form>
                        </li>
                        <li><a href="#"><i class="far fa-heart"></i></a></li>
                        <li><a href="#"><i class="far fa-random"></i></a>
                            </ul>
                    </div>
                </div>
            </div>
        @empty
            <div>
                <h5 class="text-center mt-5">Product not found!</h5>
            </div>
            @endforelse

        </div>
        </div>
        </div>
        </div>
        </div>






        <div class="col-xl-12">
            @if ($products->hasPages())
                {{ $products->withQueryString()->links() }}
            @endif
        </div>
        </div>
        </div>
    </section>
    <!--============================
                    PRODUCT PAGE END
                ==============================-->
@endsection
@push('scripts')
    <script>
            //*==========PRICE SLIDER========= 
            @php
              $range = explode(';', request()->range);
                if(count($range) == 2){
                $min = $range[0];
                $max = $range[1];
                }else{
                    $min = 0;
                    $max = 8000;
                }
            @endphp
    jQuery(function () {
        jQuery("#slider_range").flatslider({
            min: 0, max: 10000,
            step: 100,
            values: [{{ $min }}, {{ $max }}],
            range: true,
            einheit: '{{ @$settings->currency_icon }}'
        });
    });
    </script>
@endpush