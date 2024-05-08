<?php

namespace App\DataTables;

use App\Models\Registration;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ModuleRegistrationDataTable extends DataTable
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
            ->editColumn('student_number', function ($query) {
                
                return $query->userInfo->student_number ?? '';
            })
            ->filterColumn('student_number', function ($query, $keyword) {
                $query->whereHas('userInfo', function ($query) use ($keyword) {
                    $query->where('student_number', 'like', '%' . $keyword . '%');
                });
            })
            ->editColumn('student_name', function ($query) {
                $first_name = $query->userInfo->first_names ?? '';

                $surname = $query->userInfo->surname ?? '';

                return $first_name.' '. $surname;
            })
            ->filterColumn('student_name', function ($query, $keyword) {
                $query->whereHas('userInfo', function ($query) use ($keyword) {
                    $query->where('first_names', 'like', '%' . $keyword . '%')
                        ->orWhere('surname', 'like', '%' . $keyword . '%');
                });
            })
            
            ->editColumn('year', function ($query) {
                return $query->academicYear->name;
            })
            ->filterColumn('year', function ($query, $keyword) {
                $query->whereHas('academicYear', function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->editColumn('qualification', function ($query) {
                return $query->qualification->qualification_name;
            })
            ->filterColumn('qualification', function ($query, $keyword) {
                $query->whereHas('qualification', function ($query) use ($keyword) {
                    $query->where('qualification_name', 'like', '%' . $keyword . '%');
                });
            })
            ->editColumn('campus', function ($query) {
                return $query->campus->name;
            })
            ->filterColumn('campus', function ($query, $keyword) {
                $query->whereHas('campus', function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->editColumn('registration_status', function ($query) {
                return $query->registrationStatus->status;
            })
            ->filterColumn('registration_status', function ($query, $keyword) {
                $query->whereHas('registrationStatus', function ($query) use ($keyword) {
                    $query->where('status', 'like', '%' . $keyword . '%');
                });
            })
            ->editColumn('created_at', function ($data) {
                $formatedDate = date('d M Y', strtotime($data->created_at));
                return $formatedDate;
            })
            ->addColumn('modules', function ($query) {
                return $query->modules->count();
    
            })
            ->editColumn('action', function ($registration) {
                
                return view('pages.registration.modules._actions', compact('registration'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ModuleRegistration $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Registration $model)
    {
        return $model
                ->newQuery()
                ->with('userInfo', 'academicYear', 'academicIntake', 'campus', 'studyMode', 'qualification', 'modules', 'registrationStatus')
                ->select('registrations.*')
                ->orderBy('created_at', 'desc');

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('kt_datatable_horizontal_scroll')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->stateSave(false)
                    ->orderBy(6)
                    ->responsive()
                    ->autoWidth(true)
                    ->parameters([
                        'scrollX' => true,
                        'drawCallback' => 'function() { KTMenu.createInstances(); }'
                    ])
                    ->addTableClass('table table-striped table-row-bordered gy-5 gs-7');
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
            Column::make('student_name'),
            Column::make('year'),
            Column::make('qualification'),
            Column::make('campus'),
            Column::make('registration_status'),
            Column::make('created_at')->title('Registration Date'),
            Column::make('modules')->title('Modules Count'),
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
        return 'ModuleRegistration_' . date('YmdHis');
    }
}
