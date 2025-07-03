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
                            <h4>products details</h4>
                            <ul>
                                <li><a href="{{ route('home') }}">home</a></li>
                                <li><a href="#">product details</a></li>
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
                        PRODUCT DETAILS START
                    ==============================-->
        <section id="wsus__product_details">
            <div class="container">
                <div class="wsus__details_bg">
                    <div class="row">
                        <div class="col-xl-4 col-md-5 col-lg-5" style="z-index: 999 !important;">
                            <div id="sticky_pro_zoom">
                                <div class="exzoom hidden" id="exzoom">
                                    <div class="exzoom_img_box">
                                        <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                            href="{{ $product->video_link }}">
                                            <i class="fas fa-play"></i>
                                        </a>
                                        <ul class='exzoom_img_ul'>
                                            <li><img class="zoom ing-fluid w-100" src="{{ asset($product->thumb_image) }}"
                                                    alt="product"></li>
                                            @forelse ($product->productGallery as $image)
                                                <li><img class="zoom ing-fluid w-100" src="{{ asset($image->image) }}"
                                                        alt="product"></li>
                                            @empty
                                            @endforelse

                                        </ul>
                                    </div>
                                    <div class="exzoom_nav"></div>
                                    <p class="exzoom_btn">
                                        <a href="javascript:void(0);" class="exzoom_prev_btn"> <i
                                                class="far fa-chevron-left"></i> </a>
                                        <a href="javascript:void(0);" class="exzoom_next_btn"> <i
                                                class="far fa-chevron-right"></i> </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-md-7 col-lg-7">
                            <div class="wsus__pro_details_text">
                                <a class="title" href="#">{{ $product->name }}</a>
                                <p class="wsus__stock_area"><span
                                        class="{{ $product->qty > 0 ? 'in_stock' : 'badge bg-danger' }} ">{{ $product->qty > 0 ? 'in stock' : 'stock out' }}</span>
                                    ({{ $product->qty }} item)</p>
                                @if ($product->offer_price > 0 && $product->offer_start_date <= now() && $product->offer_end_date >= now())
                                    <h4>{{ @$settings->currency_icon }} {{ $product->offer_price }} <del>
                                            {{ @$settings->currency_icon }} {{ $product->price }}</del></h4>
                                @else
                                    <h4>{{ @$settings->currency_icon }} {{ $product->price }}</h4>
                                @endif

                                <p class="review">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>20 review</span>
                                </p>
                                <!-- <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia
                                                neque
                                                sint obcaecati asperiores dolor cumque. ad voluptate dolores reprehenderit hic adipisci
                                                Similique eaque illum.</p> -->

                                <div class="wsus_pro_hot_deals">
                                    <h5>offer ending time : </h5>
                                    <div class="simply-countdown simply-countdown-one"></div>
                                </div>

                                {{ $product->short_description }}


                                <form class="shopping_cart_form">
                                    @forelse ($product->variants as $variant)
                                        @if ($variant->status === 1)
                                            <div class="wsus_pro_det_color">
                                                <h5>{{ $variant->name }} :</h5>
                                                <ul>
                                                    <select name="variants_items[]" class="form-control">
                                                        @forelse ($variant->variantItem as $item)
                                                            @if ($item->status === 1)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                    (+{{ @$settings->currency_icon }}{{ $item->price }})
                                                                </option>
                                                            @endif

                                                        @empty
                                                            No Item
                                                        @endforelse

                                                    </select>
                                                </ul>
                                        @endif
                            </div>
                        @empty
                            No Variant
                            @endforelse

                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="wsus__quentity">
                                <h5>quentity :</h5>
                                <div class="select_number">
                                    <input class="number_area" name="qty" type="text" min="1" max="100"
                                        value="1" />
                                </div>

                            </div>

                            <ul class="wsus__button_area">
                                <li>
                                    <button class="add_cart" type="submit">Add to cart</button>


                                <li><a class="add_wishlist" data-id="{{ $product->id }}"><i class="fal fa-heart"></i></a></li>

                            </ul>
                            </form>


                            <p class="brand_model"><span>brand :</span> {{ $product->brand->name }}</p>

                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 mt-md-5 mt-lg-0">
                        <div class="wsus_pro_det_sidebar" id="sticky_sidebar">
                            <ul>
                                <li>
                                    <span><i class="fal fa-truck"></i></span>
                                    <div class="text">
                                        <h4>Return Available</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                                <li>
                                    <span><i class="far fa-shield-check"></i></span>
                                    <div class="text">
                                        <h4>Secure Payment</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                                <li>
                                    <span><i class="fal fa-envelope-open-dollar"></i></span>
                                    <div class="text">
                                        <h4>Warranty Available</h4>
                                        <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                    </div>
                                </li>
                            </ul>


                            @if (!empty($product_ad_one))
                           @include('frontend.sections.ads.product-ad-one')     
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_det_description">
                        <div class="wsus__details_bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                        data-bs-target="#pills-home22" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Description</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Vendor Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact2" type="button" role="tab"
                                        aria-controls="pills-contact2" aria-selected="false">Reviews</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="pills-tabContent4">
                                <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                    aria-labelledby="pills-home-tab7">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__description_area">
                                                <h1>{{ $product->name }}</h1>
                                                <p>{!! $product->long_description !!}</p>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-4 col-md-4">
                                                <div class="description_single">
                                                    <h6><span>1</span> Free Shipping & Return</h6>
                                                    <p>We offer free shipping for products on orders above 50$ and
                                                        offer
                                                        free delivery for all orders in US.</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4">
                                                <div class="description_single">
                                                    <h6><span>2</span> Free and Easy Returns</h6>
                                                    <p>We guarantee our products and you could get back all of your
                                                        money anytime you want in 30 days.</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4">
                                                <div class="description_single">
                                                    <h6><span>3</span> Special Financing </h6>
                                                    <p>Get 20%-50% off items over 50$ for a month or over 250$ for a
                                                        year with our special credit card.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="wsus__pro_det_vendor">
                                        <div class="row">
                                            <div class="col-xl-6 col-xxl-5 col-md-6">
                                                <div class="wsus__vebdor_img">
                                                    @if ($product->vendor_id === 0)
                                                        no banner
                                                    @else
                                                        <img src="{{ asset($product->vendor->banner) }}" alt="vensor"
                                                            class="img-fluid w-100">
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-7 col-md-6 mt-4 mt-md-0">
                                                <div class="wsus__pro_det_vendor_text">
                                                    <h4>
                                                        @if ($product->vendor_id === 0)
                                                            {{ $product->admin->name }}
                                                        @else
                                                            {{ $product->vendor->name }}
                                                        @endif
                                                    </h4>


                                                    @if ($product->vendor_id === 0)
                                                        <img src="{{ asset($product->admin->image) }}" alt="vensor"
                                                            style="width: 100px !important; height: auto;">>
                                                    @else
                                                        <img src="{{ asset($product->vendor->image) }}" alt="vendor"
                                                            style="width: 100px !important; height: auto;">
                                                    @endif


                                                    <p class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span>(41 review)</span>
                                                    </p>

                                                    <p><span>Address:</span>
                                                        @if ($product->vendor_id === 0)
                                                            {{ $product->admin->address }}
                                                        @else
                                                            {{ $product->vendor->address }}
                                                        @endif
                                                    </p>
                                                    <p><span>Phone:</span>
                                                        @if ($product->vendor_id === 0)
                                                            {{ $product->admin->contact }}
                                                        @else
                                                            {{ $product->vendor->contact }}
                                                        @endif
                                                    </p>
                                                    <p><span>mail:</span>
                                                        @if ($product->vendor_id === 0)
                                                            {{ $product->admin->email }}
                                                        @else
                                                            {{ $product->vendor->email }}
                                                        @endif
                                                    </p>
                                                    <a href="vendor_details.html" class="see_btn">visit store</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="wsus__vendor_details">
                                                    <p>
                                                        @if ($product->vendor_id === 0)
                                                            Admin
                                                        @else
                                                            {!! $product->vendor->desc !!}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact2" role="tabpanel"
                                    aria-labelledby="pills-contact-tab2">
                                    <div class="wsus__pro_det_review">
                                        <div class="wsus__pro_det_review_single">
                                            <div class="row">
                                                <div class="col-xl-8 col-lg-7">
                                                    <div class="wsus__comment_area">
                                                        <h4>Reviews <span>{{ count($reviews) }}</span></h4>
                                                        
                                                        @forelse ($reviews as $review)
                                                               <div class="wsus__main_comment">
                                                            <div class="wsus__comment_img">
                                                                <img src="{{ $review->user->image }}" alt="user"
                                                                    class="img-fluid w-100">
                                                            </div>
                                                            <div class="wsus__comment_text reply">
                                                                <h6>{{ $review->user->name }} <span>{{ $review->rating }} <i class="fas fa-star"></i></span>
                                                                </h6>
                                                                <span>{{ date('d M Y', strtotime($review->created_at)) }}</span>
                                                                <p>{{ $review->review }}
                                                                </p>

                                                                @if (count($review->reviewImages) > 0)
                                                                      <ul class="">
                                                                        @forelse ($review->reviewImages as $image)
                                                                             <li><img src="{{ asset($image->image) }}" alt="product"
                                                                            class="img-fluid w-100"></li>
                                                                        @empty
                                                                            
                                                                        @endforelse
                                                                   
                                                                  
                                                                </ul>
                                                                @endif
                                                              
                                                             
                                                              
                                                            </div>
                                                        </div>
                                                        @empty
                                                          No Review Available       
                                                        @endforelse
                                                     

                                                        @if ($reviews->hasPages())
                {{ $reviews->withQueryString()->links() }}
            @endif
                                                    </div>
                                                </div>


                                       
                                                @if ($canReview)
                                                       <div class="col-xl-4 col-lg-5 mt-4 mt-lg-0">
                                                        <div class="wsus__post_comment rev_mar" id="sticky_sidebar3">
                                                            <h4>write a Review</h4>
                                                            <form action="{{ route('user.review.store') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf

                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <input type="hidden" name="vendor_id" value="{{ $product->vendor_id }}">
                                                                <p class="rating">
                                                                    <span>select your rating : </span>
                                                                    <br>
                                                                    <select name="rating" class="form-control">
                                                                        <option value="">Select</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
                                                                    @error('rating')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror


                                                                </p>
                                                                <div class="row">


                                                                    <div class="col-xl-12">
                                                                        <div class="col-xl-12">
                                                                            <div class="wsus__single_com">
                                                                                <textarea name="review" cols="3" rows="3" placeholder="Write your review"></textarea>
                                                                                @error('review')
                                                                                    <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="img_upload">
                                                                    <div class="gallery">
                                                                       <input type="file" class="form-control" name="review_images[]" multiple> (Multiple image upload support)

                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <button class="common_btn" type="submit">submit
                                                                    review</button>
                                                            </form>
                                                        </div>
                                                    </div>    
                                                @endif




                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
            </div>
        </section>
        <!--============================
                        PRODUCT DETAILS END
                    ==============================-->

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            simplyCountdown('.simply-countdown-one', {
                year: {{ date('Y', strtotime(@$flashSaleDate->end_date)) }},
                month: {{ date('m', strtotime(@$flashSaleDate->end_date)) }},
                day: {{ date('d', strtotime(@$flashSaleDate->end_date)) }},
            });
        })


        const notyf = new Notyf();
           
    </script>

 
@endpush
