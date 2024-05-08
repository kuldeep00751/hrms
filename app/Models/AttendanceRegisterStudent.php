<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class AttendanceRegisterStudent extends Model
{
    use HasFactory;

    protected $fillable = ['attendance_register_id', 'user_info_id', 'student_number', 'first_names', 'surname', 'attendance_duration'];


    public function attendanceRegister(){
        return $this->belongsTo(AttendanceRegister::class);
    }

}
