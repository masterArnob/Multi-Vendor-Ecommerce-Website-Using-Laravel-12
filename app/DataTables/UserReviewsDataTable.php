<?php

namespace App\DataTables;

use App\Models\Review;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserReviewsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Review> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
           
            ->addColumn('product', function($query){
                return "<a href='" . route('product-details.show', $query->product->id) . "' target='_blank'>" . $query->product->name . "</a>";
            })
            ->addColumn('product_image', function($query){
                return '<img src="' . asset($query->product->image) . '" alt="' . $query->product->name . '" width="50" height="50">';
            })
            ->addColumn('rating', function($query){
                return $query->rating . ' Star';
            })
          ->addColumn('status', function ($query) {
                if ($query->status === 1) {
                    return '<span class="badge bg-green-lt">Approved</span>';
                } else if ($query->status == 0) {
                    return '<span class="badge bg-danger-lt">Pending</span>';
                }
            })
            ->rawColumns(['product_image', 'status', 'product'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Review>
     */
    public function query(Review $model): QueryBuilder
    {
        return $model->where('user_id', Auth::user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('reviews-table')
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
            Column::make('product'),
             Column::make('product_image'),
        
            Column::make('review'),
            Column::make('rating'),
            Column::make('status'),
        
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Reviews_' . date('YmdHis');
    }
}
