<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class UserInfoApplication extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['user_info_id', 'qualification_id', 'academic_intake_id', 'campus_id', 'study_mode_id'];
}
