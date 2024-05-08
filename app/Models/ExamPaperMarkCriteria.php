<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class ExamPaperMarkCriteria extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['module_id', 'academic_year_id', 'assessment_type_id', 'exam_paper_id', 'assessment_result_code_id', 'range_from', 'range_to', 'created_by', 'updated_by'];

    public function module(){
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

    public function examPaper()
    {
        return $this->belongsTo(ExamPaper::class);
    }

    public function assessmentResultCode()
    {
        return $this->belongsTo(AssessmentResultCode::class);
    }
}
