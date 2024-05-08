<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class StudentBlockException extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['student_number', 'reason', 'added_by', 'user_info_id', 'batch_number'];


    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class);
    } 
    
    public function addedBy(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
