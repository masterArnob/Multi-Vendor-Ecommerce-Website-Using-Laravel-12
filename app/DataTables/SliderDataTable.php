<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Slider> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {

                $edit = '<a href="' . route('admin.slider.edit', $query->id) . '" class="btn btn-warning mx-2">
                        Edit
                      </a>';
                $delete = '<a href="' . route('admin.slider.destroy', $query->id) . '" class="btn btn-danger delete-item">
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


            ->addColumn('banner', function ($query) {
                $imagePath = $query->banner ? asset($query->banner) : 'Banner Not Updated';
                return '<span class="avatar avatar-xl" style="background-image: url(\'' . $imagePath . '\')"></span>';
            })


            ->addColumn('created_by', function ($query) {
                $user = \App\Models\Admin::find($query->created_by);
                $imagePath = $user && $user->image ? asset($user->image) : asset('default-avatar.png');
                return '<span class="avatar avatar-xl" style="background-image: url(' . $imagePath . ')"></span>';
            })

            ->addColumn('created_person_email', function ($query) {
                $admin = \App\Models\Admin::find($query->created_by);
                return $admin ? $admin->email : 'N/A';
            })

            ->rawColumns(['action', 'status', 'banner', 'created_by', 'created_person_email'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Slider>
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('slider-table')
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

            Column::make('id')->width('10'),
            Column::make('banner'),
            Column::make('type'),
            Column::make('title'),
            Column::make('starting_price'),
            Column::make('serial')->width('50'),
            Column::make('created_by'),
            Column::make('created_person_email'),

            Column::make('status'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Slider_' . date('YmdHis');
    }
}
