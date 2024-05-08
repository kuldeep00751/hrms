<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class StudentCharge extends Model
{
    use HasFactory;
    use SpatieLogsActivity;
    
    protected $fillable = ['user_info_id', 'student_charge_type_id', 'amount', 'transaction_id', 'transaction_date', 'created_by', 'status'];


    public function userInfo(){
        return $this->belongsTo(UserInfo::class);
    }

    public function studentChargeType(){
        return $this->belongsTo(StudentChargeType::class);
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
