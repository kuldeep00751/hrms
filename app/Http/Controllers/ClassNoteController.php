<?php

namespace App\Http\Controllers;

use App\Models\ClassNote;
use App\Models\Module;
use Exception;
use Illuminate\Http\Request;
use Storage;

class ClassNoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($moduleId){

        $module = Module::find($moduleId);

        $classNotes = ClassNote::with('module', 'uploadedBy')->where('module_id', $moduleId)->get();

        return view('pages.assessments.my_modules.class_notes.show', compact('classNotes', 'module'));
    }

    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            $path = $request->file('document')->store('class-notes');

            $data['document_name'] = $path;

            ClassNote::create($data);

            return redirect()->route('assessments.my_modules.class_notes', $data['module_id'])
            ->with('success_message', 'Class note was successfully updated.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function changePublishStatus(Request $request){
        $classNote = ClassNote::find($request->id);

        $classNote->published = $request->published;

        $classNote->save();

        return response()->json(array('success_message' => 'Status was successfully added.'), 200);
    }

    public function download($id){
        $classNote = ClassNote::find($id);

        return Storage::download($classNote->document_name, $classNote->description.".pdf");

    }

    public function delete($id){
        $classNote = ClassNote::find($id);

        Storage::delete($classNote->document_name);

        $classNote->delete();

        return redirect()->back()->with('success_message', 'Class note was successfully deleted.');

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
            'module_id' => 'numeric|required',
            'description' => 'required',
            'published' => 'required',
            'uploaded_by' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
