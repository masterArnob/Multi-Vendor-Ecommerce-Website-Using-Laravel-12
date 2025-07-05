@extends('admin.layout.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Withdraw Request Details
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <tbody>
                                <tr>
                                    <th>Vendor Name</th>
                                    <td><a href="{{ route('admin.approved-vendors.edit', $withdraw->vendor->id) }}">{{ $withdraw->vendor->name }}</a></td>
                                </tr>
                                <tr>
                                    <th>Vendor Banner</th>
                                    <td><img src="{{ asset($withdraw->vendor->banner) }}" alt=""></td>
                                </tr>
                                <tr>
                                    <th>Method</th>
                                    <td>{{ $withdraw->method }}</td>
                                </tr>
                                <tr>
                                    <th>Total Earnings</th>
                                    <td>{{ $withdraw->total_earnings }} {{ $settings->currency_icon ?? 'TK' }}</td>
                                </tr>
                                <tr>
                                    <th>Withdraw Amount</th>
                                    <td>{{ $withdraw->withdraw_amount }} {{ $settings->currency_icon ?? 'TK' }}</td>
                                </tr>
                                <tr>
                                    <th>Withdraw Charge</th>
                                    <td>{{ $withdraw->withdraw_charge }} {{ $settings->currency_icon ?? 'TK' }}</td>
                                </tr>
                                <tr>
                                    <th>Current Balance</th>
                                    <td>{{ $withdraw->current_balance }} {{ $settings->currency_icon ?? 'TK' }}</td>
                                </tr>
                                <tr>
                                    <th>Account Information</th>
                                    <td>{!! $withdraw->account_info !!}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="col-6 p-3">
                            <label class="form-label">Status</label>
                            <form action="{{ route('admin.withdraw-request.update', $withdraw->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control" {{ $withdraw->status == 'paid' ? 'disabled' : '' }}>
                                    <option @selected($withdraw->status == 'pending') value="pending">Pending</option>
                                    <option @selected($withdraw->status == 'decline') value="decline">Declined</option>
                                    <option @selected($withdraw->status == 'paid') value="paid">Paid</option>
                                </select>
                                <button type="submit" class="mt-2 btn btn-primary">Update</button>
                                @error('status')
                                    <x-input-error :messages="$errors->get('status')" class="mt-2 text-danger" />
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection