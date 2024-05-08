<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class ExamModulePaper extends Model
{
    use HasFactory;
    use SpatieLogsActivity;
    use \Awobaz\Compoships\Compoships;

    protected $fillable = ['user_info_id',
                            'module_id',
                            'academic_year_id',
                            'academic_intake_id',
                            'assessment_type_id',
                            'study_mode_id',
                            'campus_id',
                            'exam_paper_id',
                            'mark',
                            'pass_fail',
                            'created_by',
                            'updated_by'];

    public function examPaper(){
        return $this->belongsTo(ExamPaper::class);
    }
}
