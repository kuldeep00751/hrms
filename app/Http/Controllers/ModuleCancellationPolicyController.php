<?php

namespace App\Http\Controllers;

use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\ModuleCancellationPolicy;
use App\Models\StudyPeriod;
use Exception;
use Illuminate\Http\Request;

class ModuleCancellationPolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the education systems.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {

        $moduleCancellationPolicies = ModuleCancellationPolicy::with('academicYear', 'studyPeriod', 'academicIntake')->paginate(25);

        return view('pages.settings.module_cancellation_policies.index', compact('moduleCancellationPolicies'));
    }

    /**
     * Show the form for creating a new education system.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $studyPeriods = StudyPeriod::pluck('study_period', 'id')->all();

        return view('pages.settings.module_cancellation_policies.create', compact('academicYears', 'studyPeriods', 'academicIntakes'));
    }

    /**
     * Store a new education system in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            ModuleCancellationPolicy::create($data);

            return redirect()->route('module_cancellation_policies.module_cancellation_policy.index')
            ->with('success_message', 'Module Cancellation Policy was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified education system.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $moduleCancellationPolicy = ModuleCancellationPolicy::with('academicYear', 'studyPeriod', 'academicIntake')->findOrFail($id);

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $studyPeriods = StudyPeriod::pluck('study_period', 'id')->all();

        return view('pages.settings.module_cancellation_policies.edit', compact('moduleCancellationPolicy', 'academicYears', 'studyPeriods', 'academicIntakes'));
    }

    /**
     * Update the specified education system in the storage.
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
            
            $moduleCancellationPolicy = ModuleCancellationPolicy::findOrFail($id);
            
            $moduleCancellationPolicy->update($data);

            return redirect()->route('module_cancellation_policies.module_cancellation_policy.index')
            ->with('success_message', 'Module cancellation policy was successfully updated.');
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
            'academic_year_id' => 'required',
            'academic_intake_id' => 'required',
            'study_period_id' => 'required',
            'date_from' => 'date|required',
            'date_to' => 'date|required',
            'cancellation_percentage' => 'required|between:0,100.00',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
