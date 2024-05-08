<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDeviceInventory extends Model
{
    use HasFactory;

    protected $fillable = ['device_imei', 'student_device_type_id', 'description', 'remarks', 'status'];


    public function studentDeviceType(){
        return $this->belongsTo(StudentDeviceType::class, 'student_device_type_id');
    }
}
