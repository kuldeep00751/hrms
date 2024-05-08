<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class SubjectFee extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['module_id',
                            'academic_year_id',
                            'created_by',
                            'amount',
                            'student_type_id',
                            'assessment_type_id',
                            'academic_process'];



    public function studentType(){
        return $this->belongsTo(StudentType::class);
    }


    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function assessmentType()
    {
        return $this->belongsTo(AssessmentType::class);
    }

}
