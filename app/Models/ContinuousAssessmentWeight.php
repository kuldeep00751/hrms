<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class ContinuousAssessmentWeight extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['module_id',
                            'mark_type_id',
                            'academic_year_id',
                            'assessment_description',
                            'weight'];


    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function markType(){
        return $this->belongsTo(MarkType::class);
    }

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    }
}
