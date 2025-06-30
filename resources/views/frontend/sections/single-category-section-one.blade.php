@php
    $singleCatOne = json_decode($singleCatOne->value);

    // Determine the deepest non-null category and its source
    $categoryDisplay = $singleCatOne[0]->category;
    $categorySource = 'category'; // Default source
    $cat = App\Models\Category::find($singleCatOne[0]->category);
    $products = App\Models\Product::where(['category_id' => $cat->id])->get();

    if (!is_null($singleCatOne[0]->sub_category)) {
        $categoryDisplay = $singleCatOne[0]->sub_category;
        $categorySource = 'sub_category';
        $cat = App\Models\SubCategory::find($singleCatOne[0]->sub_category);
        $products = App\Models\Product::where(['sub_category_id' => $cat->id])->get();
    }
    if (!is_null($singleCatOne[0]->child_category)) {
        $categoryDisplay = $singleCatOne[0]->child_category;
        $categorySource = 'child_category';
        $cat = App\Models\ChildCategory::find($singleCatOne[0]->child_category);
        $products = App\Models\Product::where(['child_category_id' => $cat->id])->get();
    }
    // @dd($products);
@endphp

<section id="wsus__electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{ $cat->name }}</h3>
                    <a class="see_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @forelse ($products as $item)
                <div class="col-xl-3 col-sm-6 col-lg-4">
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
                            <img src="{{ asset($item->thumb_image) }}" alt="product" class="img-fluid w-100 img_1" />
                            <img src="
                            @if (isset($item->productGallery[0]->image)) {{ asset($item->productGallery[0]->image) }}
                            @else
                            {{ asset($item->thumb_image) }} @endif
                            "
                                alt="product" class="img-fluid w-100 img_2" />
                        </a>

                        <ul class="wsus__single_pro_icon">
                             <li><a class="add_wishlist" data-id="{{ $item->id }}"><i class="fal fa-heart"></i></a></li>
                        </ul>

                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">{{ $item->category->name }} </a>
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
                                                                {{ $variantItem->name }} (+${{ $variantItem->price }})
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
    No Data Available
    @endforelse
    </div>
    </div>
</section>

