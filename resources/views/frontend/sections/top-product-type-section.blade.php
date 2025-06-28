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
                                    @if (
                                        $item->offer_price > 0 &&
                                            $item->offer_start_date <= now() &&
                                            $item->offer_end_date >= now())
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
                                        <a class="wsus__pro_name"
                                            href="{{ route('product-details.show', $item->id) }}">{{ $item->name }}</a>
                                        <p class="wsus__price">
                                            @if (
                                                $item->offer_price > 0 &&
                                                    $item->offer_start_date <= now() &&
                                                    $item->offer_end_date >= now())
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
                                                                            (+${{ $variantItem->price }})</option>
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

        <section id="wsus__single_banner" class="home_2_single_banner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="wsus__single_banner_content banner_1">
                            <div class="wsus__single_banner_img">
                                <img src="{{ asset('frontend/assets/images/single_banner_44.jpg') }}" alt="banner"
                                    class="img-fluid w-100">
                            </div>
                            <div class="wsus__single_banner_text">
                                <h6>sell on <span>35% off</span></h6>
                                <h3>smart watch</h3>
                                <a class="shop_btn" href="#">shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="wsus__single_banner_content single_banner_2">
                                    <div class="wsus__single_banner_img">
                                        <img src="{{ asset('frontend/assets/images/single_banner_55.jpg') }}"
                                            alt="banner" class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__single_banner_text">
                                        <h6>New Collection</h6>
                                        <h3>kid's fashion</h3>
                                        <a class="shop_btn" href="#">shop now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-lg-4">
                                <div class="wsus__single_banner_content">
                                    <div class="wsus__single_banner_img">
                                        <img src="{{ asset('frontend/assets/images/single_banner_66.jpg') }}"
                                            alt="banner" class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__single_banner_text">
                                        <h6>sell on <span>42% off</span></h6>
                                        <h3>winter collection</h3>
                                        <a class="shop_btn" href="#">shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="wsus__hot_small_item wsus__hot_small_item_2">
            <div class="row">
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3">
                    <a class="wsus__hot_deals__single" href="#">
                        <div class="wsus__hot_deals__single_img">
                            <img src="images/pro4_4.jpg" alt="bag" class="img-fluid w-100">
                        </div>
                        <div class="wsus__hot_deals__single_text">
                            <h5>men's casual watch</h5>
                            <p class="wsus__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                            <p class="wsus__tk">$120.20 <del>130.00</del></p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3">
                    <a class="wsus__hot_deals__single" href="#">
                        <div class="wsus__hot_deals__single_img">
                            <img src="images/pro9.jpg" alt="bag" class="img-fluid w-100">
                        </div>
                        <div class="wsus__hot_deals__single_text">
                            <h5>men's sholder bag</h5>
                            <p class="wsus__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                            <p class="wsus__tk">$120.20 <del>130.00</del></p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3">
                    <a class="wsus__hot_deals__single" href="#">
                        <div class="wsus__hot_deals__single_img">
                            <img src="images/pro9_9.jpg" alt="bag" class="img-fluid w-100">
                        </div>
                        <div class="wsus__hot_deals__single_text">
                            <h5>men's sholder bag</h5>
                            <p class="wsus__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                            <p class="wsus__tk">$120.20 <del>130.00</del></p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3">
                    <a class="wsus__hot_deals__single" href="#">
                        <div class="wsus__hot_deals__single_img">
                            <img src="images/pro10.jpg" alt="bag" class="img-fluid w-100">
                        </div>
                        <div class="wsus__hot_deals__single_text">
                            <h5>MSI gaming chair</h5>
                            <p class="wsus__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                            <p class="wsus__tk">$120.20 <del>130.00</del></p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3">
                    <a class="wsus__hot_deals__single" href="#">
                        <div class="wsus__hot_deals__single_img">
                            <img src="images/pro2.jpg" alt="bag" class="img-fluid w-100">
                        </div>
                        <div class="wsus__hot_deals__single_text">
                            <h5>men's shoes</h5>
                            <p class="wsus__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                            <p class="wsus__tk">$120.20 <del>130.00</del></p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3">
                    <a class="wsus__hot_deals__single" href="#">
                        <div class="wsus__hot_deals__single_img">
                            <img src="images/pro2.jpg" alt="bag" class="img-fluid w-100">
                        </div>
                        <div class="wsus__hot_deals__single_text">
                            <h5>men's shoes</h5>
                            <p class="wsus__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                            <p class="wsus__tk">$120.20 <del>130.00</del></p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3">
                    <a class="wsus__hot_deals__single" href="#">
                        <div class="wsus__hot_deals__single_img">
                            <img src="images/pro2.jpg" alt="bag" class="img-fluid w-100">
                        </div>
                        <div class="wsus__hot_deals__single_text">
                            <h5>men's shoes</h5>
                            <p class="wsus__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                            <p class="wsus__tk">$120.20 <del>130.00</del></p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3">
                    <a class="wsus__hot_deals__single" href="#">
                        <div class="wsus__hot_deals__single_img">
                            <img src="images/pro2.jpg" alt="bag" class="img-fluid w-100">
                        </div>
                        <div class="wsus__hot_deals__single_text">
                            <h5>men's shoes</h5>
                            <p class="wsus__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                            <p class="wsus__tk">$120.20 <del>130.00</del></p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3">
                    <a class="wsus__hot_deals__single" href="#">
                        <div class="wsus__hot_deals__single_img">
                            <img src="images/pro10.jpg" alt="bag" class="img-fluid w-100">
                        </div>
                        <div class="wsus__hot_deals__single_text">
                            <h5>MSI gaming chair</h5>
                            <p class="wsus__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                            <p class="wsus__tk">$120.20 <del>130.00</del></p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3">
                    <a class="wsus__hot_deals__single" href="#">
                        <div class="wsus__hot_deals__single_img">
                            <img src="images/pro9_9.jpg" alt="bag" class="img-fluid w-100">
                        </div>
                        <div class="wsus__hot_deals__single_text">
                            <h5>men's sholder bag</h5>
                            <p class="wsus__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                            <p class="wsus__tk">$120.20 <del>130.00</del></p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3">
                    <a class="wsus__hot_deals__single" href="#">
                        <div class="wsus__hot_deals__single_img">
                            <img src="images/pro9.jpg" alt="bag" class="img-fluid w-100">
                        </div>
                        <div class="wsus__hot_deals__single_text">
                            <h5>men's sholder bag</h5>
                            <p class="wsus__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                            <p class="wsus__tk">$120.20 <del>130.00</del></p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3">
                    <a class="wsus__hot_deals__single" href="#">
                        <div class="wsus__hot_deals__single_img">
                            <img src="images/pro4_4.jpg" alt="bag" class="img-fluid w-100">
                        </div>
                        <div class="wsus__hot_deals__single_text">
                            <h5>men's casual watch</h5>
                            <p class="wsus__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                            <p class="wsus__tk">$120.20 <del>130.00</del></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </section>
