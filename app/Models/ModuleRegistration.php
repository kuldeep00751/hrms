<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class ModuleRegistration extends Model
{
    use HasFactory;
    use SpatieLogsActivity;
    use \Awobaz\Compoships\Compoships;

    protected $fillable = ['user_info_id',
                            'module_id',
                            'qualification_id',
                            'academic_year_id',
                            'module_year_level',
                            'student_year_level',
                            'study_mode_id',
                            'campus_id',
                            'academic_intake_id',
                            'assessment_type_id',
                            'study_period_id',
                            'registration_status_id',
                            'cancel_date',
                            'is_cancelled',
                            'exemption_date',
                            'is_exempted',
                            'cancel_reason',
                            'exemption_reason',
                            'created_by',
                            'updated_by'];




    public function studyPeriod(){
        return $this->belongsTo(StudyPeriod::class);
    }

    public function studyMode(){
        return $this->belongsTo(StudyMode::class);
    }

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function academicIntake(){
        return $this->belongsTo(AcademicIntake::class);
    }

    public function campus(){
        return $this->belongsTo(Campus::class);
    }

    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class);
    }

    public function assessmentType()
    {
        return $this->belongsTo(AssessmentType::class);
    }

    public function registrationStatus(){
        return $this->belongsTo(RegistrationStatus::class, 'registration_status_id');
    }

    public function assessmentTypes()
    {
        return $this->hasMany(ContinuousAssessmentWeight::class, 'module_id', 'module_id');
    }

    public function examModulePapers()
    {
        return $this->hasMany(ExamModulePaper::class, ['user_info_id', 'study_mode_id', 'campus_id', 'academic_year_id', 'academic_intake_id'], ['user_info_id', 'study_mode_id', 'campus_id', 'academic_year_id', 'academic_intake_id']);
    }
    
}
