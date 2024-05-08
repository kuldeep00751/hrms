<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicIntake;
use Illuminate\Http\Request;
use Exception;

class AcademicIntakesController extends Controller
{

    /**
     * Display a listing of the academic intakes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $academicIntakes = AcademicIntake::paginate(25);

        return view('pages.settings.academic_intakes.index', compact('academicIntakes'));
    }

    /**
     * Show the form for creating a new academic intake.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('pages.settings.academic_intakes.create');
    }

    /**
     * Store a new academic intake in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            AcademicIntake::create($data);

            return redirect()->route('academic_intakes.academic_intake.index')
                ->with('success_message', 'Academic Intake was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified academic intake.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $academicIntake = AcademicIntake::findOrFail($id);

        return view('pages.settings.academic_intakes.show', compact('academicIntake'));
    }

    /**
     * Show the form for editing the specified academic intake.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $academicIntake = AcademicIntake::findOrFail($id);
        

        return view('pages.settings.academic_intakes.edit', compact('academicIntake'));
    }

    /**
     * Update the specified academic intake in the storage.
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
            
            $academicIntake = AcademicIntake::findOrFail($id);
            $academicIntake->update($data);

            return redirect()->route('academic_intakes.academic_intake.index')
                ->with('success_message', 'Academic Intake was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified academic intake from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $academicIntake = AcademicIntake::findOrFail($id);
            $academicIntake->delete();

            return redirect()->route('academic_intakes.academic_intake.index')
                ->with('success_message', 'Academic Intake was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateStatus(Request $request)
    {

        $academicIntake = AcademicIntake::find($request->id);

        $academicIntake->active = $request->active;

        $academicIntake->save();

        return response()->json(array('success_message' => 'Status was successfully added.'), 200);
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
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
