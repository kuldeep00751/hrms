<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;
use Exception;

class SchoolSubjectsController extends Controller
{

    /**
     * Display a listing of the school subjects.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $schoolSubjects = SchoolSubject::orderBy('subject_name')->get();

        return view('pages.settings.school_subjects.index', compact('schoolSubjects'));
    }

    /**
     * Show the form for creating a new school subject.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('pages.settings.school_subjects.create');
    }

    /**
     * Store a new school subject in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            SchoolSubject::create($data);

            return redirect()->route('school_subjects.school_subject.index')
                ->with('success_message', 'School Subject was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified school subject.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $schoolSubject = SchoolSubject::findOrFail($id);

        return view('pages.settings.school_subjects.show', compact('schoolSubject'));
    }

    /**
     * Show the form for editing the specified school subject.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $schoolSubject = SchoolSubject::findOrFail($id);
        

        return view('pages.settings.school_subjects.edit', compact('schoolSubject'));
    }

    /**
     * Update the specified school subject in the storage.
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
            
            $schoolSubject = SchoolSubject::findOrFail($id);
            $schoolSubject->update($data);

            return redirect()->route('school_subjects.school_subject.index')
                ->with('success_message', 'School Subject was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified school subject from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $schoolSubject = SchoolSubject::findOrFail($id);
            $schoolSubject->delete();

            return redirect()->route('school_subjects.school_subject.index')
                ->with('success_message', 'School Subject was successfully deleted.');
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
                'subject_name' => 'string|min:1|required', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
