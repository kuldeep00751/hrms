<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use Illuminate\Http\Request;
use Exception;

class CampusesController extends Controller
{

    /**
     * Display a listing of the campuses.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $campuses = Campus::paginate(25);

        return view('pages.settings.campuses.index', compact('campuses'));
    }

    /**
     * Show the form for creating a new campus.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('pages.settings.campuses.create');
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
            
            Campus::create($data);

            return redirect()->route('campuses.campus.index')
                ->with('success_message', 'Campus was successfully added.');
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
        $campus = Campus::findOrFail($id);

        return view('pages.settings.campuses.show', compact('campus'));
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
        $campus = Campus::findOrFail($id);
        

        return view('pages.settings.campuses.edit', compact('campus'));
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
            
            $campus = Campus::findOrFail($id);
            $campus->update($data);

            return redirect()->route('campuses.campus.index')
                ->with('success_message', 'Campus was successfully updated.');
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
            $campus = Campus::findOrFail($id);
            $campus->delete();

            return redirect()->route('campuses.campus.index')
                ->with('success_message', 'Campus was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateStatus(Request $request)
    {

        $campus = Campus::find($request->id);

        $campus->active = $request->active;

        $campus->save();

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
            'address_line_1' => 'string|min:1|required',
            'address_line_2' => 'string|min:1|nullable',
            'address_line_3' => 'string|min:1|nullable',
            'bank_name' => 'string|min:1|nullable',
            'account_number' => 'numeric|min:1|nullable',
            'branch_name' => 'string|min:1|nullable',
            'branch_code' => 'string|min:1|nullable',
            'swift_code' => 'string|min:1|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
