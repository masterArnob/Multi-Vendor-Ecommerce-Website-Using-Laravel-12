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
                    <div class="wsus__pro_page_bammer">
                        <img src="{{ asset('frontend/assets/images/pro_banner_1.jpg') }}" alt="banner"
                            class="img-fluid w-100">
                        <div class="wsus__pro_page_bammer_text">
                            <div class="wsus__pro_page_bammer_text_center">
                                <p>up to <span>70% off</span></p>
                                <h5>wemen's jeans Collection</h5>
                                <h3>fashion for wemen's</h3>
                                <a href="#" class="add_cart">Discover Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="wsus__sidebar_filter ">
                        <p>filter</p>
                        <span class="wsus__filter_icon">
                            <i class="far fa-minus" id="minus"></i>
                            <i class="far fa-plus" id="plus"></i>
                        </span>
                    </div>
                    <div class="wsus__product_sidebar" id="sticky_sidebar">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        All Categories
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><a href="#">Accessories</a></li>
                                            <li><a href="#">Babies</a></li>
                                            <li><a href="#">Babies</a></li>
                                            <li><a href="#">Beauty</a></li>
                                            <li><a href="#">Decoration</a></li>
                                            <li><a href="#">Electronics</a></li>
                                            <li><a href="#">Fashion</a></li>
                                            <li><a href="#">Food</a></li>
                                            <li><a href="#">Furniture</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Price
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="price_ranger">
                                            <input type="hidden" id="slider_range" class="flat-slider" />
                                            <button type="submit" class="common_btn">filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree2">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree2" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        size
                                    </button>
                                </h2>
                                <div id="collapseThree2" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree2" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                small
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                medium
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                                            <label class="form-check-label" for="flexCheckChecked2">
                                                large
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree3">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree3" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        brand
                                    </button>
                                </h2>
                                <div id="collapseThree3" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree3" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault11">
                                            <label class="form-check-label" for="flexCheckDefault11">
                                                gentle park
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked22">
                                            <label class="form-check-label" for="flexCheckChecked22">
                                                colors
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked222">
                                            <label class="form-check-label" for="flexCheckChecked222">
                                                yellow
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked33">
                                            <label class="form-check-label" for="flexCheckChecked33">
                                                enice man
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckChecked333">
                                            <label class="form-check-label" for="flexCheckChecked333">
                                                plus point
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        color
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefaultc1">
                                            <label class="form-check-label" for="flexCheckDefaultc1">
                                                black
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckCheckedc2">
                                            <label class="form-check-label" for="flexCheckCheckedc2">
                                                white
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckCheckedc3">
                                            <label class="form-check-label" for="flexCheckCheckedc3">
                                                green
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckCheckedc4">
                                            <label class="form-check-label" for="flexCheckCheckedc4">
                                                pink
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckCheckedc5">
                                            <label class="form-check-label" for="flexCheckCheckedc5">
                                                red
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="row">
                        <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                            <div class="wsus__product_topbar">
                                <div class="wsus__product_topbar_left">
                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            <i class="fas fa-th"></i>
                                        </button>
                                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile" type="button" role="tab"
                                            aria-controls="v-pills-profile" aria-selected="false">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                    </div>
                                    <div class="wsus__topbar_select">
                                        <select class="select_2" name="state">
                                            <option>default shorting</option>
                                            <option>short by rating</option>
                                            <option>short by latest</option>
                                            <option>low to high </option>
                                            <option>high to low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="wsus__topbar_select">
                                    <select class="select_2" name="state">
                                        <option>show 12</option>
                                        <option>show 15</option>
                                        <option>show 18</option>
                                        <option>show 21</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                   
                                    @forelse ($products as $item)
                                            <div class="col-xl-4  col-sm-6">
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
                                        " alt="product" class="img-fluid w-100 img_2" />
                                                    </a>

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
                                                                  <div>
    <h5 class="text-center mt-5">Product not found!</h5>
</div>
                                    @endforelse


                                </div>
                            </div>




                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
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
                                        " alt="product" class="img-fluid w-100 img_2" />
                                            </a>
                                            <div class="wsus__product_details">
                                                <a class="wsus__category" href="#">{{ $item->category->name }}  </a>
                                                <p class="wsus__pro_rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <span>(17 review)</span>
                                                </p>
                                                <a class="wsus__pro_name" href="{{ route('product-details.show', $item->id) }}">{{ $item->name }}</a>
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