<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Exception;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the education systems.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {

        $paymentMethods = PaymentMethod::paginate(25);

        return view('pages.settings.payment_methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new education system.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $paymentReceiptRequiredOptions = [
            1 => "Yes",
            0 => "No"
        ];

        return view('pages.settings.payment_methods.create', compact('paymentReceiptRequiredOptions'));
    }

    /**
     * Store a new education system in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            PaymentMethod::create($data);

            return redirect()->route('payment_methods.payment_method.index')
            ->with('success_message', 'Payment Method was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified education system.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        return view('pages.settings.payment_methods.show', compact('paymentMethod'));
    }

    /**
     * Show the form for editing the specified education system.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        
        $paymentReceiptRequiredOptions = [
            1 => "Yes",
            0 => "No"
        ];

        return view('pages.settings.payment_methods.edit', compact('paymentMethod', 'paymentReceiptRequiredOptions'));
    }

    /**
     * Update the specified education system in the storage.
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

            $paymentMethod = PaymentMethod::findOrFail($id);

            $paymentMethod->update($data);

            return redirect()->route('payment_methods.payment_method.index')
            ->with('success_message', 'Payment Method was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    public function updateStatus(Request $request)
    {

        $paymentMethod = PaymentMethod::find($request->id);

        $paymentMethod->active = $request->active;

        $paymentMethod->save();

        return response()->json(array('success_message' => 'Status was successfully added.'), 200);
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
            'payment_method' => 'string|min:1|required',
            'payment_receipt_required' => 'required',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
