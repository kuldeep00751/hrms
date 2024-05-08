<?php

namespace App\Http\Controllers;

use App\Actions\CopyFees;
use App\Models\AcademicYear;
use App\Models\FeeType;
use App\Models\OtherFee;
use App\Models\Qualification;
use App\Models\StudentType;
use App\Models\YearLevel;
use Exception;
use Illuminate\Http\Request;

class OtherFeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the campuses.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $otherFees = OtherFee::with('studentType', 'academicYear', 'feeType')->get();

        return view('pages.settings.other_fees.index', compact('otherFees'));
    }

    /**
     * Show the form for creating a new campus.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $feeTypes = FeeType::pluck('fee_type_name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $studentTypes = StudentType::where('active', 1)->pluck('student_type', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $yearLevels = YearLevel::pluck('year_level', 'id')->all();

        return view('pages.settings.other_fees.create', compact('feeTypes', 'academicYears', 'studentTypes', 'qualifications', 'yearLevels'));
    }

    /**
     * Store a new campus in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);
            
            $qualifications = Qualification::whereIn('id', $data['qualification_id'])->get();

            $yearLevels = YearLevel::find($data['year_level_id']);
            
            foreach ($request->qualification_id as $key => $value) {
                
                $qualification = $qualifications->find($value);
                
                if(intval($yearLevels->year_level) > intval($qualification->number_of_years)){

                    return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Invalid Year Level/Qualification combination selected.']);

                }

                OtherFee::create([
                    'fee_type_id' => $data['fee_type_id'],
                    'academic_year_id' => $data['academic_year_id'],
                    'qualification_id' => $value,
                    'year_level_id' => $data['year_level_id'],
                    'created_by' => $data['created_by'],
                    'amount' => $data['amount'],
                    'student_type_id' => $data['student_type_id'],
                    'academic_process' => $data['academic_process']
                ]);
            }

            return redirect()->route('otherFees.otherFee.index')
                ->with('success_message', 'Other fee was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified campus.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $otherFee = OtherFee::findOrFail($id);

        return view('pages.settings.other_fees.show', compact('otherFee'));
    }

    /**
     * Show the form for editing the specified campus.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $otherFee = OtherFee::findOrFail($id);

        $feeTypes = FeeType::pluck('fee_type_name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $studentTypes = StudentType::where('active', 1)->pluck('student_type', 'id')->all();

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $yearLevels = YearLevel::pluck('year_level', 'id')->all();

        return view('pages.settings.other_fees.edit', compact('otherFee', 'feeTypes', 'academicYears', 'studentTypes', 'qualifications', 'yearLevels'));
    }

    /**
     * Update the specified campus in the storage.
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

            $otherFee = OtherFee::findOrFail($id);

            $qualifications = Qualification::whereIn('id', $data['qualification_id'])->get();

            $yearLevels = YearLevel::find($data['year_level_id']);

            foreach ($request->qualification_id as $key => $value) {

                $qualification = $qualifications->find($value);

                if (intval($yearLevels->year_level) > intval($qualification->number_of_years)) {

                    return back()->withInput()
                        ->withErrors(['unexpected_error' => 'Invalid Year Level/Qualification combination selected.']);
                }

                $otherFee->update([
                    'fee_type_id' => $data['fee_type_id'],
                    'academic_year_id' => $data['academic_year_id'],
                    'qualification_id' => $value,
                    'year_level_id' => $data['year_level_id'],
                    'created_by' => $data['created_by'],
                    'amount' => $data['amount'],
                    'student_type_id' => $data['student_type_id'],
                    'academic_process' => $data['academic_process']
                ]);
            }

            return redirect()->route('otherFees.otherFee.index')
                ->with('success_message', 'Fee was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateStatus(Request $request)
    {

        $otherFee = OtherFee::find($request->id);

        $otherFee->active = $request->active;

        $otherFee->save();

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
            'fee_type_id' => 'required',
            'academic_year_id' => 'required',
            'created_by' => 'required',
            'amount' => 'numeric|required',
            'student_type_id' => 'required',
            'academic_process' => 'required',
            'qualification_id' => 'required',
            'year_level_id' => 'required',
        ];

        $data = $request->validate($rules);


        return $data;
    }


    public function copyForm(){
        
        $academicYears = AcademicYear::pluck('name', 'id')->all();

        return view('pages.settings.other_fees.copy', compact('academicYears'));
    }

    public function copy(Request $request, CopyFees $copyFees)
    {
        try {
            $copyFees->copy($request, "Other Fees");

            return redirect()->route('otherFees.otherFee.index')
            ->with('success_message', 'Fees were successfully copied.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
