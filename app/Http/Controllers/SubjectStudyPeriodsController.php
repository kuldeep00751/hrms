<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudyPeriod;
use App\Models\Subject;
use App\Models\SubjectStudyPeriod;
use Illuminate\Http\Request;
use Exception;

class SubjectStudyPeriodsController extends Controller
{

    /**
     * Display a listing of the subject study periods.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $subjectStudyPeriods = SubjectStudyPeriod::with('subject','studyperiod')->paginate(25);

        return view('subject_study_periods.index', compact('subjectStudyPeriods'));
    }

    /**
     * Show the form for creating a new subject study period.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $subjects = Subject::pluck('id','id')->all();
$studyPeriods = StudyPeriod::pluck('id','id')->all();
        
        return view('subject_study_periods.create', compact('subjects','studyPeriods'));
    }

    /**
     * Store a new subject study period in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            SubjectStudyPeriod::create($data);

            return redirect()->route('subject_study_periods.subject_study_period.index')
                ->with('success_message', 'Subject Study Period was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified subject study period.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $subjectStudyPeriod = SubjectStudyPeriod::with('subject','studyperiod')->findOrFail($id);

        return view('subject_study_periods.show', compact('subjectStudyPeriod'));
    }

    /**
     * Show the form for editing the specified subject study period.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $subjectStudyPeriod = SubjectStudyPeriod::findOrFail($id);
        $subjects = Subject::pluck('id','id')->all();
$studyPeriods = StudyPeriod::pluck('id','id')->all();

        return view('subject_study_periods.edit', compact('subjectStudyPeriod','subjects','studyPeriods'));
    }

    /**
     * Update the specified subject study period in the storage.
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
            
            $subjectStudyPeriod = SubjectStudyPeriod::findOrFail($id);
            $subjectStudyPeriod->update($data);

            return redirect()->route('subject_study_periods.subject_study_period.index')
                ->with('success_message', 'Subject Study Period was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified subject study period from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $subjectStudyPeriod = SubjectStudyPeriod::findOrFail($id);
            $subjectStudyPeriod->delete();

            return redirect()->route('subject_study_periods.subject_study_period.index')
                ->with('success_message', 'Subject Study Period was successfully deleted.');
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
                'subject_id' => 'nullable',
            'study_period_id' => 'nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
