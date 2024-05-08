<?php

namespace App\Http\Controllers;

use App\Models\PdfTemplate;
use Exception;
use Illuminate\Http\Request;
use Storage;

class CommunicationLetterTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $documentTemplates = PdfTemplate::all();

        return view('pages.communication.templates.index', compact('documentTemplates'));
    }

    /**
     * Show the form for creating a new qualification.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
       
        return view('pages.communication.templates.create');
    }

    /**
     * Store a new qualification in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            $fileName = $request->file('template')->getClientOriginalName();
            
            $data['template_path'] = $request->file('template')->storeAs('templates', $fileName,'public');

            $documentTemplate = PdfTemplate::create($data);

            return redirect()->route('communication.pdf-template.index')
            ->with('success_message', 'Template was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Show the form for creating a new qualification.
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $documentTemplate = PdfTemplate::findOrFail($id);

        return view('pages.communication.templates.edit', compact('documentTemplate'));
    }

    public function update(Request $request, $id)
    {
        try {

            $data = $this->getData($request);
            
            $documentTemplate = PdfTemplate::findOrFail($id);

            if($request->hasFile('template')){
                $fileName = $request->file('template')->getClientOriginalName();

                $data['template_path'] = $request->file('template')->storeAs('templates', $fileName, 'public');
            }

            $documentTemplate->update($data);

            return redirect()->route('communication.pdf-template.index')
            ->with('success_message', 'Template was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified qualification from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $documentTemplate = PdfTemplate::findOrFail($id);
            
            Storage::delete($documentTemplate->template_path);
            
            $documentTemplate->delete();

            return redirect()->route('communication.pdf-template.index')
            ->with('success_message', 'Template was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified qualification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $documentTemplate = PdfTemplate::findOrFail($id);

        return view('pages.communication.templates.show', compact('documentTemplate'));
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
            'name' => 'string|min:1|required',
            'template_path' => 'nullable',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
