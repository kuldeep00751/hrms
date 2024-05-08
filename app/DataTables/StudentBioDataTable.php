<?php

namespace App\DataTables;

use App\Models\UserInfo;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Illuminate\Support\Collection;
use Yajra\DataTables\Services\DataTable;

class StudentBioDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->order(function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->editColumn('email_address', function (UserInfo $userInfo) {
                    return strtolower($userInfo->email_address);
            })            
            ->editColumn('action', function ($userInfo) {
                return view('pages.applications.user_info._actions', compact('userInfo'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StudentBio $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserInfo $model)
    {
        
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('studentbio-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->stateSave(true)
                    ->orderBy(1)
                    ->responsive()
                    ->autoWidth(false)
                    ->parameters([
                        'scrollX' => true,
                        'drawCallback' => 'function() { KTMenu.createInstances(); }'
                        ])
                    ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('student_number'),
            Column::make('surname'),
            Column::make('first_names'),
            Column::make('date_of_birth'),
            Column::make('id_number'),
            Column::make('mobile_number'),
            Column::make('email_address'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'StudentBio_' . date('YmdHis');
    }
}
