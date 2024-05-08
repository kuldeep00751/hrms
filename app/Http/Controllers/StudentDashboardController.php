<?php

namespace App\Http\Controllers;

use App\Models\StudentNoticeBoard;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $studentInfo = auth()->user()->info;

        if(!$studentInfo){
            return redirect()->route('student.update-biographical');
        }
        
        $studentNoticeBoards = $this->getNoticeBoardItems();

        $isProfileComplete = $this->isProfileComplete($studentInfo);


        return view('pages.student.dashboard.index', compact('studentInfo', 'studentNoticeBoards', 'isProfileComplete'));
    }

    public function showNotice($id)
    {
        $studentNoticeBoard = StudentNoticeBoard::with('attachments')->where('id', $id)->where('published', 1)->first();

        return view('pages.student.dashboard.show', compact('studentNoticeBoard'));
    }

    private function getNoticeBoardItems(){
        return StudentNoticeBoard::where('published', 1)->orderBy('created_at', 'desc')->paginate(25);
    }

    private function isProfileComplete($userInfo){
        if(is_null($userInfo->passport_photo) || 
            is_null($userInfo->title_id) || 
            is_null($userInfo->gender_id) || 
            is_null($userInfo->date_of_birth) || 
            is_null($userInfo->citizenship_status)){
                return false;
            
        } 

        return true;
    }
}
