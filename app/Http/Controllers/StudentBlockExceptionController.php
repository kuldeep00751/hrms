<?php

namespace App\Http\Controllers;

use App\Models\StudentBlockException;
use App\Models\UserInfo;
use Exception;
use Illuminate\Http\Request;

class StudentBlockExceptionController extends Controller
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
        $studentBlockExceptions = StudentBlockException::with('userInfo', 'addedBy')->paginate(25);

        return view('pages.portal.student_block_exceptions.index', compact('studentBlockExceptions'));
    }

    /**
     * Show the form for creating a new qualification.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {


        return view('pages.portal.student_block_exceptions.create');
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

            $data['added_by'] = auth()->user()->id;

            $studentNumbers = explode(',', $data['student_number']);

            $userInfo = UserInfo::select('id', 'student_number')
                ->whereIn('student_number', $studentNumbers)
                ->get();

            $batchNumber = $this->generateBatchNumber();

            foreach ($userInfo as $userInfo) {
                StudentBlockException::create([
                    'user_info_id' => $userInfo->id,
                    'student_number' => $userInfo->student_number,
                    'reason' => $data['reason'],
                    'batch_number' => $batchNumber,
                    'added_by' => $data['added_by'],
                ]);
            }


            return redirect()->route('student_block_exceptions.student_block_exception.index')
                ->with('success_message', 'Student(s) Block Exceptions was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    private function generateBatchNumber()
    {

        $batchNumber = rand(10000, 99999);

        $batchExists = StudentBlockException::where('batch_number', $batchNumber)->first();

        if ($batchExists) {
            return $this->generatedBatchNumber();
        }

        return $batchNumber;
    }

    public function bulkRemove(Request $request)
    {

        if ($request->unblock_option == 'student_number') {
            $studentNumbers = explode(',', $request->student_numbers);

            $studentBlocks = StudentBlockException::whereIn('student_number', $studentNumbers)->get();

            if (count($studentBlocks)) {
                StudentBlockException::whereIn('student_number', $studentNumbers)->delete();
            } else {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Invalid student numbers provided.']);
            }
        } else {
            $studentBlocks = StudentBlockException::where('batch_number', $request->batch_number)->get();

            if (count($studentBlocks)) {
                StudentBlockException::where('batch_number', $request->batch_number)->delete();
            } else {

                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Invalid batch number provided.']);
            }
        }

        return redirect()->route('student_block_exceptions.student_block_exception.index')
            ->with('success_message', 'Operation successfully completed');
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
