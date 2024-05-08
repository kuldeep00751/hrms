<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeesDataTable;
use App\Models\Campus;
use App\Models\Country;
use App\Models\Employee;
use App\Models\EmployeeRequiredDocument;
use App\Models\GenderType;
use App\Models\MaritalStatus;
use App\Models\NextOfKinRelationship;
use App\Models\Title;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeesDataTable $dataTable)
    {
        return $dataTable->render('hr.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titles = Title::where('active', 1)->pluck('title', 'id')->all();

        $genderTypes = GenderType::pluck('gender_type', 'id')->all();

        $nextOfKinRelationships = NextOfKinRelationship::where('active', 1)->pluck('relationship', 'id')->all();

        $campus = Campus::pluck('name', 'id')->all();

        $countries = Country::pluck('name', 'id')->all();

        $maritalStatuses = MaritalStatus::pluck('marital_status', 'id')->all();

        $employeeRequiredDocuments = EmployeeRequiredDocument::where('active', 1)->pluck('document_name', 'id')->all();
        
        return view('hr.employees.create', compact('titles', 'genderTypes', 'nextOfKinRelationships', 'campus', 'countries', 'employeeRequiredDocuments', 'maritalStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
