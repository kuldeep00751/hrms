<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use Exception;
use Illuminate\Http\Request;

class MaritalStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the study modes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $maritalStatuses = MaritalStatus::all();

        return view('pages.settings.marital_statuses.index', compact('maritalStatuses'));
    }

    /**
     * Show the form for creating a new study mode.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {


        return view('pages.settings.marital_statuses.create');
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

            MaritalStatus::create($data);

            return redirect()->route('marital_statuses.marital_status.index')
                ->with('success_message', 'Marital Status was successfully added.');
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
        $maritalStatus = MaritalStatus::findOrFail($id);

        return view('pages.settings.marital_statuses.show', compact('maritalStatus'));
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
        $maritalStatus = MaritalStatus::findOrFail($id);


        return view('pages.settings.marital_statuses.edit', compact('maritalStatus'));
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

            $maritalStatus = MaritalStatus::findOrFail($id);
            $maritalStatus->update($data);

            return redirect()->route('marital_statuses.marital_status.index')
                ->with('success_message', 'Marital Status was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    

    public function updateStatus(Request $request)
    {
        $studyMode = MaritalStatus::find($request->id);

        $studyMode->active = $request->active;

        $studyMode->save();

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
            'marital_status' => 'string|min:1|required',
        ];

        $data = $request->validate($rules);

        return $data;
    }

}
