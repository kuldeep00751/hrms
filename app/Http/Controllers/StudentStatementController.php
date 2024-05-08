<?php

namespace App\Http\Controllers;

use App\Models\Lov;
use App\Models\StudentAccount;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentStatementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.finance.student_statement.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        
        if(isset($request->student_number)){
            $userInfo = UserInfo::where('student_number', $request->student_number)->first();

            if(!$userInfo){
                return redirect()
                        ->back()
                        ->withErrors(['unexpected_error' => 'The student number or ID provided is not correct']);
            }

            $studentAccounts = StudentAccount::where('user_info_id', $userInfo->id)
                                            ->orderBy('created_at')
                                            ->get();

            $latestQualification = $this->getStudentLatestQualification($userInfo->id);

            return view('pages.finance.student_statement.show', compact('studentAccounts', 'userInfo', 'latestQualification'));
        }

        if (isset($request->id_number)) {
            $userInfo = UserInfo::where('id_number', $request->id_number)->first();

            if (!$userInfo) {
                return redirect()
                    ->back()
                    ->withErrors(['unexpected_error' => 'The student number or ID provided is not correct']);
            }

            $studentAccounts = StudentAccount::where('user_info_id', $userInfo->id)->get();

            $latestQualification = $this->getStudentLatestQualification($userInfo->id);

            return view('pages.finance.student_statement.show', compact('studentAccounts', 'userInfo', 'latestQualification'));
        }

        return redirect()
            ->back()
            ->withErrors(['unexpected_error' => 'The student number or id number is required.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $lov = Lov::all();

        $studentAccounts = StudentAccount::where('user_info_id', $id)
            ->orderBy('created_at')
            ->get();

        $userInfo = UserInfo::find($id);

        $latestQualification = $this->getStudentLatestQualification($userInfo->id);

        return view('pages.finance.student_statement.print', compact('studentAccounts', 'userInfo', 'lov', 'latestQualification'));
    }

    private function getStudentLatestQualification($userInfoId){

        return UserInfo::select('qualifications.qualification_name', 'qualifications.qualification_code')
                    ->join('registrations', 'user_infos.id', '=', 'registrations.user_info_id')
                    ->join('qualifications', 'registrations.qualification_id', '=', 'qualifications.id')
                    ->where('user_infos.id', $userInfoId)
                    ->whereIn('registrations.created_at', function ($query) {
                        $query->select(DB::raw('MAX(created_at)'))
                        ->from('registrations')
                        ->whereRaw('registrations.user_info_id = user_infos.id')
                        ->groupBy('user_info_id');
                    })
                    ->first();
    }
}
