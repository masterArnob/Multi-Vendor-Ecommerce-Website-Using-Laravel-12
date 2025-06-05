<?php

namespace App\DataTables;

use App\Models\Admin;
use App\Models\ManageAdmin;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ManageAdminsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<ManageAdmin> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {

                $edit = '<a href="' . route('admin.manage-admin.edit', $query->id) . '" class="btn btn-warning mx-2">
                        Edit
                      </a>';
                $delete = '<a href="' . route('admin.manage-admin.destroy', $query->id) . '" class="btn btn-danger delete-item">
                        Delete
                      </a>';

                       if ($query->id == 1) {
                    return '';
                }

            if (Auth::id() === 1) {
                    return $edit . $delete;
                }

                return $edit;
            })
            ->addColumn('role', function ($query) {
                return $query->id == '1' ? '<span class="badge bg-purple-lt">Super Admin</span>' : '<span class="badge bg-green-lt">Admin</span>';
            })



            ->addColumn('image', function ($query) {
                $imagePath = $query->image ? asset($query->image) : 'Image Not Updated';
                return '<span class="avatar avatar-xl" style="background-image: url(\'' . $imagePath . '\')"></span>';
            })

               ->addColumn('status', function ($query) {
                if ($query->status === 'approved') {
                   return '<span class="badge bg-green-lt">Approved</span>';
                }elseif ($query->status === 'banned') {
                     return '<span class="badge bg-danger-lt">Banned</span>';
                }
            })

            ->rawColumns(['action', 'role', 'image', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<ManageAdmin>
     */
    public function query(Admin $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('manageadmins-table')
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
            Column::make('role'),
            Column::make('created_by'),
            Column::make('created_at'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ManageAdmins_' . date('YmdHis');
    }
}
