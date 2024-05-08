<?php

namespace App\Http\Controllers;

use App\Models\StudentNoticeBoard;
use App\Models\StudentNoticeBoardAttachment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentNoticeBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the qualifications.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $studentNoticeBoards = StudentNoticeBoard::with('attachments', 'postedBy', 'updatedBy')->orderBy('id', 'desc')->paginate(25);

        return view('pages.portal.notice-board.index', compact('studentNoticeBoards'));
    }

    /**
     * Show the form for creating a new qualification.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $categories = [
            'announcement' => 'Announcement',
            'information' => 'Information',
            'information request' => 'Information Request',
            'lost-and-found' => 'Lost and Found',
            'selling' => 'Selling',
        ];

        $publishedYn = [
            1 => 'Yes',
            0 => 'No'
        ];

        return view('pages.portal.notice-board.create', compact('categories', 'publishedYn'));
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

            $data['posted_by'] = auth()->user()->id;

            $studentNoticeBoards = StudentNoticeBoard::create($data);
            
            if ($request->hasFile('attachments')){
                
                $attachments = $request->file('attachments');
                
                foreach ($attachments as $attachment) {
                    
                    $filename = $attachment->storePublicly('notice-board-attachments', 'public');

                    StudentNoticeBoardAttachment::create([
                        'student_notice_board_id' => $studentNoticeBoards->id,
                        'document_name' => $attachment->getClientOriginalName(),
                        'document_path' => $filename
                    ]);
                }
            }

            return redirect()->route('notice-boards.notice-board.index')
            ->with('success_message', 'Item added on the notice board was successfully added.');
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
        $studentNoticeBoard = StudentNoticeBoard::with('attachments')->find($id);

        return view('pages.portal.notice-board.show', compact('studentNoticeBoard'));
    }

    public function download($id){
        
        $attachment = StudentNoticeBoardAttachment::find($id);

        return Storage::download('public/'.$attachment->document_path, $attachment->document_name);
    }

    public function deleteAttachment($id){

        $attachment = StudentNoticeBoardAttachment::find($id);
        
        

        if (Storage::exists('public/'.$attachment->document_path)) {
            Storage::delete('public/' . $attachment->document_path);
        }

        $attachment->delete();

        return redirect()->back()
        ->with('success_message', 'Attachment successfully deleted.');
    }

    /**
     * Show the form for editing the specified qualification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $studentNoticeBoard = StudentNoticeBoard::with('attachments')->find($id);

        $categories = [
            'announcement' => 'Announcement',
            'information' => 'Information',
            'information request' => 'Information Request',
            'lost-and-found' => 'Lost and Found',
            'selling' => 'Selling',
        ];

        $publishedYn = [
            1 => 'Yes',
            0 => 'No'
        ];

        return view('pages.portal.notice-board.edit', compact('studentNoticeBoard', 'categories', 'publishedYn'));
    }

    /**
     * Update the specified qualification in the storage.
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

            $studentNoticeBoard = StudentNoticeBoard::find($id);

            $data['updated_by'] = auth()->user()->id;

            $studentNoticeBoard->update($data);

            if ($request->hasFile('attachments')) {

                $attachments = $request->file('attachments');

                foreach ($attachments as $attachment) {

                    $filename = $attachment->storePublicly('notice-board-attachments', 'public');

                    StudentNoticeBoardAttachment::create([
                        'student_notice_board_id' => $studentNoticeBoard->id,
                        'document_name' => $attachment->getClientOriginalName(),
                        'document_path' => $filename
                    ]);
                }
            }

            return redirect()->route('notice-boards.notice-board.index')
            ->with('success_message', 'Notice board item was successfully updated.');
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
            'title' => 'string|min:1|required',
            'category' => 'string|min:1|required',
            'short_description' => 'required',
            'full_description' => 'required',
            'published' => '',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
