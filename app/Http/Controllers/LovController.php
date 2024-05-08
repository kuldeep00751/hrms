<?php

namespace App\Http\Controllers;

use App\Models\Lov;
use App\Models\StudentLetter;
use Exception;
use Illuminate\Http\Request;

class LovController extends Controller
{

    /**
     * Display a listing of the grading scales.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $lovs = Lov::all();

        $chargeTypes = [
            'Subject' => 'Subject',
            'Qualification' => 'Qualification'
        ];

        $acknowledgementLetterOptions = [
            'Yes' => 'Yes',
            'No' => 'No',
        ];

        $acknowledgementLetters = StudentLetter::pluck('letter_name', 'id')->all();

        return view('pages.settings.lovs.index', compact('lovs', 'chargeTypes', 'acknowledgementLetterOptions', 'acknowledgementLetters'));
    }


    /**
     * Show the form for editing the specified grading scale.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $lov = Lov::findOrFail($id);

        return view('pages.settings.lovs.edit', compact('lov'));
    }

    /**
     * Update the specified grading scale in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        
        try {
            foreach ($request->except('_token') as $key => $value) {
                
                $lov = Lov::where('label', $key)->first();
                
                if($lov){
                    if(!is_null($value)){
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


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'label' => 'string',
            'value' => 'string',
        ];

        $data = $request->validate($rules);


        return $data;
    }

}
