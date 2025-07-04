@php
    use App\Models\Category;
    use App\Models\SubCategory;
    use App\Models\ChildCategory;
    use App\Models\Product;

    $singleCatThree = json_decode($singleCatThree->value); // JSON: [{"category":"1","sub_category":"1","child_category":"1"},{"category":"4","sub_category":"4","child_category":"4"}]
    
    // Initialize defaults for first category object ($singleCatThree[0])
    $categoryDisplay1 = 'Unknown';
    $categorySource1 = 'none';
    $products1 = collect();
    $error1 = null;

    // Process $singleCatThree[0]
    if (!isset($singleCatThree[0])) {
        $error1 = 'Error: $singleCatThree[0] is not set or empty';
    } else {
        $categoryDisplay1 = $singleCatThree[0]->category;
        $categorySource1 = 'category';
        $cat1 = Category::find($singleCatThree[0]->category);

        if (is_null($cat1)) {
            $error1 = 'Category ID ' . $singleCatThree[0]->category . ' not found';
        } else {
            $products1 = Product::where(['category_id' => $cat1->id])->get();
        }

        if (!is_null($singleCatThree[0]->sub_category)) {
            $categoryDisplay1 = $singleCatThree[0]->sub_category;
            $categorySource1 = 'sub_category';
            $cat1 = SubCategory::find($singleCatThree[0]->sub_category);

            if (is_null($cat1)) {
                $error1 = 'SubCategory ID ' . $singleCatThree[0]->sub_category . ' not found';
            } else {
                $products1 = Product::where(['sub_category_id' => $cat1->id])->get();
            }
        }

        if (!is_null($singleCatThree[0]->child_category)) {
            $categoryDisplay1 = $singleCatThree[0]->child_category;
            $categorySource1 = 'child_category';
            $cat1 = ChildCategory::find($singleCatThree[0]->child_category);

            if (is_null($cat1)) {
                $error1 = 'ChildCategory ID ' . $singleCatThree[0]->child_category . ' not found';
            } else {
                $products1 = Product::where(['child_category_id' => $cat1->id])->get();
            }
        }

        if ($products1->isEmpty() && is_null($error1)) {
            $error1 = 'No products found for ' . $categorySource1 . ' ID ' . ($cat1 ? $cat1->id : 'unknown');
        }
    }

    // Initialize defaults for second category object ($singleCatThree[1])
    $categoryDisplay2 = 'Unknown';
    $categorySource2 = 'none';
    $products2 = collect();
    $error2 = null;

    // Process $singleCatThree[1]
    if (!isset($singleCatThree[1])) {
        $error2 = 'Error: $singleCatThree[1] is not set or empty';
    } else {
        $categoryDisplay2 = $singleCatThree[1]->category;
        $categorySource2 = 'category';
        $cat2 = Category::find($singleCatThree[1]->category);

        if (is_null($cat2)) {
            $error2 = 'Category ID ' . $singleCatThree[1]->category . ' not found';
        } else {
            $products2 = Product::where(['category_id' => $cat2->id])->get();
        }

        if (!is_null($singleCatThree[1]->sub_category)) {
            $categoryDisplay2 = $singleCatThree[1]->sub_category;
            $categorySource2 = 'sub_category';
            $cat2 = SubCategory::find($singleCatThree[1]->sub_category);

            if (is_null($cat2)) {
                $error2 = 'SubCategory ID ' . $singleCatThree[1]->sub_category . ' not found';
            } else {
                $products2 = Product::where(['sub_category_id' => $cat2->id])->get();
            }
        }

        if (!is_null($singleCatThree[1]->child_category)) {
            $categoryDisplay2 = $singleCatThree[1]->child_category;
            $categorySource2 = 'child_category';
            $cat2 = ChildCategory::find($singleCatThree[1]->child_category);

            if (is_null($cat2)) {
                $error2 = 'ChildCategory ID ' . $singleCatThree[1]->child_category . ' not found';
            } else {
                $products2 = Product::where(['child_category_id' => $cat2->id])->get();
            }
        }

        if ($products2->isEmpty() && is_null($error2)) {
            $error2 = 'No products found for ' . $categorySource2 . ' ID ' . ($cat2 ? $cat2->id : 'unknown');
        }
    }

    // Debug output
    // @dd(['products1' => $products1, 'error1' => $error1, 'categoryDisplay1' => $categoryDisplay1, 'categorySource1' => $categorySource1, 'products2' => $products2, 'error2' => $error2, 'categoryDisplay2' => $categoryDisplay2, 'categorySource2' => $categorySource2]);
@endphp
<section id="wsus__weekly_best" class="home2_wsus__weekly_best_2 ">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-sm-6">
                    <div class="wsus__section_header">
                        <h3>{{ $cat1->name }}</h3>
                    </div>
                    <div class="row weekly_best2">
                
                   @forelse ($products1 as $item)
                            <div class="col-xl-4 col-lg-4">
                            <a class="wsus__hot_deals__single" href="#">
                                <div class="wsus__hot_deals__single_img">
                                    <img src="{{ asset($item->thumb_image) }}" alt="bag" class="img-fluid w-100">
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
                                    <p class="wsus__tk">
                                           @if ($item->offer_price > 0 && $item->offer_start_date <= now() && $item->offer_end_date >= now())
                                    {{ @$settings->currency_icon }}{{ $item->offer_price }}
                                    <del class="text-danger">{{ @$settings->currency_icon }}{{ $item->price }}</del>
                                @else
                                    {{ @$settings->currency_icon }}{{ $item->price }}
                                @endif
                                    </p>
                                </div>
                            </a>
                        </div>
                   @empty
                       No Data Available
                   @endforelse
                 
                     
                    
                    
                    </div>
                </div>
                






                             <div class="col-xl-6 col-sm-6">
                    <div class="wsus__section_header">
                        <h3>{{ $cat2->name }}</h3>
                    </div>
                    <div class="row weekly_best2">
                
                   @forelse ($products2 as $item)
                            <div class="col-xl-4 col-lg-4">
                            <a class="wsus__hot_deals__single" href="#">
                                <div class="wsus__hot_deals__single_img">
                                    <img src="{{ asset($item->thumb_image) }}" alt="bag" class="img-fluid w-100">
                                </div>
                                <div class="wsus__hot_deals__single_text">
                                    <h5>men's sholder bag</h5>
                               
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

                                    <p class="wsus__tk">
                                           @if ($item->offer_price > 0 && $item->offer_start_date <= now() && $item->offer_end_date >= now())
                                    {{ @$settings->currency_icon }}{{ $item->offer_price }}
                                    <del class="text-danger">{{ @$settings->currency_icon }}{{ $item->price }}</del>
                                @else
                                    {{ @$settings->currency_icon }}{{ $item->price }}
                                @endif
                                    </p>
                                </div>
                            </a>
                        </div>
                   @empty
                       No Data Available
                   @endforelse
                 
                     
                    
                    
                    </div>
                </div>


            </div>
        </div>
    </section>