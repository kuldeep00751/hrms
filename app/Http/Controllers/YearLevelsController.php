<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\YearLevel;
use Illuminate\Http\Request;
use Exception;

class YearLevelsController extends Controller
{

    /**
     * Display a listing of the year levels.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $yearLevels = YearLevel::paginate(25);

        return view('pages.settings.year_levels.index', compact('yearLevels'));
    }

    /**
     * Show the form for creating a new year level.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('pages.settings.year_levels.create');
    }

    /**
     * Store a new year level in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            YearLevel::create($data);

            return redirect()->route('year_levels.year_level.index')
                ->with('success_message', 'Year Level was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified year level.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $yearLevel = YearLevel::findOrFail($id);

        return view('pages.settings.year_levels.show', compact('yearLevel'));
    }

    /**
     * Show the form for editing the specified year level.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $yearLevel = YearLevel::findOrFail($id);
        

        return view('pages.settings.year_levels.edit', compact('yearLevel'));
    }

    /**
     * Update the specified year level in the storage.
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
            
            $yearLevel = YearLevel::findOrFail($id);
            $yearLevel->update($data);

            return redirect()->route('year_levels.year_level.index')
                ->with('success_message', 'Year Level was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified year level from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $yearLevel = YearLevel::findOrFail($id);
            $yearLevel->delete();

            return redirect()->route('year_levels.year_level.index')
                ->with('success_message', 'Year Level was successfully deleted.');
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
                'year_level' => 'string|min:1|required', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
