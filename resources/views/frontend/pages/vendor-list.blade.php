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
                        <h4>vendors</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">vendors</a></li>
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
      VENDORS START
    ==============================-->
    <section id="wsus__product_page" class="wsus__vendors">
        <div class="container">
            <div class="row">
             
                <div class="col-xl-12 col-lg-8">
                    <div class="row">
                      
                        @forelse ($vendors as $vendor)
                                 <div class="col-xl-4 col-md-6">
                            <div class="wsus__vendor_single">
                                <img src="{{ asset($vendor->banner) }}" alt="vendor" class="img-fluid w-100">
                                <div class="wsus__vendor_text">
                                    <div class="wsus__vendor_text_center">
                                        <h4>{{ $vendor->name }}</h4>
                                   
                                        <a href="callto:+6955548721111"><i class="far fa-phone-alt"></i>
                                            {{ $vendor->contact }}</a>
                                        <a href="mailto:example@gmail.com"><i class="fal fa-envelope"></i>
                                            {{ $vendor->email }}</a>
                                        <a href="{{ route('vendor-details.index', ['vendor_id' => $vendor->id]) }}" class="common_btn">visit store</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        No Data Available         
                        @endforelse
                   
                       
                    </div>
                </div>
                <div class="col-xl-12">
                        @if ($vendors->hasPages())
                {{ $vendors->withQueryString()->links() }}
            @endif
                </div>
            </div>
        </div>
    </section>
    <!--============================
       VENDORS END
    ==============================-->
@endsection