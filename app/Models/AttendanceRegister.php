<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class AttendanceRegister extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['academic_year_id', 'academic_intake_id', 'campus_id', 'study_mode_id', 'module_id', 'attendance_date', 'recorded_by'];


    public function userInfo(){
        return $this->hasMany(AttendanceRegisterStudent::class);
    }

    public function recordedBy(){
        return $this->belongsTo(User::class, 'recorded_by');
    }

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

    public function user(){
        return $this->belongsTo(User::class, 'recorded_by');
    }

}
