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
                        <h4>Flash Sale</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="#">Flash Sale</a></li>
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
        DAILY DEALS DETAILS START
    ==============================-->
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/assets/images/offer_banner_2.png') }}" alt="offrt img" class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>apple watch</p>
                                <span>up 50% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/assets/images/offer_banner_3.png') }}" alt="offrt img" class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>xiaomi power bank</p>
                                <span>up 37% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header rounded-0">
                            <h3>flash sell</h3>
                            <div class="wsus__offer_countdown">
                                <span class="end_text">ends time :</span>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @forelse ($flashSaleItems as $item)
                 <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">
                            @if ($item->product->product_type === 'new_arriaval')
                                New Arrival
                            @elseif($item->product->product_type === 'top_product')
                            Top 
                            @elseif($item->product->product_type === 'featured_product')
                            Featured
                            @elseif($item->product->product_type === 'best_product')
                                Best
                            @endif
                        </span>
                           @if ($item->product->offer_price > 0 && $item->product->offer_start_date <= now() && $item->product->offer_end_date >= now())
                        <span class="wsus__minus">
                             
                                @php
                                    $discountAmount = $item->product->price - $item->product->offer_price;
                                    $percent = ($discountAmount / $item->product->price) * 100;
                                    $percent = round($percent);
                                @endphp
                                -{{ $percent }}%
                         
                        </span>
                               @endif
                        <a class="wsus__pro_link" href="{{ route('product-details.show', $item->product->id) }}">
                            <img src="{{ asset($item->product->thumb_image) }}" alt="product" class="img-fluid w-100 img_1" />
                            <img src="
                            @if (isset($item->product->productGallery[0]->image))
                            {{ asset($item->product->productGallery[0]->image) }}
                            @else
                            {{ asset($item->product->thumb_image) }}
                            @endif
                            " alt="product" class="img-fluid w-100 img_2" />
                        </a>
                
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">{{ $item->product->category->name }} </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(133 review)</span>
                            </p>

                            <ul class="wsus__single_pro_icon">
                             <li><a class="add_wishlist" data-id="{{ $item->product->id }}"><i class="fal fa-heart"></i></a></li>
                        </ul>

                        
                            <a class="wsus__pro_name" href="{{ route('product-details.show', $item->product->id) }}">{{ $item->product->name }}</a>
                            <p class="wsus__price">
                                @if ($item->product->offer_price > 0 && $item->product->offer_start_date <= now() && $item->product->offer_end_date >= now())
                                    {{ @$settings->currency_icon }} {{ $item->product->offer_price }} <del>{{ @$settings->currency_icon }} {{ $item->product->price }}</del>
                                @else
                                    {{ @$settings->currency_icon }} {{ $item->product->price }}
                                @endif
                                
                            </p>
                                        <form class="shopping_cart_form">
                            @forelse ($item->product->variants as $variant)
                               @if ($variant->status === 1)
                                    <div class="wsus_pro_det_color" hidden>
                                <h5>{{ $variant->name }} :</h5>
                                <ul>
                                  <select name="variants_items[]" class="form-control" hidden>
                                    @forelse ($variant->variantItem as $variantItem)
                                    @if ($variantItem->status === 1)
                                         <option @selected($variantItem->is_default === 1) value="{{ $variantItem->id }}">{{ $variantItem->name }} (+${{ $variantItem->price }})</option>                                        
                                    @endif
                                       
                                    @empty
                                       
                                    @endforelse
                                   
                                  </select>
                                </ul>
                               @endif
                            </div>
                            @empty
                           
                            @endforelse

                                <input type="text" name="product_id" value="{{ $item->product_id }}" hidden>
                                <input type="hidden" name="qty" value="1">
                                <button class="add_cart" type="submit">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                    No Data Available
                @endforelse
                </div>
                @if ($flashSaleItems->hasPages())
                      {{ $flashSaleItems->links() }}
                @endif
              
            </div>
        </div>
    </section>
    <!--============================
        DAILY DEALS DETAILS END
    ==============================-->
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        simplyCountdown('.simply-countdown-one', {
            year: {{date('Y', strtotime($flashSaleDate->end_date))}},
            month: {{date('m', strtotime($flashSaleDate->end_date))}},
            day: {{date('d', strtotime($flashSaleDate->end_date))}},
        });
    })

</script>


@endpush