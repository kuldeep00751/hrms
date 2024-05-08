<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Exception;
use Hash;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user();

        $userInfo = UserInfo::with('nextOfKin', 'schoolSubjects', 'previousQualification', 'healthQuestionnaire', 'employment', 'educationSystem', 'documents')
                            ->findOrFail($user->info->id);

        $section = 'show';

        return view('pages.student.profile.index', compact('userInfo', 'section'));
    }

    public function updateAccount($id){
        $userInfo = UserInfo::find($id);

        $section = 'account';

        return view('pages.student.profile.update-account', compact('userInfo', 'section'));
    }

    public function updatePassword(Request $request, $id)
    {
        try {
            $userInfo = UserInfo::find($id);

            if (isset($request->email)) {
                $request->validate([
                    'email' => 'string|min:1|required|unique:users,id,' . $userInfo->user_id,
                ]);

                $user = $userInfo->user;

                $user->update(['email' => $request->email]);
                $userInfo->update(['email_address' => $request->email]);
            }

            if (isset($request->password)) {
                $request->validate([
                    'password' => 'required|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                ]);

                $user = $userInfo->user;

                $user->update(['password' => Hash::make($request->password)]);
            }

            $section = 'account';

            return redirect()->back()
                ->with('success_message', 'You have successfully updated your password.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
