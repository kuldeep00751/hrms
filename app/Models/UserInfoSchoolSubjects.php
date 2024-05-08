<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class UserInfoSchoolSubjects extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = [
        'school_subject_id',
        'matric_type' ,
        'mid_term_result',
        'mid_term_points',
        'final_term_result',
        'final_term_points',
        'user_info_id'
    ];

    protected $with = ['subject'];


    public function subject() 
    {
        return $this->belongsTo(SchoolSubject::class,'school_subject_id');
    }
}
