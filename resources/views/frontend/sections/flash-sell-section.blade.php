    <section id="wsus__flash_sell" class="wsus__flash_sell_2">
        <div class=" container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="offer_time" style="background: url({{ asset('frontend/assets/images/flash_sell_bg.jpg') }})">
                        <div class="wsus__flash_coundown">
                            <span class=" end_text">flash sell</span>
                            <div class="simply-countdown simply-countdown-one"></div>
                            <a class="common_btn" href="{{ route('flash-sale.index') }}">see more <i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flash_sell_slider">
                @forelse ($flashSaleItemsSliders as $item)
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
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
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
                            <a class="wsus__pro_name" href="{{ route('product-details.show', $item->product->id) }}">{{ $item->product->name }}</a>
                            <p class="wsus__price">
                                @if ($item->product->offer_price > 0 && $item->product->offer_start_date <= now() && $item->product->offer_end_date >= now())
                                    {{ @$settings->currency_icon }} {{ $item->product->offer_price }} <del>{{ @$settings->currency_icon }} {{ $item->product->price }}</del>
                                @else 
                                    {{ @$settings->currency_icon }} {{ $item->product->price }}
                                @endif
                                
                            </p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                @empty
                    No Data Available
                @endforelse
              

            </div>
        </div>
    </section>

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