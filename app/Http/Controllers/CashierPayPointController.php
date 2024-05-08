<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\CashierPayPoint;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class CashierPayPointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $cashierPaypoints = CashierPayPoint::with('user','campus')->get();

        return view('pages.finance.paypoints.index', compact('cashierPaypoints'));
    }

    public function create(){

        $campuses = Campus::where('active', 1)->pluck('name', 'id')->all();

        $users = User::where('user_type', 'Staff')
                    ->selectRaw('concat(first_name,concat(" ", last_name)) as cashier, id')
                    ->pluck('cashier', 'id')
                    ->all();
        
        return view('pages.finance.paypoints.create', compact('campuses', 'users'));
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

            $payPoint = CashierPayPoint::where('user_id', $data['user_id'])
                            ->delete();

            if(!$payPoint){
                CashierPayPoint::create($data);
            }

            return redirect()->route('finance.paypoints.index')
            ->with('success_message', 'Cashier paypoint successfully created.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified qualification from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $payPoint = CashierPayPoint::findOrFail($id);
            $payPoint->delete();

            return redirect()->route('finance.paypoints.index')
            ->with('success_message', 'Cashier paypoint successfully deleted.');
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
            'user_id' => 'required',
            'campus_id' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
