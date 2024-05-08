<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class StudentBlock extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['user_info_id','student_number', 'reason', 'blocked_by', 'batch_number'];

    public function userInfo(){
        return $this->belongsTo(UserInfo::class);
    }

    public function blockedBy(){
        return $this->belongsTo(User::class, 'blocked_by');
    }
}
