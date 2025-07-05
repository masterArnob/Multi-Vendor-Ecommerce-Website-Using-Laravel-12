<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\Settings;
use App\Models\VendorWithdrawRequest;
use App\Models\WithdrawMethod;
use App\Models\WithdrawRequest;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorWithdrawRequestDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<VendorWithdrawRequest> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

       

            ->addColumn('action', function ($query) {

                $view = '<a href="' . route('vendor.withdraw-request.show', $query->id) . '" class="btn btn-purple mx-2">
                        View
                      </a>';


                return $view;
            })


            ->addColumn('status', function ($query) {
                if ($query->status === 'paid') {
                    return '<span class="badge bg-green-lt">Paid</span>';
                } else if ($query->status == 'pending') {
                    return '<span class="badge bg-warning-lt">Pending</span>';
                }else if ($query->status == 'decline') {
                    return '<span class="badge bg-danger-lt">Declined</span>';
                }
            })

                 ->addColumn('current_balance', function ($query) {
                       // Calculate total earnings
        $totalEarnings = Order::where('order_status', 'delivered')
            ->where('payment_status', 1)
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', Auth::user()->id);
            })->sum('sub_total');

        // Get current balance from the latest 'paid' withdrawal or use total earnings
        $currentBalance = null;
        $paidRequest = WithdrawRequest::where('vendor_id', Auth::user()->id)
            ->where('status', 'paid')
            ->orderBy('id', 'DESC')
            ->first();

        if ($paidRequest) {
            $currentBalance = $paidRequest->current_balance;
        } else {
            $currentBalance = $totalEarnings;
        }

                    $settings = Settings::first();
                    return $settings->currency_icon . $currentBalance;
            })


                 ->addColumn('withdraw_amount', function ($query) {
                    $settings = Settings::first();
                    return $settings->currency_icon . $query->withdraw_amount;
            })

                   ->addColumn('withdraw_charge', function ($query) {
                $settings = Settings::first();
                $method = WithdrawMethod::where('name', $query->method)->firstOrFail();
                   return $settings->currency_icon . $query->withdraw_charge . ' (' .$method->withdraw_charge . '%'. ')';
            })


          ->addColumn('created_at', function ($query) {
                return date('d M Y', strtotime($query->created_at));
            })


   

            ->rawColumns(['action', 'status', 'logo', 'is_featured'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<VendorWithdrawRequest>
     */
    public function query(WithdrawRequest $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorwithdrawrequest-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('method'),
            
            Column::make('withdraw_amount'),
            Column::make('withdraw_charge'),
            Column::make('current_balance'),
            Column::make('status'),
            Column::make('created_at'),
              Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(360)
                  ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorWithdrawRequest_' . date('YmdHis');
    }
}
