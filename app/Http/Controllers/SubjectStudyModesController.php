<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudyMode;
use App\Models\Subject;
use App\Models\SubjectStudyMode;
use Illuminate\Http\Request;
use Exception;

class SubjectStudyModesController extends Controller
{

    /**
     * Display a listing of the subject study modes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $subjectStudyModes = SubjectStudyMode::with('subject','studymode')->paginate(25);

        return view('subject_study_modes.index', compact('subjectStudyModes'));
    }

    /**
     * Show the form for creating a new subject study mode.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $subjects = Subject::pluck('id','id')->all();
$studyModes = StudyMode::pluck('study_mode','id')->all();
        
        return view('subject_study_modes.create', compact('subjects','studyModes'));
    }

    /**
     * Store a new subject study mode in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            SubjectStudyMode::create($data);

            return redirect()->route('subject_study_modes.subject_study_mode.index')
                ->with('success_message', 'Subject Study Mode was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified subject study mode.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $subjectStudyMode = SubjectStudyMode::with('subject','studymode')->findOrFail($id);

        return view('subject_study_modes.show', compact('subjectStudyMode'));
    }

    /**
     * Show the form for editing the specified subject study mode.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $subjectStudyMode = SubjectStudyMode::findOrFail($id);
        $subjects = Subject::pluck('id','id')->all();
$studyModes = StudyMode::pluck('study_mode','id')->all();

        return view('subject_study_modes.edit', compact('subjectStudyMode','subjects','studyModes'));
    }

    /**
     * Update the specified subject study mode in the storage.
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
            
            $subjectStudyMode = SubjectStudyMode::findOrFail($id);
            $subjectStudyMode->update($data);

            return redirect()->route('subject_study_modes.subject_study_mode.index')
                ->with('success_message', 'Subject Study Mode was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified subject study mode from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $subjectStudyMode = SubjectStudyMode::findOrFail($id);
            $subjectStudyMode->delete();

            return redirect()->route('subject_study_modes.subject_study_mode.index')
                ->with('success_message', 'Subject Study Mode was successfully deleted.');
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
            'study_mode_id' => 'nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
