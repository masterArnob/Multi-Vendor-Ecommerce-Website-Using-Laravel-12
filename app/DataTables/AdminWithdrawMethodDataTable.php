<?php

namespace App\DataTables;

use App\Models\AdminWithdrawMethod;
use App\Models\Settings;
use App\Models\WithdrawMethod;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminWithdrawMethodDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<AdminWithdrawMethod> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
                ->addColumn('action', function ($query) {

                $edit = '<a href="' . route('admin.withdraw-method.edit', $query->id) . '" class="btn btn-warning mx-2">
                        Edit
                      </a>';
                $delete = '<a href="' . route('admin.withdraw-method.destroy', $query->id) . '" class="btn btn-danger delete-item">
                        Delete
                      </a>';


          

                if (Auth::id() === 1) {
                    return $edit . $delete;
                }

                return $edit;
            })

       




            ->addColumn('minimum_amount', function($query){
                   $settings = Settings::first();
                 return $settings->currency_icon . $query->minimum_amount;
            })

                ->addColumn('maximum_amount', function($query){
                   $settings = Settings::first();
                 return $settings->currency_icon . $query->maximum_amount;
            })


                  ->addColumn('withdraw_charge', function($query){
                 return $query->withdraw_charge . '%';
            })


      

            ->rawColumns(['action', 'status', 'discount_type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<AdminWithdrawMethod>
     */
    public function query(WithdrawMethod $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('adminwithdrawmethod-table')
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
           Column::make('minimum_amount'),
           Column::make('maximum_amount'),
           Column::make('withdraw_charge'),
                 Column::computed(data: 'action')
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
        return 'AdminWithdrawMethod_' . date('YmdHis');
    }
}
