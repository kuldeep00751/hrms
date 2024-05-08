<?php

namespace App\Http\Controllers;

use App\Actions\StudentAccount;
use App\Actions\StudentBalance;
use App\Models\CashierPayPoint;
use App\Models\Lov;
use App\Models\Payment;
use App\Models\PaymentDescription;
use App\Models\PaymentMethod;
use App\Models\UserInfo;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $paymentMethods = PaymentMethod::where('active',1)->pluck('payment_method', 'id')->all();

        $payments = Payment::with('userInfo','paymentMethod')->orderBy('id', 'desc')->paginate(25);

        return view('pages.finance.payments.index', compact('paymentMethods', 'payments'));
    }

    public function filter(Request $request){
        $paymentMethods = PaymentMethod::where('active',1)->pluck('payment_method', 'id')->all();

        $filterData = $this->filterData($request);
        
        session()->put($filterData);

        $payments = Payment::with('paymentMethod', 'userInfo');

        $payments = $this->applyFilters($payments, $request);

        if(!count($payments)){
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Payments not found.']);
        }

        return view('pages.finance.payments.index', compact('paymentMethods','payments'));
    }

    private function applyFilters($payments, $request)
    {
        if (isset($request->student_number)) {
            $userInfo = UserInfo::where('student_number', $request->student_number)->first();

            $payments = $payments->where('user_info_id', $userInfo->id);
        }

        if (isset($request->payment_reference)) {
            $payments = $payments->where('payment_reference', "PAY-".$request->payment_reference);
        }

        if (isset($request->payment_method)) {
            $payments = $payments->where('payment_method', $request->payment_method);
        }

        return $payments->get();
    }

    private function filterData($request)
    {
        if (count($request->all())) {
            return $request->all();
        } else {
            return [
                'student_number' => "",
                'payment_reference' => "",
                'payment_method' => 0,
            ];
        }
    }

    public function create()
    {
        $user = auth()->user();

        $cashierPaypoint = CashierPayPoint::with('campus')->where('user_id', $user->id)->first();

        $paymentMethods = PaymentMethod::where('active',1)->pluck('payment_method', 'id')->all();

        $paymentDescriptions = PaymentDescription::where('status',1)->pluck('payment_description', 'payment_description')->all();

        return view('pages.finance.payments.create', compact('paymentMethods', 'cashierPaypoint', 'paymentDescriptions'));
    }

    /**
     * Store a new payment in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request, StudentAccount $studentAccount)
    {
        try {

            if(!$this->isPopReferenceNumberUnique($request->pop_reference)){
                return back()->withInput()
                ->withErrors(['unexpected_error' => 'This Proof of Payment reference number '. $request->pop_reference.' has already been used.']);
            }

            if($this->isPopReferenceNumberRequired($request->payment_method_id)){
                if(!isset($request->pop_reference)){
                    return back()->withInput()
                        ->withErrors(['unexpected_error' => 'The POP Reference number is required for the selected payment method.']);
                } 
            }

            $data = $this->getData($request);

            $data['payment_reference'] = $this->generateTransactionReference();

            $payment = Payment::create($data);
            
            $studentAccount->creditStudentPayment($payment);

            return redirect()->route('payments.index')
            ->with('success_message', 'Payment was successfully captured.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    private function isPopReferenceNumberUnique($popReference){
        
        if(isset($popReference)){
            $payment = Payment::where('pop_reference', $popReference)->first();

            if($payment){
                return false;
            }
        }

        return true;
    }

    private function isPopReferenceNumberRequired($paymentMethodId){
        
        $paymentMethod = PaymentMethod::find($paymentMethodId);

        if($paymentMethod->payment_receipt_required){
            return true;
        }

        return false;
    }

    public function print($id, StudentBalance $studentBalance){
        $lov = Lov::all();
        
        $payment = Payment::with('paymentMethod', 'userInfo')->findOrFail($id);
        
        $registration = $payment->userInfo->applications->last();

        $campus = $registration->campus;

        $balance = $studentBalance->getStudentBalance($payment->user_info_id);

        return view('pages.finance.payments.print', compact('payment', 'lov', 'campus', 'balance'));
    }

    private function generateTransactionReference()
    {
        return "PAY-" . "" . rand(10000, 99999);
    }
    public function getStudentInfo($student_number){

        $user_info = UserInfo::where('student_number', $student_number)->first();
        
        if($user_info){
            return response()->json([
                'status' => 1,
                'message' => 'success',
                'user_info_id' => $user_info->id,
                'student_info' => $user_info
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid student number',
            'status' => 0,
            'user_info_id' => 0, 
            'student_name' => ''
        ]);

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
            'user_info_id' => 'required',
            'payment_date' => 'required|before:tomorrow',
            'pop_reference' => 'nullable',
            'payment_amount' => 'required',
            'payment_description' => 'required',
            'payment_method_id' => 'required',
            'received_by' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
