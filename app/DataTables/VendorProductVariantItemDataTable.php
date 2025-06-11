<?php

namespace App\DataTables;

use App\Models\ProductVariantItem;
use App\Models\VendorProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductVariantItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<VendorProductVariantItem> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
                ->addColumn('action', function ($query) {

                $edit = '<a href="' . route('admin.product-variant-item.edit', ['product_id' => $query->product_id ,'variant_id' => $query->product_variant_id, 'variant_item_id' => $query->id]) . '" class="btn btn-warning mx-2">
                        Edit
                      </a>';
                $delete = '<a href="' . route('admin.product-variant-item.destroy', $query->id) . '" class="btn btn-danger delete-item">
                        Delete
                      </a>';


          

     

                return $edit . $delete;
            })



            ->addColumn('status', function ($query) {
                if ($query->status === 1) {
                    return '<span class="badge bg-green-lt">Active</span>';
                } else if ($query->status == 0) {
                    return '<span class="badge bg-danger-lt">Inactive</span>';
                }
            })


              ->addColumn('is_default', function ($query) {
                if ($query->is_default === 1) {
                    return '<span class="badge bg-green-lt">Yes</span>';
                } else if ($query->is_default == 0) {
                    return '<span class="badge bg-orange-lt">No</span>';
                }
            })


     

            ->rawColumns(['action', 'status', 'is_default'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<VendorProductVariantItem>
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        return $model->where('product_id', '=', request()->product_id)
        ->where('product_variant_id', '=', request()->variant_id)
        ->where('vendor_id', '=', Auth::user()->id)
        ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproductvariantitem-table')
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
            Column::make('price'),
            Column::make('is_default'),
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
        return 'VendorProductVariantItem_' . date('YmdHis');
    }
}
