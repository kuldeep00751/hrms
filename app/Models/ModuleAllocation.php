<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class ModuleAllocation extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['user_id', 'module_id', 'study_mode_id', 'academic_year_id', 'academic_intake_id', 'campus_id'];

    public function studyMode()
    {
        return $this->belongsTo(StudyMode::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
