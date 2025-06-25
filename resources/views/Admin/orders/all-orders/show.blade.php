<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Invoice - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->


    <link href="{{ asset('admin/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/dist/css/demo.min.css?1692870487') }}" rel="stylesheet" />

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
       <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Notyf CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

            <!-- Vite-bundled admin.js -->
    @vite(['resources/js/admin.js'])
</head>

<body>
    <script src="{{ asset('admin/dist/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page">
        <!-- Navbar -->

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                Invoice
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <a href="{{ route('admin.all-orders.index') }}" class="btn btn-primary">Back</a>
                            <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                                <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                    <path
                                        d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                </svg>
                                Print Invoice
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            @php
                $address = json_decode($order->order_address);
                $shipping = json_decode($order->shipping_method);
                $coupon = json_decode(@$order->coupon);
            @endphp
            <div class="page-body">
                <div class="container-xl">
                    <div class="card card-lg">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p class="h3">Company: {{ @$settings->site_name }}</p>
                                    <address>
                                        {!! strip_tags($settings->contact_address) !!} <br>
                                        {{ @$settings->contact_email }}<br>
                                        {{ @$settings->contact_phone }}
                                    </address>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="h3">Client: {{ $address->name }}</p>
                                    <address>
                                        {!! strip_tags($address->address) !!} <br>
                                        {{ $address->state }}, {{ $address->city }}, {{ $address->country }},
                                        {{ $address->zip }}<br>
                                        {{ $address->email }}<br>
                                        {{ $address->phone }}<br>
                                    </address>
                                </div>



                                <div class="col-6">
                                    <h1>Invoice #{{ $order->invoice_id }}</h1>
                                    <p class="">Order Status</p>
                                    <select name="order_status" data-id="{{ $order->id }}" class="form-control order_status">
                                        <option @selected($order->order_status === 'pending') value="pending">Pending</option>
                                        <option @selected($order->order_status === 'processed_and_ready_to_ship') value="processed_and_ready_to_ship">Processed and Ready to Ship</option>
                                        <option @selected($order->order_status === 'dropped_off') value="dropped_off">Dropped Off</option>
                                        <option @selected($order->order_status === 'shipped') value="shipped">Shipped</option>
                                        <option @selected($order->order_status === 'out_for_delivery') value="out_for_delivery">Out For Delivery</option>
                                        <option @selected($order->order_status === 'delivered') value="delivered">Delivered</option>
                                        <option @selected($order->order_status === 'canceled') value="canceled">Canceled</option>
                                    </select>
                                </div>


                            </div>
                            <table class="table table-transparent table-responsive">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%">SL NO</th>
                                        <th style="width: 15%">Product Image</th>
                                        <th style="width: 30%">Product</th>
                                        <th style="width: 15%">Vendor Name</th>
                                        <th class="text-center" style="width: 10%">Qty</th>
                                        <th class="text-end" style="width: 10%">Unit</th>
                                        <th class="text-end" style="width: 15%">Amount</th>
                                    </tr>
                                </thead>
                                @forelse ($order->orderProducts as $product)
                                    @php
                                        $variants = json_decode($product->variants, true) ?? [];
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ ++$loop->index }}</td>
                                        <td>
                                            <img src="{{ asset($product->product->thumb_image ?? 'path/to/default.jpg') }}"
                                                alt="Product Image" style="max-width: 50px; height: auto;">
                                        </td>
                                        <td>
                                            <p class="strong mb-1">{{ $product->product_name }}</p>
                                            @forelse ($variants as $key => $variant)
                                                <div class="text-secondary">{{ $key }}:
                                                    {{ $variant['name'] }}
                                                    (+{{ $order->currency_icon }}{{ $variant['price'] }})
                                                </div>
                                            @empty
                                            @endforelse
                                        </td>
                                        <td>{{ $product->vendor_id === 0 ? 'Admin Vendor' : $product->vendor->name ?? 'N/A' }}
                                        </td>
                                        <td class="text-center">{{ $product->qty }}</td>
                                        <td class="text-end">{{ $order->currency_icon }}{{ $product->unit_price }}
                                        </td>
                                        <td class="text-end">
                                            {{ $order->currency_icon }}{{ $product->unit_price * $product->qty + ($product->variant_total ?? 0) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Data Available</td>
                                    </tr>
                                @endforelse




                                <tr>
                                    <td colspan="6" class="text-end font-weight-bold">Subtotal</td>
                                    <td class="text-end">{{ $order->currency_icon }}{{ $order->sub_total }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-end font-weight-bold">Shipping</td>
                                    <td class="text-end">+{{ $order->currency_icon }}{{ $shipping->cost }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-end font-weight-bold">Coupon
                                        ({{ @$coupon->code === null ? 'None' : @$coupon->code }})</td>
                                    <td class="text-end coupon-amount">
                                        -{{ $order->currency_icon }}{{ @$coupon->code === null ? 0 : @$coupon->discount }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-end font-weight-bold text-uppercase">Total Due</td>
                                    <td class="text-end font-weight-bold">
                                        {{ $order->currency_icon }}{{ $order->amount }}</td>
                                </tr>

                            </table>
                            <p class="text-secondary text-center mt-5">Thank you very much for doing business with us.
                                We look forward to working with
                                you again!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <!-- Notyf JS -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('admin/dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('admin/dist/js/demo.min.js?1692870487') }}" defer></script>


    <script>
               var config = {
            routes: {
                changeOrderStatus: "{{ route('admin.change-order-status') }}", // Changed to route() for consistency
            },
            icon: {
                currency_icon: "{{ $settings->currency_icon ?? '$' }}",
            }
        };
    </script>
</body>

</html>
