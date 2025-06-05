<?php

namespace App\DataTables;

use App\Models\ManageUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ManageUsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<ManageUser> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
              ->addColumn('action', function ($query) {
              
                $edit = '<a href="'.route('admin.manage-user.edit', $query->id).'" class="btn btn-warning mx-2">
                        Edit
                      </a>';
                $delete = '<a href="'.route('admin.manage-user.destroy', $query->id).'" class="btn btn-danger delete-item">
                        Delete
                      </a>';

                      return $edit.$delete;
            })


            ->addColumn('user_status', function ($query) {
                if ($query->user_status === 'active') {
                   return '<span class="badge bg-purple-lt">Active</span>';
                } elseif ($query->user_status === 'inactive') {
                     return '<span class="badge bg-orange-lt">Inactive</span>';
                }elseif ($query->user_status === 'banned') {
                     return '<span class="badge bg-danger-lt">Banned</span>';
                }
            })


          
                      ->addColumn('image', function($query) {
    $imagePath = $query->image ? asset($query->image) : 'Image Not Updated';
    return '<span class="avatar avatar-xl" style="background-image: url(\'' . $imagePath . '\')"></span>';
})


            ->rawColumns(['action', 'user_status', 'image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<ManageUser>
     */
    public function query(User $model): QueryBuilder
    {
        return $model->where('role', 'user')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('manageusers-table')
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
            Column::make('user_status'),
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
        return 'ManageUsers_' . date('YmdHis');
    }
}
