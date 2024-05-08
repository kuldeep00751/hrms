<?php

namespace App\Http\Controllers;

use App\Models\StudentChargeType;
use Exception;
use Illuminate\Http\Request;

class StudentChargeTypeController extends Controller
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

        $studentChargeTypes = StudentChargeType::paginate(25);

        return view('pages.settings.student_charge_types.index', compact('studentChargeTypes'));
    }

    /**
     * Show the form for creating a new education system.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $statusTypes = [
            1 => 'Active',
            0 => 'Not Active'
        ];

        return view('pages.settings.student_charge_types.create', compact('statusTypes'));
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

            StudentChargeType::create($data);

            return redirect()->route('student_charge_types.student_charge_type.index')
            ->with('success_message', 'Student Charge Type was successfully added.');
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
        $studentChargeType = StudentChargeType::findOrFail($id);

        return view('pages.settings.student_charge_types.show', compact('studentChargeType'));
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
        $studentChargeType = StudentChargeType::findOrFail($id);

        $statusTypes = [
            1 => 'Active',
            0 => 'Not Active'
        ];

        return view('pages.settings.student_charge_types.edit', compact('studentChargeType', 'statusTypes'));
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

            $studentChargeType = StudentChargeType::findOrFail($id);

            $studentChargeType->update($data);

            return redirect()->route('student_charge_types.student_charge_type.index')
            ->with('success_message', 'Student Charge was successfully updated.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateStatus(Request $request)
    {

        $studentChargeType = StudentChargeType::find($request->id);

        $studentChargeType->status = $request->status;

        $studentChargeType->save();

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
            'status' => 'numeric|required',
            'charge_type' => 'string|min:1|required',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
