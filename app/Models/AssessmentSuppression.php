<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class AssessmentSuppression extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['academic_year_id',
                            'academic_intake_id',
                            'campus_id',
                            'study_mode_id',
                            'suppression_type',
                            'suppress_yn',
                            'created_by',
                            'updated_by'];


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

    public function createdBy(){
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }

}
