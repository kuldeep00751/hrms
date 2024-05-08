<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudentType;
use Illuminate\Http\Request;
use Exception;

class StudentTypesController extends Controller
{

    /**
     * Display a listing of the student types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $studentTypes = StudentType::paginate(25);

        return view('pages.settings.student_types.index', compact('studentTypes'));
    }

    /**
     * Show the form for creating a new student type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('pages.settings.student_types.create');
    }

    /**
     * Store a new student type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            StudentType::create($data);

            return redirect()->route('student_types.student_type.index')
                ->with('success_message', 'Student Type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified student type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $studentType = StudentType::findOrFail($id);

        return view('pages.settings.student_types.show', compact('studentType'));
    }

    /**
     * Show the form for editing the specified student type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $studentType = StudentType::findOrFail($id);
        

        return view('pages.settings.student_types.edit', compact('studentType'));
    }

    /**
     * Update the specified student type in the storage.
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
            
            $studentType = StudentType::findOrFail($id);
            $studentType->update($data);

            return redirect()->route('student_types.student_type.index')
                ->with('success_message', 'Student Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified student type from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $studentType = StudentType::findOrFail($id);
            $studentType->delete();

            return redirect()->route('student_types.student_type.index')
                ->with('success_message', 'Student Type was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    public function updateStatus(Request $request)
    {

        $studentType = StudentType::find($request->id);

        $studentType->active = $request->active;

        $studentType->save();

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
                'student_type' => 'string|min:1|required', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
