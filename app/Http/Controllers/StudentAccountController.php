<?php

namespace App\Http\Controllers;

use App\Models\StudentAccount;
use Illuminate\Http\Request;

class StudentAccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user_info = auth()->user()->info;

        $studentAccounts = StudentAccount::where('user_info_id', $user_info->id)->get();

        return view('pages.student.account.index', compact('studentAccounts'));
    }
}
