<?php

namespace App\DataTables;

use App\Models\EmailLog;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmailLogsDataTable extends DataTable
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
            ->eloquent($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\EmailLog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(EmailLog $model)
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
                    ->setTableId('emaillogs-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->stateSave(true)
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('Student Number','user_infos.student_number'),
            Column::make('user_infos.first_names', 'First Names'),
            Column::make('letter_name'),
            Column::make('admission_status_id'),
            Column::make('email_logs.created_at', 'Email Sent At'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'EmailLogs_' . date('YmdHis');
    }
}
