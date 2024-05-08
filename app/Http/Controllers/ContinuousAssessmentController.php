<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\CaMarkTypes;
use App\Models\ContinuousAssessmentWeight;
use App\Models\MarkType;
use App\Models\Module;
use Exception;
use Illuminate\Http\Request;

class ContinuousAssessmentController extends Controller
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

        $continuousAssessments = ContinuousAssessmentWeight::with('module', 'markType', 'academicYear')->get();

        $modules = ContinuousAssessmentWeight::distinct()->select('module_id', 'academic_year_id')->get();
        
        return view('pages.settings.continuous_assessments.index', compact('continuousAssessments', 'modules'));
    }

    /**
     * Show the form for creating a new education system.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $markTypes = MarkType::pluck('mark_type', 'id')->all();

        return view('pages.settings.continuous_assessments.create', compact('modules', 'academicYears', 'markTypes'));
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


            $totalWeight = array_sum($data['weight']);

            $hasDuplicateMarkType = $this->hasDuplicates($data['mark_type_id']);

            if ($hasDuplicateMarkType) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Error while saving. Duplicate mark types found.']);
            }

            if ($totalWeight != 100) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Error saving record! The total weight cannot be less or more than 100%. All assessment weights put together should be equal to 100%']);
            }
            
            foreach($data['mark_type_id'] as $key => $mark_type_id){
                ContinuousAssessmentWeight::create([
                    'module_id' => $data['module_id'],
                    'academic_year_id' => $data['academic_year_id'],
                    'mark_type_id' => $mark_type_id,
                    'assessment_description' => $data['assessment_description'][$key],
                    'weight' => $data['weight'][$key],
                ]);
            }
            

            return redirect()->route('continuous_assessments.continuous_assessment.index')
            ->with('success_message', 'Continuous Assessment Weight was successfully added.');
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
        $continuousAssessment = ContinuousAssessmentWeight::findOrFail($id);

        return view('pages.settings.continuous_assessments.show', compact('continuousAssessment'));
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
        $params = explode('_', $id);

        $module_id = $params[0];

        $academic_year_id = $params[1];

        $continuousAssessment = ContinuousAssessmentWeight::where('module_id', $module_id)
                                                            ->where('academic_year_id', $academic_year_id)
                                                            ->get();
        
        $modules = Module::where('active',1)->pluck('module_name', 'id')->all();

        $academicYears = AcademicYear::pluck('name', 'id')->all();

        $markTypes = MarkType::pluck('mark_type', 'id')->all();

        return view('pages.settings.continuous_assessments.edit', compact('continuousAssessment', 'modules', 'academicYears', 'markTypes'));
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

            $totalWeight = array_sum($data['weight']);

            if ($totalWeight != 100) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Error saving record! The total weight cannot be less or more than 100%. All assessment weights put together should be equal to 100%']);
            }

            $hasDuplicateMarkType = $this->hasDuplicates($data['mark_type_id']);

            if ($hasDuplicateMarkType) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Error while saving. Duplicate mark types found.']);
            }

            $params = explode('_', $id);

            $module_id = $params[0];

            $academic_year_id = $params[1];

            $continuousAssessments = ContinuousAssessmentWeight::where('module_id', $module_id)
                                                                ->where('academic_year_id', $academic_year_id)
                                                                ->get();

            //dd($continuousAssessments);
            foreach ($request->continuous_assessment_weight_id as $key => $assessment_weight_id) {

                if(!is_null($assessment_weight_id)){
                    $assessment = $continuousAssessments->find($assessment_weight_id);
                    $assessment->weight = $request->weight[$key];
                    $assessment->save();
                } else {
                    ContinuousAssessmentWeight::create([
                        'module_id' => $data['module_id'],
                        'academic_year_id' => $data['academic_year_id'],
                        'mark_type_id' => $request->mark_type_id[$key],
                        'assessment_description' => $data['assessment_description'][$key],
                        'weight' => $data['weight'][$key],
                    ]);
                }
            }


            return redirect()->route('continuous_assessments.continuous_assessment.index')
            ->with('success_message', 'Continuous Assessment Weight was successfully updated.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    protected function hasDuplicates(array $array): bool
    {
        $counts = array_count_values($array);
        foreach ($counts as $count) {
            if ($count > 1) {
                return true;
            }
        }
        return false;
    }

    public function deleteContinuousAssessment($id){
        $mark = CaMarkTypes::where('mark_type_id', $id)->first();

        if(!$mark){
            ContinuousAssessmentWeight::destroy($id);    

            return response()->json([
                'status' => 1,
                'message' => 'Assessment deleted successfully'
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Error removing assessment. Marks have already been captured for this assessment'
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
            'module_id' => 'required',
            'mark_type_id' => 'required',
            'assessment_description' => 'required',
            'academic_year_id' => 'required',
            'weight' => 'required',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
