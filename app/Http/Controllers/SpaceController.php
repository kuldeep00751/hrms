<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Space;
use Exception;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    /**
     * Display a listing of the campuses.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $spaces = Space::with('campus')->get();

        return view('pages.settings.spaces.index', compact('spaces'));
    }

    /**
     * Show the form for creating a new campus.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $campuses = Campus::where('active', 1)
                            ->orderBy('name')
                            ->pluck('name', 'id')
                            ->all();

        return view('pages.settings.spaces.create', compact('campuses'));
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

            Space::create($data);

            return redirect()->route('spaces.space.index')
                ->with('success_message', 'Space was successfully added.');
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
        $space = Space::findOrFail($id);

        return view('pages.settings.spaces.show', compact('space'));
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
        $space = Space::findOrFail($id);

        $campuses = Campus::where('active', 1)
                        ->orderBy('name')
                        ->pluck('name', 'id')
                        ->all();


        return view('pages.settings.spaces.edit', compact('space', 'campuses'));
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

            $space = Space::findOrFail($id);

            $space->update($data);

            return redirect()->route('spaces.space.index')
                ->with('success_message', 'Space was successfully updated.');
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
            $space = Space::findOrFail($id);

            $space->delete();

            return redirect()->route('spaces.space.index')
                ->with('success_message', 'Space was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateStatus(Request $request)
    {

        $space = Space::find($request->id);

        $space->active = $request->active;

        $space->save();

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
            'description' => 'string|min:1|required',
            'capacity' => 'integer|min:1|required',
            'campus_id' => 'integer|min:1|required',
        ];

        $data = $request->validate($rules);

        return $data;
    }

}
