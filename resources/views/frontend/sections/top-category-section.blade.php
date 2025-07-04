@php
    $topCategories = json_decode($topCategories->value, true);
    //dd($topCategories);
@endphp
<section id="wsus__monthly_top" class="wsus__monthly_top_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
         @if (!empty($home_page_banner_one))
    @include('frontend.sections.ads.home-page-banner-one')
@endif
               
           
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header for_md">
                    <h3>Top Categories Of The Month</h3>
                    <div class="monthly_top_filter">
                     

                        @php
                            $products = [];
                        @endphp

                        @forelse($topCategories as $key => $topCat)
                            {{-- @dd($topCat); --}}
                            @php
                                $lastKey = [];
                                foreach ($topCat as $key => $category) {
                                    if ($category === null) {
                                        break;
                                    }
                                    $lastKey = [$key => $category];
                                }
                                //dd($lastKey);
                                if (array_keys($lastKey)[0] === 'category') {
                                    $category = App\Models\Category::find($lastKey['category']);
                                    $products[] = App\Models\Product::where('category_id', $category->id)
                                        ->where('is_approved', 1)
                                        ->orderBy('id', 'DESC')
                                        ->take(12)
                                        ->get();
                                } elseif (array_keys($lastKey)[0] === 'sub_category') {
                                    $category = App\Models\SubCategory::find($lastKey['sub_category']);
                                    $products[] = App\Models\Product::where('sub_category_id', $category->id)
                                        ->where('is_approved', 1)
                                        ->orderBy('id', 'DESC')
                                        ->take(12)
                                        ->get();
                                } else {
                                    $category = App\Models\ChildCategory::find($lastKey['child_category']);
                                    $products[] = App\Models\Product::where('child_category_id', $category->id)
                                        ->where('is_approved', 1)
                                        ->orderBy('id', 'DESC')
                                        ->take(12)
                                        ->get();
                                }
                            @endphp

                            <button class="{{ $loop->index === 0 ? 'auto_click active' : '' }}" data-filter=".category-{{ $loop->index }}">{{ $category->name }}</button>
                        @empty
                            No data Available
                        @endforelse





                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="row grid">

                    @forelse ($products as $key => $product)
                        @forelse ($product as $item)
                            <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3  category-{{ $key }}">
                                <a class="wsus__hot_deals__single" href="#">
                                    <div class="wsus__hot_deals__single_img">
                                        <img src="{{ asset($item->thumb_image) }}" alt="bag"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__hot_deals__single_text">
                                        <h5>{{ limitText($item->name) }}</h5>
                                         <p class="wsus__rating">
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
                                     
                                        @if ($item->offer_price > 0 && $item->offer_start_date <= now() && $item->offer_end_date >= now())
                                         
                                            <p class="wsus__tk">{{ @$settings->currency_icon }}{{ $item->offer_price }} <del class="text-danger"> {{ @$settings->currency_icon }}{{ $item->price }}</del></p>
                                        @else
                                            <p class="wsus__tk">{{ @$settings->currency_icon }}{{ $item->price }}</p>
                                        @endif

                                    </div>
                                </a>
                            </div>
                        @empty
                        
                        @endforelse
                    @empty
                        No Data Available
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</section>
