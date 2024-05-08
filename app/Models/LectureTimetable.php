<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectureTimetable extends Model
{
    use HasFactory;

    protected $fillable = [
            'schedule_group_id',
            'recurring_days',
            'end_recur',
            'start_time',
            'end_time',
            'academic_year_id',
            'academic_intake_id',
            'study_mode_id',
            'study_period_id',
            'campus_id',
            'module_id',
            'qualification_id',
            'instructor_id',
            'space_id',  
    ];

    protected $cast = ['qualification_id', 'schedule_group_id'];
}
