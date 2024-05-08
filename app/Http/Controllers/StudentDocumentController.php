<?php

namespace App\Http\Controllers;

use App\Models\RequiredDocument;
use App\Models\StudentDocument;
use Exception;
use Illuminate\Http\Request;
use Storage;

class StudentDocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $info = auth()->user()->info;
        
        $studentDocuments = StudentDocument::where('user_info_id', $info->id)->get();
        
        $requiredDocuments = RequiredDocument::all();

        return view('pages.student.documents.index', compact('info', 'studentDocuments', 'requiredDocuments'));
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

            $path = $request->file('document')->store('student-documents');

            $data['document_path'] = $path;

            $studentDocument = StudentDocument::where('required_document_id', $data['required_document_id'])
                                                ->where('user_info_id', $data['user_info_id'])
                                                ->first();

            if($studentDocument){
                Storage::delete($studentDocument->document_path);

                StudentDocument::where('required_document_id', $data['required_document_id'])
                                ->where('user_info_id', $data['user_info_id'])
                                ->delete();
            }

            StudentDocument::create($data);

            return redirect()->back()
            ->with('success_message', 'Document was successfully added.');
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
            'required_document_id' => 'required',
            'user_info_id' => 'required',
            'document' => 'file|required',
        ];

        $data = $request->validate($rules);

        return $data;
    }

}
