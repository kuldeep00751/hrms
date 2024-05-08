<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamMarkCriteria extends Model
{
    use HasFactory;

    protected $fillable = ['module_id', 'academic_year_id', 'assessment_type_id', 'assessment_result_code_id', 'min_mark', 'max_mark', 'created_by', 'updated_by'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function assessmentType()
    {
        return $this->belongsTo(AssessmentType::class);
    }

    public function assessmentResultCode()
    {
        return $this->belongsTo(AssessmentResultCode::class);
    }
}
