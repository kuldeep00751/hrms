<?php

namespace App\Http\Controllers;

use App\Actions\CreateQualificationCampus;
use App\Actions\CreateQualificationStudyMode;
use App\Http\Controllers\Controller;
use App\Models\ApplicationType;
use App\Models\Campus;
use App\Models\NqfLevel;
use App\Models\Qualification;
use App\Models\StudyMode;
use App\Models\YearLevel;
use Illuminate\Http\Request;
use Exception;
use GuzzleHttp\Promise\Create;

class QualificationsController extends Controller
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
        $qualifications = Qualification::with('studyModes', 'qualificationType', 'numberOfYears', 'nqfLevel')->get();

        return view('pages.settings.qualifications.index', compact('qualifications'));
    }

    /**
     * Show the form for creating a new qualification.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $studyModes = StudyMode::pluck('study_mode','id')->all();

        $qualificationTypes = ApplicationType::pluck('application_type','id')->all();
        
        $campuses = Campus::pluck('name','id')->all();

        $numberOfYears = YearLevel::pluck('year_level','id')->all();

        $nqfLevels = NqfLevel::pluck('nqf_level','id')->all();
        
        return view('pages.settings.qualifications.create', compact('studyModes', 'qualificationTypes', 'campuses', 'numberOfYears', 'nqfLevels'));
    }

    /**
     * Store a new qualification in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request, CreateQualificationCampus $qualificationCampus, CreateQualificationStudyMode $qualificationStudyMode)
    {
        try {
            
            $data = $this->getData($request);
            
            $qualification = Qualification::create($data);

            $qualificationCampus->create($data, $qualification->id);

            $qualificationStudyMode->create($data, $qualification->id);

            return redirect()->route('qualifications.qualification.index')
                ->with('success_message', 'Qualification was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified qualification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $qualification = Qualification::with('studyModes', 'qualificationType', 'numberOfYears', 'nqfLevel')->findOrFail($id);

        return view('pages.settings.qualifications.show', compact('qualification'));
    }

    /**
     * Show the form for editing the specified qualification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $qualification = Qualification::findOrFail($id);

        $studyModes = StudyMode::where('active',1)->pluck('study_mode', 'id')->all();

        $qualificationTypes = ApplicationType::pluck('application_type', 'id')->all();

        $campuses = Campus::where('active',1)->pluck('name', 'id')->all();

        $numberOfYears = YearLevel::pluck('year_level', 'id')->all();

        $nqfLevels = NqfLevel::pluck('nqf_level', 'id')->all();

        return view('pages.settings.qualifications.edit', compact('qualification','studyModes', 'qualificationTypes', 'campuses', 'numberOfYears', 'nqfLevels'));
    }

    /**
     * Update the specified qualification in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request, CreateQualificationCampus $qualificationCampus, CreateQualificationStudyMode $qualificationStudyMode)
    {
        try {
            
            $data = $this->getData($request);
            
            $qualification = Qualification::findOrFail($id);

            $qualification->update($data);

            $qualificationCampus->update($data, $qualification);

            $qualificationStudyMode->update($data, $qualification);

            return redirect()->route('qualifications.qualification.index')
                ->with('success_message', 'Qualification was successfully updated.');
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
            $qualification = Qualification::findOrFail($id);
            $qualification->delete();

            return redirect()->route('qualifications.qualification.index')
                ->with('success_message', 'Qualification was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    public function updateStatus(Request $request)
    {

        $qualification = Qualification::find($request->id);

        $qualification->active = $request->active;

        $qualification->save();

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
            'qualification_name' => 'string|min:1|required',
            'qualification_code' => 'string|min:1|required',
            'number_of_years' => 'required',
            'qualification_credits' => 'required',
            'qualification_type_id' => 'required',
            'study_mode_id' => 'required',
            'campus_id' => 'required',
            'nqf_level_id' => 'required', 
        ];
        
        $data = $request->validate($rules);
        
        return $data;
    }

    public function getQualificationData($qualificationId){
        $qualification = Qualification::with(['studyModes', 'campuses'])->where('id', $qualificationId)->first();
        
        $studyModes = StudyMode::whereIn('id', $qualification->studyModes->pluck('study_mode_id'))->pluck('study_mode', 'id');

        $campuses = Campus::whereIn('id', $qualification->campuses->pluck('campus_id'))->pluck('name', 'id');

        return response()->json([
            "studyModes" => $studyModes,
            "campuses" => $campuses,
        ]);
    }

}
