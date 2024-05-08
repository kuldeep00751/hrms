<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class ExamAdmissionCriteria extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['module_id', 'academic_year_id', 'created_by', 'updated_by', 'exam_weight', 'ca_weight', 'minimum_ca_mark', 'assessment_result_code_id', 'minimum_attendance', 
    'assessment_type_id', 'absent_exam_indicator', 'absent_exam_result_code'];


    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function assessmentResultCode()
    {
        return $this->belongsTo(AssessmentResultCode::class);
    }

    public function assessmentType()
    {
        return $this->belongsTo(AssessmentType::class);
    }
}
