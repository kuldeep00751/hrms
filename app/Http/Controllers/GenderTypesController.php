<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GenderType;
use Illuminate\Http\Request;
use Exception;

class GenderTypesController extends Controller
{

    /**
     * Display a listing of the gender types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $genderTypes = GenderType::paginate(25);

        return view('pages.settings.gender_types.index', compact('genderTypes'));
    }

    /**
     * Show the form for creating a new gender type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('pages.settings.gender_types.create');
    }

    /**
     * Store a new gender type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            GenderType::create($data);

            return redirect()->route('gender_types.gender_type.index')
                ->with('success_message', 'Gender Type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified gender type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $genderType = GenderType::findOrFail($id);

        return view('pages.settings.gender_types.show', compact('genderType'));
    }

    /**
     * Show the form for editing the specified gender type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $genderType = GenderType::findOrFail($id);
        

        return view('pages.settings.gender_types.edit', compact('genderType'));
    }

    /**
     * Update the specified gender type in the storage.
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
            
            $genderType = GenderType::findOrFail($id);
            $genderType->update($data);

            return redirect()->route('gender_types.gender_type.index')
                ->with('success_message', 'Gender Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified gender type from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $genderType = GenderType::findOrFail($id);
            $genderType->delete();

            return redirect()->route('gender_types.gender_type.index')
                ->with('success_message', 'Gender Type was successfully deleted.');
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
                'gender_type' => 'string|min:1|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
