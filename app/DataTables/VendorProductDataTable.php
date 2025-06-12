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

                      $more = '<div class="btn-group dropstart">
  <!-- Button to toggle the dropdown -->
  <button type="button" class="btn btn-info w-100 dropdown-toggle mx-2" data-bs-toggle="dropdown" aria-expanded="false">
<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
  </button>
  <!-- Dropdown menu -->
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="'. route('vendor.product-variant.index', ['product_id' => $query->id]) .'">Variants</a></li>
    <li><a class="dropdown-item" href="'.route('vendor.image-gallery.index', ['product_id' => $query->id]).'">Product Image Gallery</a></li>

  </ul>
</div>';
          

     
                 return $edit . $delete . $more;

        
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
