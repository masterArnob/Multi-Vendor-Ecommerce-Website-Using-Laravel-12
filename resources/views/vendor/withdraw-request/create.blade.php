@extends('vendor.layout.master')
@section('content')

    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Withdraw Rules</h2>

                        @forelse ($withdraw as $item)
                        <h5>Name: {{ $item->name }}</h5> 
                        <h5>Minimum Amount: {{ $item->minimum_amount }}</h5>  
                        <h5>Maximum Amount: {{ $item->maximum_amount }}</h5> 
                        <h5>Withdraw Charge Per Withdraw: {{ $item->withdraw_charge }}%</h5>   
                        <h5>Description:</h5>
                        <h5>{!! $item->description !!}</h5>
                        @empty
                            No Data Available
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Create Withdraw</h2>

                        <form action="{{ route('vendor.withdraw-request.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3 align-items-center">
                                <div class="col-md-7">
                                    <div class="form-label">Total Earnings</div>
                                    <input type="text" value="{{ $totalEarnings }}" class="form-control" disabled>
                                    <input type="hidden" name="total_earnings" value="{{ $totalEarnings }}">
                                </div>

                                <div class="col-md-7">
                                    <div class="form-label">Current Balance</div>
                                    <input type="text" value="{{ $currentBalance }}" class="form-control" disabled>
                                </div>

                                <div class="col-md-7 mb-2">
                                    <div class="form-label">Method</div>
                                    <select name="method" class="form-select">
                                        <option value="">Select</option>
                                        @forelse ($withdraw as $method)
                                            <option value="{{ $method->name }}">{{ $method->name }}</option>
                                        @empty
                                            No Data Available
                                        @endforelse
                                    </select>
                                    @error('method')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-7 mt-3">
                                    <div class="form-label">Withdraw Amount</div>
                                    <input type="text" name="withdraw_amount" value="{{ old('withdraw_amount') }}" class="form-control">
                                    <x-input-error :messages="$errors->get('withdraw_amount')" class="mt-2 text-danger" />
                                </div>

                                <div class="col-md-7 mt-3">
                                    <div class="form-label">Account Information</div>
                                    <textarea name="account_info" class="form-control summernote">{{ old('account_info') }}</textarea>
                                    <x-input-error :messages="$errors->get('account_info')" class="mt-2 text-danger" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary">Send Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']]
            ]
        });
    </script>
@endpush