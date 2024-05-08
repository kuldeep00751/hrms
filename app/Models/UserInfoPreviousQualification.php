<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class UserInfoPreviousQualification extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = [
        'user_info_id', 'level_id', 'student_number', 'institution', 'qualification_name', 'awarded_yn', 'from_date', 'to_date', 'document_path'
    ];

    public function level(){
        return $this->belongsTo(ApplicationType::class, 'level_id');
    }
}
