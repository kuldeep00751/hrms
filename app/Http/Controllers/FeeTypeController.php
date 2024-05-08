<?php

namespace App\Http\Controllers;

use App\Models\FeeType;
use Exception;
use Illuminate\Http\Request;

class FeeTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the campuses.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $feeTypes = FeeType::paginate(25);

        return view('pages.settings.fee_types.index', compact('feeTypes'));
    }

    /**
     * Show the form for creating a new campus.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
       
        return view('pages.settings.fee_types.create');
    }

    /**
     * Store a new campus in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            FeeType::create($data);

            return redirect()->route('feeTypes.feeType.index')
                ->with('success_message', 'Fee type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified campus.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $feeType = FeeType::findOrFail($id);

        return view('pages.settings.fee_types.show', compact('feeType'));
    }

    /**
     * Show the form for editing the specified campus.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $feeType = FeeType::findOrFail($id);

        return view('pages.settings.fee_types.edit', compact('feeType'));
    }

    /**
     * Update the specified campus in the storage.
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

            $feeType = FeeType::findOrFail($id);

            $feeType->update($data);

            return redirect()->route('feeTypes.feeType.index')
                ->with('success_message', 'Fee type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified campus from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $feeType = FeeType::findOrFail($id);
            $feeType->delete();

            return redirect()->route('feeTypes.feeType.index')
                ->with('success_message', 'Fee type was successfully deleted.');
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
            'fee_type_name' => 'required|string'
        ];

        $data = $request->validate($rules);


        return $data;
    }

}
