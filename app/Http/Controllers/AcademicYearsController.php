<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Exception;

class AcademicYearsController extends Controller
{

    /**
     * Display a listing of the academic years.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $academicYears = AcademicYear::paginate(25);

        return view('pages.settings.academic_years.index', compact('academicYears'));
    }

    /**
     * Show the form for creating a new academic year.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('pages.settings.academic_years.create');
    }

    /**
     * Store a new academic year in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            AcademicYear::create($data);

            return redirect()->route('academic_years.academic_year.index')
                ->with('success_message', 'Academic Year was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified academic year.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        return view('pages.settings.academic_years.show', compact('academicYear'));
    }

    /**
     * Show the form for editing the specified academic year.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        

        return view('pages.settings.academic_years.edit', compact('academicYear'));
    }

    /**
     * Update the specified academic year in the storage.
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
            
            $academicYear = AcademicYear::findOrFail($id);
            $academicYear->update($data);

            return redirect()->route('academic_years.academic_year.index')
                ->with('success_message', 'Academic Year was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified academic year from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $academicYear = AcademicYear::findOrFail($id);
            $academicYear->delete();

            return redirect()->route('academic_years.academic_year.index')
                ->with('success_message', 'Academic Year was successfully deleted.');
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
            'name' => 'string|min:1|max:255|required',
            'start' => 'date|required',
            'end' => 'date|required|after:start', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
