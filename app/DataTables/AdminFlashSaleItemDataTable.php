<?php

namespace App\DataTables;

use App\Models\AdminFlashSaleItem;
use App\Models\FlashSaleItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminFlashSaleItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<AdminFlashSaleItem> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
                ->addColumn('action', function ($query) {
                        $edit = '<a href="' . route('admin.flash-sale.edit', $query->id) . '" class="btn btn-warning mx-2">
                        Edit
                      </a>';

                $delete = '<a href="' . route('admin.flash-sale.destroy', $query->id) . '" class="btn btn-danger delete-item">
                        Delete
                      </a>';


          

                if (Auth::id() === 1) {
                    return $edit . $delete;
                }
                return $edit;
            })



              ->addColumn('show_at_home', function ($query) {
                if ($query->show_at_home === 1) {
                    return '<span class="badge bg-green-lt">Yes</span>';
                } else if ($query->show_at_home == 0) {
                    return '<span class="badge bg-danger-lt">No</span>';
                }
            })


            ->addColumn('status', function ($query) {
                if ($query->status === 1) {
                    return '<span class="badge bg-green-lt">Active</span>';
                } else if ($query->status == 0) {
                    return '<span class="badge bg-danger-lt">Inactive</span>';
                }
            })


    

            ->rawColumns(['action', 'status', 'thumb_image', 'is_approved', 'created_by'])

            ->addColumn('product_name', function($query){
                return '<a href="'.route('admin.product.edit', $query->product->id).'">'.$query->product->name.'</a>';
            })

             ->addColumn('product_price', function($query){
                return $query->product->price;
            })

               ->addColumn('product_image', function ($query) {
                $imagePath = $query->product->thumb_image ? asset($query->product->thumb_image) : 'Image Not Updated';
                return '<span class="avatar avatar-xl" style="background-image: url(\'' . $imagePath . '\')"></span>';
            })

              ->rawColumns(['action', 'status', 'product_image', 'show_at_home', 'product_name'])

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<AdminFlashSaleItem>
     */
    public function query(FlashSaleItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('adminflashsaleitem-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
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
            Column::make('product_image'),
            Column::make('product_name'),
            Column::make('product_price'),
             Column::make('show_at_home'),
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
        return 'AdminFlashSaleItem_' . date('YmdHis');
    }
}
