<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use App\Models\StudentBlock;
use App\Models\StudentOtherBlock;
use App\Models\UserInfo;
use Exception;
use Illuminate\Http\Request;

class StudentBlockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the qualifications.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $studentBlocks = StudentBlock::with('userInfo', 'blockedBy')->paginate(25);
        
        return view('pages.portal.student-block.index', compact('studentBlocks'));
    }

    /**
     * Show the form for creating a new qualification.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {


        return view('pages.portal.student-block.create');
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

            $data['blocked_by'] = auth()->user()->id;

            $studentNumbers = explode(',', $data['student_number']);

            $userInfo = UserInfo::select('id','student_number')
                                ->whereIn('student_number', $studentNumbers)
                                ->get();

            $batchNumber = $this->generateBatchNumber();

            foreach ($userInfo as $userInfo){
                StudentBlock::create([
                    'user_info_id' => $userInfo->id,
                    'student_number' => $userInfo->student_number,
                    'reason' => $data['reason'],
                    'batch_number' => $batchNumber,
                    'blocked_by' => $data['blocked_by'],
                ]);
            }
            

            return redirect()->route('student_blocks.student_block.index')
            ->with('success_message', 'Student(s) Block was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Update the specified qualification in the storage.
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

            $studentNoticeBoard = StudentNoticeBoard::find($id);

            $studentNoticeBoard->update($data);

            return redirect()->route('student_blocks.student_block.index')
            ->with('success_message', 'Notice board item was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    private function generateBatchNumber(){

        $batchNumber = rand(10000, 99999);

        $batchExists = StudentBlock::where('batch_number', $batchNumber)->first();

        if($batchExists){
            return $this->generatedBatchNumber();
        }

        return $batchNumber;
    }

    public function bulkRemove(Request $request){
       
        if($request->unblock_option == 'student_number'){
            $studentNumbers = explode(',', $request->student_numbers);

            $studentBlocks = StudentBlock::whereIn('student_number', $studentNumbers)->get();

            if (count($studentBlocks)) {
                StudentBlock::whereIn('student_number', $studentNumbers)->delete();
            } else {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Invalid student numbers provided.']);
            }
            
        } else {
            $studentBlocks = StudentBlock::where('batch_number', $request->batch_number)->get();

            if(count($studentBlocks)){
                StudentBlock::where('batch_number', $request->batch_number)->delete();
            } else {
                
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Invalid batch number provided.']);
            }
            
        }

        return redirect()->route('student_blocks.student_block.index')
            ->with('success_message', 'Operation successfully completed');
    }

    public function advancedOptions(){

        $qualifications = Qualification::where('active',1)->pluck('qualification_name', 'id')->all();

        $advancedBlocks = StudentOtherBlock::all();

        return view('pages.portal.student-block.advanced', compact('qualifications', 'advancedBlocks'));
    }

    public function storeAdvancedOptions(Request $request){
        if(isset($request->FinancialBlock)){
            StudentOtherBlock::where('block_type', 'FinancialBlock')->delete();

            StudentOtherBlock::create([
                'block_type' => 'FinancialBlock',
                'status' => 1,
                'value' => json_encode(intval($request->minimum_amount))
            ]);
        } else {
            StudentOtherBlock::where('block_type', 'FinancialBlock')->delete();
        }

        if (isset($request->QualificationBlock)) {
            StudentOtherBlock::where('block_type', 'QualificationBlock')->delete();

            StudentOtherBlock::create([
                'block_type' => 'QualificationBlock',
                'status' => 1,
                'value' => json_encode($request->qualifications)
            ]);
        } else {
            StudentOtherBlock::where('block_type', 'QualificationBlock')->delete();
        }

        return redirect()->back()
            ->with('success_message', 'Student blocks successfully modified');

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
            'student_number' => 'string|min:1|required',
            'reason' => 'string|min:1|required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
