<?php

namespace App\DataTables;

use App\Models\ApprovedVendor;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ApprovedVendorDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<ApprovedVendor> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
         return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
              
                $edit = '<a href="'.route('admin.approved-vendors.edit', $query->id).'" class="btn btn-warning mx-2">
                        Edit
                      </a>';
                $delete = '<a href="'.route('admin.approved-vendors.destroy', $query->id).'" class="btn btn-danger delete-item">
                        Delete
                      </a>';

                      return $edit.$delete;
            })


            ->addColumn('vendor_request', function ($query) {
                if ($query->vendor_request === 0) {
                    return '<span class="badge bg-orange-lt">No</span>';
                } elseif ($query->vendor_request === 1) {
                    return '<span class="badge bg-purple-lt">Yes</span>';
                }
            })


            ->addColumn('vendor_status', function ($query) {
                if ($query->vendor_status === 'approved') {
                    return '<span class="badge bg-green-lt">Approved</span>';
                } 
            })


                     ->addColumn('image', function($query) {
    $imagePath = $query->image ? asset($query->image) : 'Image Not Updated';
    return '<span class="avatar avatar-xl" style="background-image: url(\'' . $imagePath . '\')"></span>';
})


            ->rawColumns(['action', 'vendor_request', 'vendor_status', 'image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<ApprovedVendor>
     */
    public function query(User $model): QueryBuilder
    {
         return $model->where('vendor_request', 1)
            ->where('vendor_status', '=', 'approved')
            ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('approvedvendor-table')
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
             Column::make('image'),
            Column::make('name'),
            Column::make('email'),
            Column::make('contact'),
            Column::make('vendor_request'),
            Column::make('vendor_status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(350)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ApprovedVendor_' . date('YmdHis');
    }
}
