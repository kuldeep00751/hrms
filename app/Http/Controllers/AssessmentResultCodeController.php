<?php

namespace App\Http\Controllers;

use App\Models\AssessmentResultCode;
use Exception;
use Illuminate\Http\Request;

class AssessmentResultCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the education systems.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {

        $assessmentResultCodes = AssessmentResultCode::paginate(25);

        return view('pages.settings.assessment_result_codes.index', compact('assessmentResultCodes'));
    }

    /**
     * Show the form for creating a new education system.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        $passFailOptions = [
            'P' => 'Pass',
            'F' => 'Fail',
        ];

        return view('pages.settings.assessment_result_codes.create', compact('passFailOptions'));
    }

    /**
     * Store a new education system in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        try {

            $data = $this->getData($request);

            AssessmentResultCode::create($data);

            return redirect()->route('assessment_result_codes.assessment_result_code.index')
            ->with('success_message', 'Result code was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified education system.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $assessmentResultCode = AssessmentResultCode::findOrFail($id);

        return view('pages.settings.assessment_result_codes.show', compact('assessmentResultCode'));
    }

    public function updateStatus(Request $request)
    {

        $assessmentResultCode = AssessmentResultCode::find($request->id);

        $assessmentResultCode->active = $request->active;

        $assessmentResultCode->save();

        return response()->json(array('success_message' => 'Status was successfully added.'), 200);
    }

    /**
     * Show the form for editing the specified education system.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $assessmentResultCode = AssessmentResultCode::findOrFail($id);

        $passFailOptions = [
            'P' => 'Pass',
            'F' => 'Fail',
        ];

        return view('pages.settings.assessment_result_codes.edit', compact('assessmentResultCode', 'passFailOptions'));
    }

    /**
     * Update the specified education system in the storage.
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

            $assessmentResultCode = AssessmentResultCode::findOrFail($id);

            $assessmentResultCode->update($data);

            return redirect()->route('assessment_result_codes.assessment_result_code.index')
            ->with('success_message', 'Result code was successfully updated.');
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
            'result_code' => 'required',
            'result_code_description' => 'required',
            'pass_fail' => 'required',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
