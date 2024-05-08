<?php

namespace App\Http\Controllers;

use App\Actions\CopyFees;
use App\Models\AcademicYear;
use App\Models\AssessmentType;
use App\Models\Module;
use App\Models\StudentType;
use App\Models\SubjectFee;
use Exception;
use Illuminate\Http\Request;

class SubjectFeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the campuses.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $subjectFees = SubjectFee::with('studentType', 'academicYear', 'module', 'assessmentType')->get();

        return view('pages.settings.subject_fees.index', compact('subjectFees'));
    }

    /**
     * Show the form for creating a new campus.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();
        
        $studentTypes = StudentType::where('active', 1)->pluck('student_type', 'id')->all();

        $assessmentTypes = AssessmentType::where('active',1)->pluck('assessment_type', 'id')->all();

        return view('pages.settings.subject_fees.create', compact('modules', 'academicYears', 'studentTypes', 'assessmentTypes'));
    }

    /**
     * Store a new campus in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            SubjectFee::create($data);

            return redirect()->route('subjectFees.subjectFee.index')
                ->with('success_message', 'Subject fee was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified campus.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $subjectFee = SubjectFee::findOrFail($id);

        return view('pages.settings.subject_fees.show', compact('subjectFee'));
    }

    /**
     * Show the form for editing the specified campus.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $subjectFee = SubjectFee::findOrFail($id);

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $studentTypes = StudentType::where('active', 1)->pluck('student_type', 'id')->all();

        $assessmentTypes = AssessmentType::where('active',1)->pluck('assessment_type', 'id')->all();

        return view('pages.settings.subject_fees.edit', compact('subjectFee', 'modules', 'academicYears', 'studentTypes', 'assessmentTypes'));
    }

    public function updateStatus(Request $request)
    {

        $subjectFee = SubjectFee::find($request->id);

        $subjectFee->active = $request->active;

        $subjectFee->save();

        return response()->json(array('success_message' => 'Status was successfully added.'), 200);
    }

    /**
     * Update the specified campus in the storage.
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

            $subjectFee = SubjectFee::findOrFail($id);

            $subjectFee->update($data);

            return redirect()->route('subjectFees.subjectFee.index')
                ->with('success_message', 'Subject Fee was successfully updated.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified campus from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $subjectFee = SubjectFee::findOrFail($id);
            $subjectFee->delete();

            return redirect()->route('subjectFees.subjectFee.index')
                ->with('success_message', 'Subject fee was successfully deleted.');
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
            'module_id' => 'required',
            'academic_year_id' => 'required',
            'created_by' => 'required',
            'amount' => 'numeric|required',
            'student_type_id' => 'required',
            'assessment_type_id' => 'required',
            'academic_process' => 'required',
        ];

        $data = $request->validate($rules);


        return $data;
    }

    public function copyForm()
    {
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        return view('pages.settings.subject_fees.copy', compact('academicYears'));
    }

    public function copy(Request $request, CopyFees $copyFees)
    {
        try {
            $copyFees->copy($request, "Subject Fees");

            return redirect()->route('subjectFees.subjectFee.index')
            ->with('success_message', 'Subject fees were successfully copied.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
