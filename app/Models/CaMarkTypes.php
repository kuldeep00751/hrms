<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class CaMarkTypes extends Model
{
    use HasFactory;
    use SpatieLogsActivity;
    

    protected $fillable = ['user_info_id',
                            'module_id',
                            'academic_year_id',
                            'mark_type_id',
                            'academic_intake_id',
                            'campus_id',
                            'study_mode_id',
                            'mark',
                            'created_by',
                            'updated_by'];


    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function academicIntake()
    {
        return $this->belongsTo(AcademicIntake::class);
    }

    public function studyMode()
    {
        return $this->belongsTo(studyMode::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function markType()
    {
        return $this->belongsTo(ContinuousAssessmentWeight::class);
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
