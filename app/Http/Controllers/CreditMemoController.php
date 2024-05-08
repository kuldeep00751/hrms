<?php

namespace App\Http\Controllers;

use App\Models\AcademicIntake;
use App\Models\AcademicYear;
use App\Models\CreditMemo;
use App\Models\Module;
use App\Models\ModuleRegistration;
use App\Models\Qualification;
use App\Models\Registration;
use App\Models\StudentAccount;
use App\Models\UserInfo;
use Exception;
use Illuminate\Http\Request;

class CreditMemoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $creditMemos = CreditMemo::with('userInfo', 'createdBy')->paginate(25);

        return view('pages.finance.credit_memos.index', compact('creditMemos'));
    }

    public function create()
    {
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        return view('pages.finance.credit_memos.create', compact('academicYears', 'academicIntakes', 'qualifications', 'modules'));
    }

    public function createBulk()
    {
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $academicIntakes = AcademicIntake::where('active', 1)->pluck('name', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        return view('pages.finance.credit_memos.create_bulk', compact('academicYears', 'academicIntakes', 'qualifications', 'modules'));
    }

    public function store(Request $request)
    {
        try {

            $rules = [
                'student_number' => 'required',
                'transaction_description' => 'required',
                'transaction_date' => 'required',
                'amount' => 'required',
                'created_by' => 'required',
            ];

            $data = $request->validate($rules);

            $userInfo = UserInfo::select('id')->where('student_number', $data['student_number'])->first();

            if (!$userInfo) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Invalid student number.']);
            }

            $financialYear  = AcademicYear::where('name', date('Y'))->first();

            if (!$financialYear) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Financial Year not defined.']);
            }

            $data['user_info_id'] = $userInfo->id;

            $data['transaction_id'] = $this->generateTransactionId();

            $creditMemo = CreditMemo::create($data);

            StudentAccount::create([
                'user_info_id' => $userInfo->id,
                'financial_year_id' => $financialYear->id,
                'reference' => $data['transaction_id'],
                'transaction_date' => $data['transaction_date'],
                'transaction_description' => $data['transaction_description'],
                'transaction_type' => "CreditMemo",
                'model_type' => 'CreditMemo',
                'model_id' => $creditMemo->id,
                'debit' => 0,
                'credit' => $data['amount']
            ]);

            return redirect()->route('finance.credit_memos.index')
                ->with('success_message', 'Credit Memo was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function storeBulk(Request $request)
    {
        try {

            $rules = [
                'transaction_description' => 'required',
                'academic_intake_id' => 'required',
                'transaction_date' => 'required',
                'amount' => 'required',
                'created_by' => 'required',
            ];

            $data = $request->validate($rules);

            $financialYear  = AcademicYear::where('name', date('Y'))->first();

            if (!$financialYear) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Financial Year not defined.']);
            }

            $moduleRegistrations = null;

            if (isset($request->module_id)) {
                $moduleRegistrations = ModuleRegistration::select('user_info_id')
                    ->where('module_id', $request->module_id)
                    ->where('academic_year_id', $financialYear->id)
                    ->where('is_cancelled', 0)
                    ->pluck('user_info_id');
            }

            $qualificationRegistrations = Registration::select('user_info_id', 'qualification_id')
                ->where('academic_year_id', $financialYear->id)
                ->where('academic_intake_id', $request->academic_intake_id)
                ->where('is_cancelled', 0);

            if (isset($request->qualification_id)) {
                $qualificationRegistrations = $qualificationRegistrations
                    ->where('qualification_id', $request->qualification_id)
                    ->pluck('user_info_id');
            } else {
                $qualificationRegistrations = $qualificationRegistrations->pluck('user_info_id');
            }

            $userInfos = null;

            if ($moduleRegistrations) {
                $userInfos = $qualificationRegistrations
                    ->merge($moduleRegistrations)
                    ->toArray();
            } else {
                $userInfos = $qualificationRegistrations
                    ->toArray();
            }

            $data['transaction_id'] = $this->generateTransactionId();

            $userInfos = array_unique($userInfos);

            foreach ($userInfos as $key => $id) {

                $data['user_info_id'] = $id;

                $debitMemo = CreditMemo::create($data);

                StudentAccount::create([
                    'user_info_id' => $id,
                    'financial_year_id' => $financialYear->id,
                    'reference' => $data['transaction_id'],
                    'transaction_date' => $data['transaction_date'],
                    'transaction_description' => $data['transaction_description'],
                    'transaction_type' => "DebitMemo",
                    'model_type' => 'DebitMemo',
                    'model_id' => $debitMemo->id,
                    'debit' => 0,
                    'credit' => $data['amount']
                ]);
            }

            return redirect()->route('finance.credit_memos.index')
                ->with('success_message', 'Credit Memos successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    private function generateTransactionId()
    {
        $date = date('Y');

        $transactionId = rand(1000, 9999);

        $transactionId = "CM" . $date . "" . $transactionId;

        $studentCharge = CreditMemo::where('transaction_id', $transactionId)->first();

        if ($studentCharge) {
            $this->generateTransactionId();
        }

        return $transactionId;
    }

}
