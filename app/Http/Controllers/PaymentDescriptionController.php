<?php

namespace App\Http\Controllers;

use App\Models\PaymentDescription;
use Exception;
use Illuminate\Http\Request;

class PaymentDescriptionController extends Controller
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

        $paymentDescriptions = PaymentDescription::paginate(25);

        return view('pages.settings.payment_descriptions.index', compact('paymentDescriptions'));
    }

    /**
     * Show the form for creating a new education system.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
    
        return view('pages.settings.payment_descriptions.create');
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

            PaymentDescription::create($data);

            return redirect()->route('payment_descriptions.payment_description.index')
            ->with('success_message', 'Payment Description was successfully added.');
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
        $paymentDescription = PaymentDescription::findOrFail($id);

        return view('pages.settings.payment_descriptions.show', compact('paymentDescription'));
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
        $paymentDescription = PaymentDescription::findOrFail($id);

        return view('pages.settings.payment_descriptions.edit', compact('paymentDescription'));
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

            $paymentDescription = PaymentDescription::findOrFail($id);

            $paymentDescription->update($data);

            return redirect()->route('payment_descriptions.payment_description.index')
            ->with('success_message', 'Payment Description was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateStatus(Request $request)
    {

        $paymentDescription = PaymentDescription::find($request->id);

        $paymentDescription->status = $request->status;

        $paymentDescription->save();

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
            'payment_description' => 'string|min:1|required',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
