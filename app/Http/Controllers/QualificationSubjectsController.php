<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Qualification;
use App\Models\QualificationSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Exception;

class QualificationSubjectsController extends Controller
{

    /**
     * Display a listing of the qualification subjects.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $qualificationSubjects = QualificationSubject::with('qualification','subject')->paginate(25);

        return view('qualification_subjects.index', compact('qualificationSubjects'));
    }

    /**
     * Show the form for creating a new qualification subject.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $qualifications = Qualification::pluck('qualification_name','id')->all();
$subjects = Subject::pluck('id','id')->all();
        
        return view('qualification_subjects.create', compact('qualifications','subjects'));
    }

    /**
     * Store a new qualification subject in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            QualificationSubject::create($data);

            return redirect()->route('qualification_subjects.qualification_subject.index')
                ->with('success_message', 'Qualification Subject was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified qualification subject.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $qualificationSubject = QualificationSubject::with('qualification','subject')->findOrFail($id);

        return view('qualification_subjects.show', compact('qualificationSubject'));
    }

    /**
     * Show the form for editing the specified qualification subject.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $qualificationSubject = QualificationSubject::findOrFail($id);
        $qualifications = Qualification::pluck('qualification_name','id')->all();
$subjects = Subject::pluck('id','id')->all();

        return view('qualification_subjects.edit', compact('qualificationSubject','qualifications','subjects'));
    }

    /**
     * Update the specified qualification subject in the storage.
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
            
            $qualificationSubject = QualificationSubject::findOrFail($id);
            $qualificationSubject->update($data);

            return redirect()->route('qualification_subjects.qualification_subject.index')
                ->with('success_message', 'Qualification Subject was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified qualification subject from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $qualificationSubject = QualificationSubject::findOrFail($id);
            $qualificationSubject->delete();

            return redirect()->route('qualification_subjects.qualification_subject.index')
                ->with('success_message', 'Qualification Subject was successfully deleted.');
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
            'subject_id' => 'nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
