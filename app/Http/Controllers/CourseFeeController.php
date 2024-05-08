<?php

namespace App\Http\Controllers;

use App\Actions\CopyFees;
use App\Models\AcademicYear;
use App\Models\CourseFee;
use App\Models\Qualification;
use App\Models\StudentType;
use App\Models\YearLevel;
use Exception;
use Illuminate\Http\Request;

class CourseFeeController extends Controller
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
        $courseFees = CourseFee::with('studentType', 'academicYear', 'qualification')->paginate(25);

        return view('pages.settings.course_fees.index', compact('courseFees'));
    }

    /**
     * Show the form for creating a new campus.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $studentTypes = StudentType::where('active', 1)->pluck('student_type', 'id')->all();

        $yearLevels = YearLevel::pluck('year_level', 'id')->all();

        return view('pages.settings.course_fees.create', compact('qualifications', 'academicYears', 'studentTypes', 'yearLevels'));
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

            $qualification = Qualification::find($data['qualification_id']);

            $yearLevel = YearLevel::find($data['year_level_id']);

            if (intval($yearLevel->year_level) > intval($qualification->number_of_years)) {

                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Invalid Year Level/Qualification combination selected.']);
            }

            CourseFee::create($data);

            return redirect()->route('courseFees.courseFee.index')
                ->with('success_message', 'Course fee was successfully added.');
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
        $courseFee = CourseFee::findOrFail($id);

        return view('pages.settings.course_fees.show', compact('courseFee'));
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
        $courseFee = CourseFee::findOrFail($id);

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $studentTypes = StudentType::where('active', 1)->pluck('student_type', 'id')->all();

        $yearLevels = YearLevel::pluck('year_level', 'id')->all();

        return view('pages.settings.course_fees.edit', compact('courseFee', 'qualifications', 'academicYears', 'studentTypes', 'yearLevels'));
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

            $courseFee = CourseFee::findOrFail($id);

            $qualification = Qualification::find($data['qualification_id']);

            $yearLevel = YearLevel::find($data['year_level_id']);

            if (intval($yearLevel->year_level) > intval($qualification->number_of_years)) {

                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Invalid Year Level/Qualification combination selected.']);
            }

            $courseFee->update($data);

            return redirect()->route('courseFees.courseFee.index')
                ->with('success_message', 'Course Fee was successfully updated.');
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
            $courseFee = CourseFee::findOrFail($id);
            $courseFee->delete();

            return redirect()->route('courseFees.courseFee.index')
                ->with('success_message', 'Course fee was successfully deleted.');
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
            'qualification_id' => 'required',
            'academic_year_id' => 'required',
            'created_by' => 'required',
            'amount' => 'required',
            'student_type_id' => 'required',
            'academic_process' => 'required',
            'year_level_id' => 'required'
        ];

        $data = $request->validate($rules);

        return $data;
    }

    public function copyForm()
    {

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        return view('pages.settings.course_fees.copy', compact('academicYears'));
    }

    public function copy(Request $request, CopyFees $copyFees)
    {   
        try {
            $copyFees->copy($request, "Course Fees");

            return redirect()->route('courseFees.courseFee.index')
            ->with('success_message', 'Course fees were successfully copied.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }

    }
}
