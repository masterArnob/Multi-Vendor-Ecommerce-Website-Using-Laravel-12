<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Brand> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
                 ->addColumn('action', function ($query) {

                $edit = '<a href="' . route('admin.brand.edit', $query->id) . '" class="btn btn-warning mx-2">
                        Edit
                      </a>';
                $delete = '<a href="' . route('admin.brand.destroy', $query->id) . '" class="btn btn-danger delete-item">
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

                 ->addColumn('is_featured', function ($query) {
                if ($query->is_featured === 1) {
                    return '<span class="badge bg-green-lt">Yes</span>';
                } else if ($query->is_featured == 0) {
                    return '<span class="badge bg-danger-lt">No</span>';
                }
            })


            ->addColumn('logo', function ($query) {
                $imagePath = $query->logo ? asset($query->logo) : 'Logo Not Updated';
                return '<span class="avatar avatar-xl" style="background-image: url(\'' . $imagePath . '\')"></span>';
            })


   

            ->rawColumns(['action', 'status', 'logo', 'is_featured'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Brand>
     */
    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('brand-table')
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
             Column::make('logo'),
            Column::make('name'),
            Column::make('slug'),
            Column::make('is_featured'),
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
        return 'Brand_' . date('YmdHis');
    }
}
