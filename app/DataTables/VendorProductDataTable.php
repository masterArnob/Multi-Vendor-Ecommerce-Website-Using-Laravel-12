<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\VendorProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<VendorProduct> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
              ->addColumn('action', function ($query) {

                $edit = '<a href="' . route('vendor.product.edit', $query->id) . '" class="btn btn-warning mx-2">
                        Edit
                      </a>';
                $delete = '<a href="' . route('vendor.product.destroy', $query->id) . '" class="btn btn-danger delete-item">
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


              ->addColumn('is_approved', function ($query) {
                if ($query->is_approved === 1) {
                    return '<span class="badge bg-green-lt">Approved</span>';
                } else if ($query->is_approved == 0) {
                    return '<span class="badge bg-danger-lt">Pending</span>';
                }
            })


            ->addColumn('thumb_image', function ($query) {
                $imagePath = $query->thumb_image ? asset($query->thumb_image) : 'Image Not Updated';
                return '<span class="avatar avatar-xl" style="background-image: url(\'' . $imagePath . '\')"></span>';
            })



     
       



->addColumn('brand', function ($query) {
    $admin = \App\Models\Brand::find($query->brand_id);
    return $admin ? $admin->name : 'N/A';
})

->addColumn('offer_start_date', function($query){
    return $query->offer_start_date == '' ? 'No offer is going on' : $query->offer_start_date;
})

->addColumn('offer_end_date', function($query){
    return $query->offer_end_date == '' ? 'No offer is going on' : $query->offer_end_date;
})


->addColumn('offer_price', function($query){
    return $query->offer_price == '' ? 'No offer is going on' : $query->offer_price;
})

     

            ->rawColumns(['action', 'status', 'thumb_image', 'is_approved'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<VendorProduct>
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', '=', Auth::user()->id)
        ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproduct-table')
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
            Column::make('thumb_image'),
            Column::make('name'),
            Column::make('brand'),
            Column::make('qty'),
            Column::make('price'),
            Column::make('offer_price'),
            Column::make('offer_start_date'),
            Column::make('offer_end_date'),
            Column::make('status'),
            Column::make('is_approved'),

            
              Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(460)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProduct_' . date('YmdHis');
    }
}
