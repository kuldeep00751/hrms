<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_info_id', 'student_letter_id', 'qualification_id', 'academic_year_id', 'academic_intake_id', 'campus_id', 'admission_status_id'];

    protected $with = ['userInfo', 'studentLetter'];

    public function userInfo(){
        return $this->belongsTo(UserInfo::class);
    }

    public function studentLetter(){
        return $this->belongsTo(StudentLetter::class);
    }
}
