<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class ExamRegistrationCriteria extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['academic_year_id', 'assessment_type_id', 'required_assessment_mark', 'required_assessment_exam_id', 'minimum_mark', 'maximum_mark'];

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function assessmentType(){
        return $this->belongsTo(AssessmentType::class);
    }

    public function requiredAssessmentType(){
        return $this->belongsTo(AssessmentType::class, 'required_assessment_exam_id');
    }
}
