<?php

namespace App\DataTables;

use App\Models\AdminProductVariant;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminProductVariantDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<AdminProductVariant> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
                  ->addColumn('action', function ($query) {

                $edit = '<a href="' . route('admin.product-variant.edit', ['product_id' => request()->product_id ,'variant_id' => $query->id]) . '" class="btn btn-warning mx-2">
                        Edit
                      </a>';
                $delete = '<a href="' . route('admin.product-variant.destroy', $query->id) . '" class="btn btn-danger delete-item">
                        Delete
                      </a>';


                      $more = '<div class="btn-group dropstart">
  <!-- Button to toggle the dropdown -->
  <button type="button" class="btn btn-info w-100 dropdown-toggle mx-2" data-bs-toggle="dropdown" aria-expanded="false">
<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
  </button>
  <!-- Dropdown menu -->
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="'. route('admin.product-variant-item.index', ['product_id' => $query->product_id, 'variant_id' => $query->id]) .'">Variant Items</a></li>
  </ul>
</div>';
          

                if (Auth::id() === 1) {
                    return $edit . $delete.$more;
                }

                return $edit.$more;
            })

            ->addColumn('product_name', function($query){
                return $query->product->name;
            })

            ->addColumn('status', function ($query) {
                if ($query->status === 1) {
                    return '<span class="badge bg-green-lt">Active</span>';
                } else if ($query->status == 0) {
                    return '<span class="badge bg-danger-lt">Inactive</span>';
                }
            })


     

            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<AdminProductVariant>
     */
    public function query(ProductVariant $model): QueryBuilder
    {
        return $model->where('vendor_id', '=', 0)
        ->where('product_id', '=', request()->product_id)
        ->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('adminproductvariant-table')
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
            Column::make('product_name'),
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
        return 'AdminProductVariant_' . date('YmdHis');
    }
}
