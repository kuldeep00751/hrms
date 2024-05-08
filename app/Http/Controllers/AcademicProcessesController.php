<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicIntake;
use App\Models\AcademicProcess;
use App\Models\AcademicProcessType;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Exception;

class AcademicProcessesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the academic processes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        //$academicProcesses = AcademicProcess::with('academicIntake', 'academicYear')->paginate(25);
        $academicProcessTypes = AcademicProcessType::orderBy('process_type')->get();

        return view('pages.settings.academic_processes.index', compact('academicProcessTypes'));
    }

    /**
     * Show the form for creating a new academic process.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $academicProcessType = AcademicProcessType::find($id);

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();
        
        return view('pages.settings.academic_processes.create', compact('academicProcessType', 'academicYears', 'academicIntakes'));
    }

    /**
     * Store a new academic process in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $academicProcess = AcademicProcess::create($data);

            $academicProcessType = AcademicProcessType::where('process_type', $academicProcess->process_name)->first();

            return redirect()->route('academic_processes.academic_process.show', $academicProcessType->id)
                ->with('success_message', 'Academic Process was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified academic process.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $academicProcessType = AcademicProcessType::find($id);

        $academicProcesses = AcademicProcess::where('process_name', $academicProcessType->process_type)->get();

        return view('pages.settings.academic_processes.show', compact('academicProcesses', 'academicProcessType'));
    }

    /**
     * Show the form for editing the specified academic process.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $academicProcess = AcademicProcess::findOrFail($id);
        
        $academicProcessType = AcademicProcessType::where('process_type', $academicProcess->process_name)->first();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();
        
        return view('pages.settings.academic_processes.edit', compact('academicProcess', 'academicProcessType', 'academicIntakes', 'academicYears'));
    }

    /**
     * Update the specified academic process in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $academicProcess = AcademicProcess::findOrFail($id);

            $academicProcess->update($data);

            $academicProcessType = AcademicProcessType::where('process_type', $academicProcess->process_name)->first();

            return redirect()->route('academic_processes.academic_process.show', $academicProcessType->id)
                ->with('success_message', 'Academic Process was successfully updated.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified academic process from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $academicProcess = AcademicProcess::findOrFail($id);
            $academicProcess->delete();

            return redirect()->route('academic_processes.academic_process.index')
                ->with('success_message', 'Academic Process was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        
        $rules = [
            'process_name' => 'string|min:1|required',
            'academic_year_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'academic_intake_id' => 'required',
        ];
        
        $data = $request->validate($rules);

        
        return $data;
    }

}
