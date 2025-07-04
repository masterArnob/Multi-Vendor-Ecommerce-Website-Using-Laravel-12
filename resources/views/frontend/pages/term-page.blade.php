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
                        <h4>Terms & Conditions</h4>
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
        CUSTOM PAGES PAGE START
    ==============================-->
    <section id="wsus__product_page" class="wsus__custom_pages">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__description_area">
                       
                        <p>{!! $content[0]->content !!}</p>
                      
                   
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CUSTOM PAGES PAGE END
    ==============================-->
@endsection