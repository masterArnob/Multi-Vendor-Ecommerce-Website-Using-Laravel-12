<?php

namespace App\DataTables;

use App\Models\AdminShippingRule;
use App\Models\Settings;
use App\Models\ShippingRule;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminShippingRuleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<AdminShippingRule> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
                ->addColumn('action', function ($query) {

                $edit = '<a href="' . route('admin.shipping-rule.edit', $query->id) . '" class="btn btn-warning mx-2">
                        Edit
                      </a>';
                $delete = '<a href="' . route('admin.shipping-rule.destroy', $query->id) . '" class="btn btn-danger delete-item">
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


        
            ->addColumn('type', function($query){
                if($query->type === 'flat_cost'){
                     return '<span class="badge bg-purple-lt">Flat Cost</span>';
                }else if($query->type === 'min_cost'){
                    return '<span class="badge bg-orange-lt">Minimum Cost</span>';
                }
            })


            ->addColumn('cost', function($query){
                    $settings = Settings::first();
                    return $settings->currency_icon . $query->cost;
            })

              ->addColumn('min_cost', function($query){
                    $settings = Settings::first();
                   if(empty($query->min_cost)){
                       return '';
                   }
                   return $settings->currency_icon . $query->min_cost;
            })

  

            ->rawColumns(['action', 'status', 'type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<AdminShippingRule>
     */
    public function query(ShippingRule $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('adminshippingrule-table')
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
            Column::make('type'),
            Column::make('min_cost'),
            Column::make('cost'),
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
        return 'AdminShippingRule_' . date('YmdHis');
    }
}
