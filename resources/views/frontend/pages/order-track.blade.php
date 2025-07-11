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
                        <h4>order tracking</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">order tracking</a></li>
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
        TRACKING ORDER START
    ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="wsus__track_area">
                <div class="row">
                    <div class="col-xl-5 col-md-10 col-lg-8 m-auto">
                        <form class="tack_form" action="{{ route('order-track') }}" method="GET">
                            <h4 class="text-center">order tracking</h4>
                            <p class="text-center">tracking your order status</p>
                            <div class="wsus__track_input">
                                <label class="d-block mb-2">invoice id*</label>
                                <input type="text" name="invoice_id" value="{{ @$order->invoice_id }}" placeholder="H25-21578455" required>
                            </div>
                          
                            <button type="submit" class="common_btn">track</button>
                        </form>
                    </div>
                </div>
              
                @if (!empty($order))
                      <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__track_header">
                            <div class="wsus__track_header_text">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        <div class="wsus__track_header_single">
                                            <h5>order date:</h5>
                                            <p>{{ date('d M Y', strtotime($order->created_at)) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        <div class="wsus__track_header_single">
                                            <h5>shopping by:</h5>
                                            <p>{{ $order->user->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        <div class="wsus__track_header_single">
                                            <h5>status:</h5>
                                            <p>{{ @$order->order_status }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                        <div class="wsus__track_header_single border_none">
                                            <h5>Transaction ID:</h5>
                                            <p>{{ $order->transaction_id }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <ul class="progtrckr" data-progtrckr-steps="4">
                            <li class="progtrckr_done icon_one check_mark">Pending</li>
                            @if ($order->order_status === 'canceled')
                              <li class="icon_four red_mark">Canceled</li>
                            @else
                            <li class="progtrckr_done icon_two {{ $order->order_status == 'processed_and_ready_to_ship' || 
                                                                  $order->order_status == 'dropped_off' ||
                                                                  $order->order_status == 'shipped' ||
                                                                  $order->order_status == 'out_for_delivery' ||
                                                                  $order->order_status == 'delivered' ? 'check_mark' : '' 
                            }}">order Processing</li>
                            <li class="icon_three {{ 
                            $order->order_status == 'out_for_delivery' ||
                            $order->order_status == 'delivered' ? 'check_mark' : '' 
                            }}">on the way</li>
                            <li class="icon_four {{ 
                             $order->order_status == 'delivered' ? 'check_mark' : '' 
                            }}">delivered</li>
                            @endif
                            
                           
                        </ul>
                    </div>
                    <div class="col-xl-12">
                        <a href="#" class="common_btn"><i class="fas fa-chevron-left"></i> back to order</a>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </section>
    <!--============================
        TRACKING ORDER END
    ==============================-->
@endsection