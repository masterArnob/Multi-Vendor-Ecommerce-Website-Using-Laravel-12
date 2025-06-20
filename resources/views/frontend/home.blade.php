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



        {{-- 

    <!--============================
       MONTHLY TOP PRODUCT START
    ==============================-->
      @include('frontend.sections.monthly-top-product-section')

    <!--============================
       MONTHLY TOP PRODUCT END
    ==============================-->


    <!--============================
        BRAND SLIDER START
    ==============================-->
     @include('frontend.sections.brand-slider-section')

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
     @include('frontend.sections.hot-deals-section')

    <!--============================
        HOT DEALS END  
    ==============================-->


    <!--============================
        ELECTRONIC PART START  
    ==============================-->
     @include('frontend.sections.electronic-section')

    <!--============================
        ELECTRONIC PART END  
    ==============================-->





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
        @include('frontend.sections.weekly-best-item-section')

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


    <!--============================
        HOME BLOGS START
    ==============================-->
        @include('frontend.sections.home-blogs-section')

    <!--============================
        HOME BLOGS END
    ==============================-->
    
    --}}
@endsection