<?php

namespace App\Http\Controllers;

use App\Models\Lov;
use Exception;
use File;
use Illuminate\Http\Request;

class CompanySetupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $lovs = Lov::all();

        $chargeTypes = [
            'Subject' => 'Subject',
            'Qualification' => 'Qualification'
        ];

        return view('pages.settings.company_setups.index', compact('lovs', 'chargeTypes'));
    }

    public function store(Request $request)
    {

        try {
            if($request->hasFile('logo')){

                $logo = $request->file('logo');

                $existingLogoPath = public_path('images/' . $logo->getClientOriginalName());

                // Delete existing file if it exists
                if (File::exists($existingLogoPath)) {
                    File::delete($existingLogoPath);
                }
                
                $logo->move(public_path('company'), $logo->getClientOriginalName());

                $request['COMPANY_LOGO'] = public_path('company')."/".$logo->getClientOriginalName();

            }
            
            foreach ($request->except('_token', 'logo') as $key => $value) {

                $lov = Lov::where('label', $key)->first();

                if ($lov) {
                    if (!is_null($value)) {
                        $lov->update(['value' => $value]);
                    }
                } else {
                    if (!is_null($value)) {
                        Lov::create(['label' => $key, 'value' => $value]);
                    }
                }
            }

            return redirect()->back()
                ->with('success_message', 'List of values successfully updated');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
