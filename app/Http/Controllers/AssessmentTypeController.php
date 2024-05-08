<?php

namespace App\Http\Controllers;

use App\Models\AssessmentType;
use Exception;
use Illuminate\Http\Request;

class AssessmentTypeController extends Controller
{
    /**
     * Display a listing of the study modes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $assessmentTypes = AssessmentType::paginate(25);

        return view('pages.settings.assessment_types.index', compact('assessmentTypes'));
    }

    /**
     * Show the form for creating a new study mode.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        $requiredOptions = [
            '1' => "Yes",
            '0' => "No",
        ];

        return view('pages.settings.assessment_types.create', compact('requiredOptions'));
    }

    /**
     * Store a new study mode in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            AssessmentType::create($data);

            return redirect()->route('assessment_types.assessment_type.index')
                ->with('success_message', 'Assessment Type was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified study mode.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $assessmentType = AssessmentType::findOrFail($id);

        return view('pages.settings.assessment_types.show', compact('assessmentType'));
    }

    /**
     * Show the form for editing the specified study mode.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $assessmentType = AssessmentType::findOrFail($id);

        $requiredOptions = [
            '1' => "Yes",
            '0' => "No",
        ];

        return view('pages.settings.assessment_types.edit', compact('assessmentType', 'requiredOptions'));
    }

    /**
     * Update the specified study mode in the storage.
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

            $assessmentType = AssessmentType::findOrFail($id);
            $assessmentType->update($data);

            return redirect()->route('assessment_types.assessment_type.index')
                ->with('success_message', 'Assessment Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified study mode from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $assessmentType = AssessmentType::findOrFail($id);
            $assessmentType->delete();

            return redirect()->route('assessment_types.assessment_type.index')
                ->with('success_message', 'Assessment Type was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateStatus(Request $request)
    {

        $assessmentType = AssessmentType::find($request->id);

        $assessmentType->active = $request->active;

        $assessmentType->save();

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
            'assessment_type' => 'string|min:1|required',
            'assessment_type_code' => 'string|min:1|required',
            'default' => 'required',
            'maximum_mark' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }

}
