@extends('frontend.layout.master')
@section('content')

<style>
    .qty-input{
        width: 60px;
        height: 40px;
        border: 1px solid #ddd;
        padding: 0 10px;
        font-size: 16px;
        text-align: center;
    }
</style>
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
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
        CART VIEW PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            Product Image
                                        </th>

                                        <th class="wsus__pro_name">
                                            Product Name
                                        </th>

                                        <th class="wsus__pro_status">
                                            Price
                                        </th>

                                         <th class="wsus__pro_status">
                                            Total Price
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>

                                    


                                        <th class="wsus__pro_icon">
                                            @if (Cart::count() > 0)
                                            <a href="{{ route('clear-cart', 1) }}" class="common_btn delete-item">clear cart</a>
                                             @endif
                                        </th>
                                       
                                    </tr>
                                    @forelse ($cartItems as $item)
                                         <tr class="d-flex">
                                        <td class="wsus__pro_img"><img src="{{ $item->options->image }}" alt="product"
                                                class="img-fluid w-100">
                                        </td>

                                        <td class="wsus__pro_name">
                                            <p><a href="{{ route('product-details.show', $item->id) }}">{{ $item->name }}</a></p>
                                           
                                                @forelse ($item->options->variants as $key => $variant)
                                                     <span>
                                                        {{ $key }}: {{ $variant['name'] }} (+{{ $settings->currency_icon }}{{ $variant['price'] }})
                                                    </span>
                                                @empty
                                                    
                                                @endforelse
                                         
                                       
                                        </td>

                                        <td class="wsus__pro_status">
                                            <p>{{ $settings->currency_icon }}{{ $item->price }}</p>
                                        </td>

                                           <td class="wsus__pro_status">
                                            <p id="{{ $item->rowId }}">{{ $settings->currency_icon }}{{ ($item->price + $item->options->variantsTotal) * $item->qty }}</p>
                                        </td>

                                        <td class="wsus__pro_select">
                                            <form class="select_number">
                                                <button class="btn btn-danger decrement-btn">-</button>
                                               <input readonly data-rowid="{{ $item->rowId }}" type="number" name="qty" value="{{ $item->qty }}" min="1" class="qty-input">
                                                 <button class="btn btn-success increment-btn">+</button>
                                            </form>
                                        </td>

                                     

                                        <td class="wsus__pro_icon">
                                            <a href="{{ route('cart-remove-item', $item->rowId) }}"><i class="far fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td class="mt-3 mb-3">Cart is empty</td>
                                        </tr>
                                    @endforelse
                         
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span>$124.00</span></p>
                        <p>delivery: <span>$00.00</span></p>
                        <p>discount: <span>$10.00</span></p>
                        <p class="total"><span>total:</span> <span>$134.00</span></p>

                        <form>
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="check_out.html">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i
                                class="fab fa-shopify"></i> go shop</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset('frontend/assets/images/single_banner_2.jpg') }}" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="{{ asset('frontend/assets/images/single_banner_3.jpg') }}" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
          CART VIEW PAGE END
    ==============================-->
@endsection