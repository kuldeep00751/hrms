<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class ExamPaper extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['academic_year_id', 'module_id', 'weight', 'paper_name', 'assessment_type_id', 'minimum_pass_mark', 'assessment_result_code_id'];

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

    public function assessmentResultCode()
    {
        return $this->belongsTo(AssessmentResultCode::class);
    }
}
