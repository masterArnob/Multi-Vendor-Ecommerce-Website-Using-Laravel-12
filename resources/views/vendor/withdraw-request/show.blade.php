@extends('vendor.layout.master')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Withdraw Request Details
                    </div>
              
                </div>
         
            </div>
        </div>
    </div>
    <!-- Page header -->
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <tbody>
                           

                           
                                <tr>
                                    <th>Method</th>
                                    <td>{{ $withdraw->method }}</td>
                                </tr>
                                <tr>
                                    <th>Withdraw Amount</th>
                                    <td>{{ $withdraw->withdraw_amount }} {{ @$settings->currency_icon }}
                                    </td>
                                </tr>

                                  <tr>
                                    <th>Withdraw Charge</th>
                                    <td>{{ $withdraw->withdraw_charge }} {{ @$settings->currency_icon }}
                                    </td>
                                </tr>


                                      <tr>
                                    <th>Account Inormation</th>
                                    <td>{!! $withdraw->account_info !!}
                                    </td>
                                </tr>


                                      <tr>
                                    <th>Status</th>
                                    <td>
                                        {{ $withdraw->status }}

                                    </td>
                                </tr>


                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
@endsection
