@extends('frontend.layout.master')
@section('title')
    {{ @$settings->site_name }}
@endsection


@section('content')
    
    <!--============================
        BANNER PART 2 START
    ==============================-->
    @include('frontend.sections.banner-section')
    <!--============================
        BANNER PART 2 END
    ==============================-->



    

    <!--============================
        FLASH SELL START
    ==============================-->
@if ($flashSaleDate !== null && $flashSaleDate->end_date >= now())
    @include('frontend.sections.flash-sell-section')
@else
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info text-center">
                    <strong>Flash Sale is not available at this moment.</strong>
                </div>
            </div>
        </div>
    </div>
@endif
    <!--============================
        FLASH SELL END
    ==============================-->





    <!--============================
       MONTHLY TOP PRODUCT START
    ==============================-->
    @if (!empty($topCategories))
      @include('frontend.sections.top-category-section')        
    @endif


    <!--============================
       MONTHLY TOP PRODUCT END
    ==============================-->


        
    <!--============================
        BRAND SLIDER START
    ==============================-->
    @if ($brands->count() > 0)
             @include('frontend.sections.brand-slider-section')
    @endif

    <!--============================
        BRAND SLIDER END
    ==============================-->


  
    <!--============================
        SINGLE BANNER START
    ==============================-->
        @include('frontend.sections.single-banner-section')

    <!--============================
        SINGLE BANNER END  
    ==============================-->


      

    <!--============================
        HOT DEALS START
    ==============================-->
@if ($typeBasedProduct !== null && count($typeBasedProduct) > 0)
    @include('frontend.sections.top-product-type-section')    
@endif

    <!--============================
        HOT DEALS END  
    ==============================-->


    
    <!--============================
        ELECTRONIC PART START  
    ==============================-->
@if ($singleCatOne !== null && $singleCatOne->count() > 0)
    @include('frontend.sections.single-category-section-one')
@endif
    <!--============================
        ELECTRONIC PART END  
    ==============================-->

@if ($singleCatTwo !== null && $singleCatTwo->count() > 0)
    @include('frontend.sections.single-category-section-two')
@endif


    <!--============================
        LARGE BANNER  START  
    ==============================-->
       @include('frontend.sections.large-banner-section')

    <!--============================
        LARGE BANNER  END  
    ==============================-->

   
    <!--============================
        WEEKLY BEST ITEM START  
    ==============================-->
@if ($singleCatThree !== null && $singleCatThree->count() > 0)
    @include('frontend.sections.single-category-section-three')
@endif

    <!--============================
        WEEKLY BEST ITEM END 
    ==============================-->


    <!--============================
      HOME SERVICES START
    ==============================-->
           @include('frontend.sections.home-services-section')

    <!--============================
        HOME SERVICES END
    ==============================-->


     {{-- 
    <!--============================
        HOME BLOGS START
    ==============================-->
        @include('frontend.sections.home-blogs-section')

    <!--============================
        HOME BLOGS END
    ==============================-->
    
    --}}
@endsection