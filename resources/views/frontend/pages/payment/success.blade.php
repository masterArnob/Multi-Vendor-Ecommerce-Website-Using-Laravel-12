@extends('frontend.layout.master')
@section('content')
<div class="d-flex flex-column justify-content-center align-items-center text-center">
            <h3 class="text-success mt-5">Payment Success!</h3>
        <img src="{{ asset('frontend/assets/images/payment-gateway/payment-success.png') }}" alt="Payment Success" class="img-fluid mb-3" style="max-width: 500px;">
    </div>
@endsection