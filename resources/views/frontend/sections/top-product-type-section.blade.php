    <section id="wsus__hot_deals" class="wsus__hot_deals_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header">
                        <h3>top product types</h3>
                    </div>
                </div>
            </div>

            <div class="wsus__hot_large_item">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header justify-content-start">
                            <div class="monthly_top_filter2 mb-1">

                                <button class="active auto_click" data-filter=".new_arrival">New Arrival</button>
                                <button data-filter=".featured_product">Featured</button>
                                <button data-filter=".top_product">Top Product</button>
                                <button data-filter=".best_product">Best Product</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row grid2">
                    @forelse ($typeBasedProduct as $key => $product)
                        @forelse ($product as $item)
                            <div class="col-xl-3 col-sm-6 col-lg-4 {{ $key }}">
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
                                        <a class="wsus__category" href="#">{{ $item->category->name }}
                                        </a>
                                            <p class="wsus__pro_rating">
                                     @php
                                            $review = $item->reviews->where('status', 1)->count();
                                          
                                            $rating = $item->reviews->where('status', 1)->sum('rating');
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
                                      

                                        
                       <ul class="wsus__single_pro_icon">
                             <li><a class="add_wishlist" data-id="{{ $item->id }}"><i class="fal fa-heart"></i></a></li>
                        </ul>

                                        <a class="wsus__pro_name"
                                            href="{{ route('product-details.show', $item->id) }}">{{ $item->name }}</a>
                                        <p class="wsus__price">
                                            @if ($item->offer_price > 0 && $item->offer_start_date <= now() && $item->offer_end_date >= now())
                                                {{ @$settings->currency_icon }} {{ $item->offer_price }}
                                                <del>{{ @$settings->currency_icon }} {{ $item->price }}</del>
                                            @else
                                                {{ @$settings->currency_icon }} {{ $item->price }}
                                            @endif

                                        </p>
                                        <form class="shopping_cart_form">
                                            @forelse ($item->variants as $variant)
                                                @if ($variant->status === 1)
                                                    <div class="wsus_pro_det_color" hidden>
                                                        <h5>{{ $variant->name }} :</h5>
                                                        <ul>
                                                            <select name="variants_items[]" class="form-control" hidden>
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
        @endforelse
    @empty
        No Data Available
        @endforelse


        </div>
        </div>

        @if (!empty($home_page_banner_three))
        <section id="wsus__single_banner" class="home_2_single_banner">
            @include('frontend.sections.ads.home-page-banner-three')
        </section>
        @endif


       
        </div>
    </section>
