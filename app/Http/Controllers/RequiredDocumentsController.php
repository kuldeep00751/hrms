<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RequiredDocument;
use Illuminate\Http\Request;
use Exception;

class RequiredDocumentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the required documents.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $requiredDocuments = RequiredDocument::paginate(25);

        return view('pages.settings.required_documents.index', compact('requiredDocuments'));
    }

    /**
     * Show the form for creating a new required document.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $isRequiredOptions = [
            1 => 'Yes',
            0 => 'No'
        ];
        
        return view('pages.settings.required_documents.create', compact('isRequiredOptions'));
    }

    /**
     * Store a new required document in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            RequiredDocument::create($data);

            return redirect()->route('required_documents.required_document.index')
                ->with('success_message', 'Required Document was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified required document.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $requiredDocument = RequiredDocument::findOrFail($id);

        return view('pages.settings.required_documents.show', compact('requiredDocument'));
    }

    /**
     * Show the form for editing the specified required document.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $requiredDocument = RequiredDocument::findOrFail($id);
        

        return view('pages.settings.required_documents.edit', compact('requiredDocument'));
    }

    /**
     * Update the specified required document in the storage.
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
            
            $requiredDocument = RequiredDocument::findOrFail($id);
            $requiredDocument->update($data);

            return redirect()->route('required_documents.required_document.index')
                ->with('success_message', 'Required Document was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified required document from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $requiredDocument = RequiredDocument::findOrFail($id);
            $requiredDocument->delete();

            return redirect()->route('required_documents.required_document.index')
                ->with('success_message', 'Required Document was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateStatus(Request $request)
    {

        $requiredDocument = RequiredDocument::find($request->id);

        $requiredDocument->active = $request->active;

        $requiredDocument->save();

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
                'document_name' => 'string|min:1|nullable',
                'is_required' => 'boolean|nullable', 
        ];
        
        $data = $request->validate($rules);

        $data['is_required'] = $request->has('is_required');

        return $data;
    }

}
