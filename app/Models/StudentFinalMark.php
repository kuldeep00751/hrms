<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class StudentFinalMark extends Model
{
    use HasFactory;
    use SpatieLogsActivity;
    use \Awobaz\Compoships\Compoships;

    protected $fillable = ['user_info_id', 'module_id', 'academic_year_id', 'study_mode_id', 'academic_intake_id', 'campus_id', 'final_mark', 'grading_scale_id', 'assessment_type_id', 'pass_fail', 'result_description','created_by', 'updated_by'];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function academicIntake()
    {
        return $this->belongsTo(AcademicIntake::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function studyMode()
    {
        return $this->belongsTo(StudyMode::class);
    }

    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class);
    }

    public function assessmentType()
    {
        return $this->belongsTo(AssessmentType::class);
    }

    public function assessmentResultCode()
    {
        return $this->belongsTo(AssessmentResultCode::class, 'grading_scale_id');
    }

    public function continuousAssessment()
    {
        return $this->hasMany(StudentCa::class, ['user_info_id', 'study_mode_id', 'campus_id', 'academic_year_id', 'academic_intake_id', 'module_id'], ['user_info_id', 'study_mode_id', 'campus_id', 'academic_year_id', 'academic_intake_id', 'module_id']);
    }

    public function examinationMark()
    {
        return $this->hasMany(StudentExamination::class, ['user_info_id', 'study_mode_id', 'campus_id', 'academic_year_id', 'academic_intake_id', 'module_id', 'assessment_type_id'], ['user_info_id', 'study_mode_id', 'campus_id', 'academic_year_id', 'academic_intake_id', 'module_id', 'assessment_type_id']);
    }

}
