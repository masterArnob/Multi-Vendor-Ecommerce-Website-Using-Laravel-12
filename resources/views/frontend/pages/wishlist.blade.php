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
                        <h4>wishlist</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">wishlist</a></li>
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
                <div class="col-12">
                    <div class="wsus__cart_list wishlist">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            name
                                        </th>

                                        <th class="wsus__pro_status">
                                            category
                                        </th>

                                           <th class="wsus__pro_name">
                                            short description
                                        </th>

                                    

                                        <th class="wsus__pro_tk">
                                            price
                                        </th>

                                        <th class="wsus__pro_icon">
                                            action
                                        </th>
                                    </tr>
                                    @forelse ($wishes as $item)
                                             <tr class="d-flex">
                                        <td class="wsus__pro_img"><img src="{{ asset($item->product->thumb_image) }}" alt="product"
                                                class="img-fluid w-100">
                                            <a href="{{ route('user.wishlist.product.remove', ['product_id' => $item->product_id]) }}"><i class="far fa-times"></i></a>
                                        </td>

                                        <td class="wsus__pro_name">
                                            <p>{{ $item->product->name }}</p>
                                        </td>

                                        <td class="wsus__pro_status">
                                            <p>{{ $item->product->category->name }}</p>
                                        </td>

                                            <td class="wsus__pro_name">
                                            <p>{{ $item->product->short_description }}</p>
                                        </td>

                                

                                        <td class="wsus__pro_tk">
                                            <h6>{{ @$settings->currency_icon }}{{ $item->product->price }}</h6>
                                        </td>

                                        <td class="wsus__pro_icon">
                                            <a class="common_btn" href="{{ route('product-details.show', $item->product->id) }}">view</a>
                                        </td>
                                    </tr>
                                    @empty
                                       <tr>
                                        <td>
                                            <p class="mt-3 mb-3"> No Data Available</p>
                                        </td>
                                       </tr>
                                    @endforelse
                               
                               
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        wish VIEW PAGE END
    ==============================-->
@endsection