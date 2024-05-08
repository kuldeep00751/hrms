<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class StudentExamination extends Model
{
    use HasFactory;
    use SpatieLogsActivity;
    use \Awobaz\Compoships\Compoships;

    protected $fillable = ['user_info_id',
                            'module_id',
                            'academic_year_id',
                            'assessment_type_id',
                            'academic_intake_id',
                            'study_mode_id',
                            'campus_id',
                            'exam_mark',
                            'pass_fail',
                            'created_by'];


    public function studyMode()
    {
        return $this->belongsTo(StudyMode::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function academicIntake()
    {
        return $this->belongsTo(AcademicIntake::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function module()
    {
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
}
