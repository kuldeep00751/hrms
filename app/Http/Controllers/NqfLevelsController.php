<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NqfLevel;
use Illuminate\Http\Request;
use Exception;

class NqfLevelsController extends Controller
{

    /**
     * Display a listing of the nqf levels.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $nqfLevels = NqfLevel::paginate(25);

        return view('nqf_levels.index', compact('nqfLevels'));
    }

    /**
     * Show the form for creating a new nqf level.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('nqf_levels.create');
    }

    /**
     * Store a new nqf level in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            NqfLevel::create($data);

            return redirect()->route('nqf_levels.nqf_level.index')
                ->with('success_message', 'Nqf Level was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified nqf level.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $nqfLevel = NqfLevel::findOrFail($id);

        return view('nqf_levels.show', compact('nqfLevel'));
    }

    /**
     * Show the form for editing the specified nqf level.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $nqfLevel = NqfLevel::findOrFail($id);
        

        return view('nqf_levels.edit', compact('nqfLevel'));
    }

    /**
     * Update the specified nqf level in the storage.
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
            
            $nqfLevel = NqfLevel::findOrFail($id);
            $nqfLevel->update($data);

            return redirect()->route('nqf_levels.nqf_level.index')
                ->with('success_message', 'Nqf Level was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified nqf level from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $nqfLevel = NqfLevel::findOrFail($id);
            $nqfLevel->delete();

            return redirect()->route('nqf_levels.nqf_level.index')
                ->with('success_message', 'Nqf Level was successfully deleted.');
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
                'nqf_level' => 'string|min:1|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
