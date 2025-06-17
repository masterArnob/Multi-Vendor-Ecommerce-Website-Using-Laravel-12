<?php

namespace App\DataTables;

use App\Models\AdminCoupon;
use App\Models\Coupon;
use App\Models\Settings;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminCouponDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<AdminCoupon> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        

        return (new EloquentDataTable($query))
               ->addColumn('action', function ($query) {

                $edit = '<a href="' . route('admin.coupon.edit', $query->id) . '" class="btn btn-warning mx-2">
                        Edit
                      </a>';
                $delete = '<a href="' . route('admin.coupon.destroy', $query->id) . '" class="btn btn-danger delete-item">
                        Delete
                      </a>';


          

                if (Auth::id() === 1) {
                    return $edit . $delete;
                }

                return $edit;
            })

            ->addColumn('status', function ($query) {
                if ($query->status === 1) {
                    return '<span class="badge bg-green-lt">Active</span>';
                } else if ($query->status == 0) {
                    return '<span class="badge bg-danger-lt">Inactive</span>';
                }
            })


        
            ->addColumn('discount_type', function($query){
                if($query->discount_type === 'percent'){
                     return '<span class="badge bg-purple-lt">Percent</span>';
                }else if($query->discount_type === 'amount'){
                    return '<span class="badge bg-orange-lt">Amount</span>';
                }
            })

            ->addColumn('discount', function($query){
                if($query->discount_type === 'percent'){
                    return $query->discount . '%';
                }else if($query->discount_type === 'amount'){
                    $settings = Settings::first();
                    return $settings->currency_icon . $query->discount;
                }
            })

            ->rawColumns(['action', 'status', 'discount_type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<AdminCoupon>
     */
    public function query(Coupon $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('admincoupon-table')
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
            Column::make('name'),
            Column::make('code'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('discount_type'),
            Column::make('discount'),
            Column::make('max_use'),
            Column::make('total_used'),
            Column::make('status'),
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
        return 'AdminCoupon_' . date('YmdHis');
    }
}
