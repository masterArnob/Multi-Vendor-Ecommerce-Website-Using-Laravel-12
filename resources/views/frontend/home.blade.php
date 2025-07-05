@extends('frontend.layout.master')
@section('title')
    {{ @$settings->site_name }}
@endsection


@section('content')
    


     @if (!empty($mode) && $mode->mode === 'on')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h1 class="text-danger">Maintenance Mode</h1>
                    <p class="text-muted">The site is currently under maintenance. Please check back later.</p>
                    <p class="text-muted">If you are an admin, you can access the site using the secret key: <strong>{{ $mode->secret_key }}</strong></p>
                </div>
            </div>
        </div>
        
         
     @endif
    

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
    @if ($home_page_banner_two !== null)
        @include('frontend.sections.single-banner-section')        
    @endif


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