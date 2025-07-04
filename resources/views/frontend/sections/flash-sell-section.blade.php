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
                             <li><a class="add_wishlist" data-id="{{ $item->product->id }}"><i class="fal fa-heart"></i></a></li>
                        </ul>

                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">{{ $item->product->category->name }} </a>
                           
                            <p class="wsus__pro_rating">
                                     @php
                                            $review = $item->product->reviews->where('status', 1)->count();
                                            $rating = $item->product->reviews->where('status', 1)->sum('rating');
                                            $averageRating = $review > 0 ? round($rating / $review, 1) : 0;
                                            $averageRating = number_format($averageRating, 1);
                                            $rate = round($averageRating);
                                        @endphp

                                        @if ($rate == 0)
                                            No rating
                                        @elseif($rate == 1)
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        @elseif($rate == 2)
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        @elseif($rate == 3)
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        @elseif($rate == 4)
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        @elseif($rate == 5)
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        @endif

                                        <span>({{ $review }} review)</span>
                                    
                                </p>
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