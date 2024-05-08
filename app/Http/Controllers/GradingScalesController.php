<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GradingScale;
use App\Models\MatricType;
use App\Models\Subject;
use Illuminate\Http\Request;
use Exception;

class GradingScalesController extends Controller
{

    /**
     * Display a listing of the grading scales.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $gradingScales = GradingScale::with('matrictype','subject')->paginate(25);

        return view('grading_scales.index', compact('gradingScales'));
    }

    /**
     * Show the form for creating a new grading scale.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $matricTypes = MatricType::pluck('matric_type','id')->all();
$subjects = Subject::pluck('id','id')->all();
        
        return view('grading_scales.create', compact('matricTypes','subjects'));
    }

    /**
     * Store a new grading scale in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            GradingScale::create($data);

            return redirect()->route('grading_scales.grading_scale.index')
                ->with('success_message', 'Grading Scale was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified grading scale.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $gradingScale = GradingScale::with('matrictype','subject')->findOrFail($id);

        return view('grading_scales.show', compact('gradingScale'));
    }

    /**
     * Show the form for editing the specified grading scale.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $gradingScale = GradingScale::findOrFail($id);
        $matricTypes = MatricType::pluck('matric_type','id')->all();
$subjects = Subject::pluck('id','id')->all();

        return view('grading_scales.edit', compact('gradingScale','matricTypes','subjects'));
    }

    /**
     * Update the specified grading scale in the storage.
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
            
            $gradingScale = GradingScale::findOrFail($id);
            $gradingScale->update($data);

            return redirect()->route('grading_scales.grading_scale.index')
                ->with('success_message', 'Grading Scale was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified grading scale from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $gradingScale = GradingScale::findOrFail($id);
            $gradingScale->delete();

            return redirect()->route('grading_scales.grading_scale.index')
                ->with('success_message', 'Grading Scale was successfully deleted.');
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
                'matric_type_id' => 'nullable',
            'subject_id' => 'nullable',
            'symbol' => 'string|min:1|nullable',
            'points' => 'string|min:1|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
