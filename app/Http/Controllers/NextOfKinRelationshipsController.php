<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NextOfKinRelationship;
use Illuminate\Http\Request;
use Exception;

class NextOfKinRelationshipsController extends Controller
{

    /**
     * Display a listing of the next of kin relationships.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $nextOfKinRelationships = NextOfKinRelationship::paginate(25);

        return view('pages.settings.next_of_kin_relationships.index', compact('nextOfKinRelationships'));
    }

    /**
     * Show the form for creating a new next of kin relationship.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('pages.settings.next_of_kin_relationships.create');
    }

    /**
     * Store a new next of kin relationship in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            NextOfKinRelationship::create($data);

            return redirect()->route('next_of_kin_relationships.next_of_kin_relationship.index')
                ->with('success_message', 'Next Of Kin Relationship was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified next of kin relationship.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $nextOfKinRelationship = NextOfKinRelationship::findOrFail($id);

        return view('pages.settings.next_of_kin_relationships.show', compact('nextOfKinRelationship'));
    }

    /**
     * Show the form for editing the specified next of kin relationship.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $nextOfKinRelationship = NextOfKinRelationship::findOrFail($id);
        

        return view('pages.settings.next_of_kin_relationships.edit', compact('nextOfKinRelationship'));
    }

    /**
     * Update the specified next of kin relationship in the storage.
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
            
            $nextOfKinRelationship = NextOfKinRelationship::findOrFail($id);
            $nextOfKinRelationship->update($data);

            return redirect()->route('next_of_kin_relationships.next_of_kin_relationship.index')
                ->with('success_message', 'Next Of Kin Relationship was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified next of kin relationship from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $nextOfKinRelationship = NextOfKinRelationship::findOrFail($id);
            $nextOfKinRelationship->delete();

            return redirect()->route('next_of_kin_relationships.next_of_kin_relationship.index')
                ->with('success_message', 'Next Of Kin Relationship was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateStatus(Request $request)
    {

        $nextOfKinRelationship = NextOfKinRelationship::find($request->id);

        $nextOfKinRelationship->active = $request->active;

        $nextOfKinRelationship->save();

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
                'relationship' => 'string|min:1|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
