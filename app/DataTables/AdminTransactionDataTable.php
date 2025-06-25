<?php

namespace App\DataTables;

use App\Models\AdminTransaction;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminTransactionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<AdminTransaction> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))



            ->addColumn('order_date', function ($query) {
                return date('d M Y', strtotime($query->created_at));
            })

  ->addColumn('invoice_id', function ($query) {
    return "<a href='".route('admin.all-orders.show', $query->order->id)."'>" . $query->order->invoice_id . "</a>";
})

            ->addColumn('amount', function ($query) {
                return $query->order->currency_icon . $query->amount;
            })

            ->filterColumn('invoice_id', function ($query, $keyword) {
                $query->whereHas('order', function ($query) use ($keyword) {
                    $query->where('invoice_id', 'like', "%$keyword%");
                });
            })

            ->rawColumns(['invoice_id', 'amount'])

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<AdminTransaction>
     */
    public function query(Transaction $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('admintransaction-table')
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
            Column::make('order_id'),
            Column::make('invoice_id'),
            Column::make('transaction_id'),
            Column::make('order_date'),
            Column::make('payment_method'),
            Column::make('amount_real_currency_name')->title('currency_used'),
            Column::make('amount'),
            Column::make('amount_real_currency'),


        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AdminTransaction_' . date('YmdHis');
    }
}
