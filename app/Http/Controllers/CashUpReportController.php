<?php

namespace App\Http\Controllers;

use App\Models\Lov;
use App\Models\Payment;
use Illuminate\Http\Request;

class CashUpReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        $fromDate = $request->from_date ?? date('Y-m-d');
        
        $toDate = $request->to_date ?? date('Y-m-d');

        $request->session()->put('CashupReport.fromDate', $fromDate);
        $request->session()->put('CashupReport.toDate', $toDate);

        $payments = Payment::selectRaw('payment_date, campuses.name as campus_name, campuses.id as campus_id, users.id as user_id, users.first_name as first_name, users.last_name as last_name, sum(payment_amount) as amount')
                        ->whereBetween('payment_date', ["$fromDate", "$toDate"])
                        ->join('users', 'users.id', '=', 'payments.received_by')
                        ->join('cashier_pay_points', 'cashier_pay_points.user_id', '=', 'users.id')
                        ->join('campuses', 'campuses.id', '=', 'cashier_pay_points.campus_id')
                        ->groupBy('payment_date', 'campuses.name', 'campuses.id', 'users.id', 'users.first_name', 'users.last_name')
                        ->get();

        return view('pages.finance.cashup.index', compact('payments', 'fromDate', 'toDate'));
    }

    public function printReceipt($paypoint, $user, $paymentDate){
        $lov = Lov::all();

        $payments = Payment::with('paymentMethod')
                    ->selectRaw('payment_date, payment_method, campuses.name as campus_name, users.first_name as first_name, users.last_name as last_name, sum(payment_amount) as amount')
                    ->where('payment_date', $paymentDate)
                    ->where('received_by', $user)
                    ->where('campuses.id', $paypoint)
                    ->join('payment_methods', 'payment_methods.id', '=', 'payments.payment_method_id')
                    ->join('users', 'users.id', '=', 'payments.received_by')
                    ->join('cashier_pay_points', 'cashier_pay_points.user_id', '=', 'users.id')
                    ->join('campuses', 'campuses.id', '=', 'cashier_pay_points.campus_id')
                    ->groupBy('payment_date', 'payment_method', 'campuses.name', 'users.first_name', 'users.last_name')
                    ->get();
        
        return view('pages.finance.cashup.print', compact('payments', 'user', 'paypoint', 'lov'));

    }

    public function transactions($paypoint, $user, $paymentDate)
    {
        $fromDate = session()->get('CashupReport.fromDate');

        $toDate = session()->get('CashupReport.toDate');

        $payments = Payment::selectRaw('user_infos.student_number, user_infos.first_names as student_name, user_infos.surname as student_surname, payment_reference, payment_date, payment_method, campuses.name as campus_name, users.first_name as first_name, users.last_name as last_name, payment_amount as amount')
        ->where('payment_date', $paymentDate)
            ->where('received_by', $user)
            ->where('campuses.id', $paypoint)
            ->join('user_infos', 'user_infos.id', '=', 'payments.user_info_id')
            ->join('payment_methods', 'payment_methods.id', '=', 'payments.payment_method_id')
            ->join('users', 'users.id', '=', 'payments.received_by')
            ->join('cashier_pay_points', 'cashier_pay_points.user_id', '=', 'users.id')
            ->join('campuses', 'campuses.id', '=', 'cashier_pay_points.campus_id')
            ->get();
            

        return view('pages.finance.cashup.transactions', compact('payments', 'user', 'paypoint', 'fromDate', 'toDate'));
    }

    public function printTransactions($paypoint, $user, $paymentDate){
        
        $lov = Lov::all();

        $payments = Payment::selectRaw('user_infos.student_number, user_infos.first_names as student_name, user_infos.surname as student_surname, payment_reference, payment_date, payment_method, campuses.name as campus_name, users.first_name as first_name, users.last_name as last_name, payment_amount as amount')
        ->where('payment_date', $paymentDate)
            ->where('received_by', $user)
            ->where('campuses.id', $paypoint)
            ->join('user_infos', 'user_infos.id', '=', 'payments.user_info_id')
            ->join('payment_methods', 'payment_methods.id', '=', 'payments.payment_method_id')
            ->join('users', 'users.id', '=', 'payments.received_by')
            ->join('cashier_pay_points', 'cashier_pay_points.user_id', '=', 'users.id')
            ->join('campuses', 'campuses.id', '=', 'cashier_pay_points.campus_id')
            ->get();

        return view('pages.finance.cashup.print_transactions', compact('user', 'paypoint', 'paymentDate', 'lov', 'payments'));
    }
}
