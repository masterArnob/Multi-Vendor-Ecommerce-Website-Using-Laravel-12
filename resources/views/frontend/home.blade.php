@extends('frontend.layout.master')
@section('title')
    {{ $settings->site_name }}
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
    @if ($flashSaleDate->end_date >= now())
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
        @include('frontend.sections.single-banner-section')

    <!--============================
        SINGLE BANNER END  
    ==============================-->


      

    <!--============================
        HOT DEALS START
    ==============================-->
     @include('frontend.sections.top-product-type-section')

    <!--============================
        HOT DEALS END  
    ==============================-->


    
    <!--============================
        ELECTRONIC PART START  
    ==============================-->
    @if ($singleCatOne->count() > 0)
             @include('frontend.sections.single-category-section-one')
    @endif
    <!--============================
        ELECTRONIC PART END  
    ==============================-->

    @if ($singleCatTwo->count() > 0)
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
       @if ($singleCatThree->count() > 0)
     @include('frontend.sections.single-category-section-three')
   @endif

    <!--============================
        WEEKLY BEST ITEM END 
    ==============================-->

 {{-- 
    <!--============================
      HOME SERVICES START
    ==============================-->
           @include('frontend.sections.home-services-section')

    <!--============================
        HOME SERVICES END
    ==============================-->


    <!--============================
        HOME BLOGS START
    ==============================-->
        @include('frontend.sections.home-blogs-section')

    <!--============================
        HOME BLOGS END
    ==============================-->
    
    --}}
@endsection