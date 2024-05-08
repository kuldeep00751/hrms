<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class StudentDevice extends Model
{
    use HasFactory;
    use SpatieLogsActivity;
    
    protected $fillable = [
                            'student_device_inventory_id',
                            'user_info_id',
                            'academic_year_id',
                            'captured_by',
                            'issue_date',
                            'valid_until'
                        ];


    public function userInfo(){
        return $this->belongsTo(UserInfo::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function studentDeviceInventory(){
        return $this->belongsTo(StudentDeviceInventory::class);
    }
}
