<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\VendorOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorOrdersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<VendorOrder> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
               ->addColumn('action', function ($query) {
  $view = '<a href="' . route('vendor.order.show', $query->id) . '" class="btn btn-info">
           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 1 0 4 0a2 2 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
         </a>';





          

                return $view;
            })

            ->addColumn('payment_status', function ($query) {
                if ($query->payment_status === 1) {
                    return '<span class="badge bg-green-lt">Paid</span>';
                } else if ($query->payment_status == 0) {
                    return '<span class="badge bg-danger-lt">Unpaid</span>';
                }
            })



             ->addColumn('order_status', function($query){
                switch ($query->order_status) {
                    case 'pending':
                        return "<span class='badge bg-warning-lt'>pending</span>";
                        break;
                    case 'processed_and_ready_to_ship':
                        return "<span class='badge bg-info-lt'>processed</span>";
                        break;
                    case 'dropped_off':
                        return "<span class='badge bg-info-lt'>dropped off</span>";
                        break;
                    case 'shipped':
                        return "<span class='badge bg-info-lt'>shipped</span>";
                        break;
                    case 'out_for_delivery':
                        return "<span class='badge bg-primary-lt'>out for delivery</span>";
                        break;
                    case 'delivered':
                        return "<span class='badge bg-green-lt'>delivered</span>";
                        break;
                    case 'canceled':
                        return "<span class='badge bg-danger-lt'>canceled</span>";
                        break;
                    default:
                        # code...
                        break;
                }

            })

            ->addColumn('date', function($query){
                return date('d M Y', strtotime($query->created_at));
            })

            ->addColumn('amount',function($query){
                return $query->currency_icon . $query->amount;
            })

            ->addColumn('customer', function($query){
                return $query->user->name;
            })

     


            ->rawColumns(['action', 'payment_status', 'order_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<VendorOrder>
     */
    public function query(Order $model): QueryBuilder
    {
        return $model::whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->id);
        })->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendororders-table')
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
           Column::make('id')->width(50),
        Column::make('invoice_id')->width(100),
        Column::make('transaction_id')->width(100),
        Column::make('customer')->width(120),
        Column::make('date')->width(100),
      //  Column::make('amount')->width(80),
        Column::make('order_status')->width(120),
        Column::make('payment_status')->width(100),
        Column::make('payment_method')->width(100),
        Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(120) // Reduced from 360px
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorOrders_' . date('YmdHis');
    }
}
