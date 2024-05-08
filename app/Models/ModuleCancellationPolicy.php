<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class ModuleCancellationPolicy extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['academic_year_id', 'study_period_id', 'date_from','date_to','cancellation_percentage', 'academic_intake_id'];


    public function studyPeriod()
    {
        return $this->belongsTo(StudyPeriod::class);
    }
    
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function academicIntake()
    {
        return $this->belongsTo(AcademicIntake::class);
    }
}
