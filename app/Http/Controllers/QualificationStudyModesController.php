<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Qualification;
use App\Models\QualificationStudyMode;
use App\Models\StudyMode;
use Illuminate\Http\Request;
use Exception;

class QualificationStudyModesController extends Controller
{

    /**
     * Display a listing of the qualification study modes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $qualificationStudyModes = QualificationStudyMode::with('qualification','studymode')->paginate(25);

        return view('qualification_study_modes.index', compact('qualificationStudyModes'));
    }

    /**
     * Show the form for creating a new qualification study mode.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $qualifications = Qualification::pluck('qualification_name','id')->all();
$studyModes = StudyMode::pluck('id','id')->all();
        
        return view('qualification_study_modes.create', compact('qualifications','studyModes'));
    }

    /**
     * Store a new qualification study mode in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            QualificationStudyMode::create($data);

            return redirect()->route('qualification_study_modes.qualification_study_mode.index')
                ->with('success_message', 'Qualification Study Mode was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified qualification study mode.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $qualificationStudyMode = QualificationStudyMode::with('qualification','studymode')->findOrFail($id);

        return view('qualification_study_modes.show', compact('qualificationStudyMode'));
    }

    /**
     * Show the form for editing the specified qualification study mode.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $qualificationStudyMode = QualificationStudyMode::findOrFail($id);
        $qualifications = Qualification::pluck('qualification_name','id')->all();
$studyModes = StudyMode::pluck('id','id')->all();

        return view('qualification_study_modes.edit', compact('qualificationStudyMode','qualifications','studyModes'));
    }

    /**
     * Update the specified qualification study mode in the storage.
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
            
            $qualificationStudyMode = QualificationStudyMode::findOrFail($id);
            $qualificationStudyMode->update($data);

            return redirect()->route('qualification_study_modes.qualification_study_mode.index')
                ->with('success_message', 'Qualification Study Mode was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified qualification study mode from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $qualificationStudyMode = QualificationStudyMode::findOrFail($id);
            $qualificationStudyMode->delete();

            return redirect()->route('qualification_study_modes.qualification_study_mode.index')
                ->with('success_message', 'Qualification Study Mode was successfully deleted.');
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
                'qualification_id' => 'nullable',
            'study_mode_id' => 'nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
