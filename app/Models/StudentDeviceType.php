<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDeviceType extends Model
{
    use HasFactory;

    protected $fillable = ['device_type', 'active', 'replaceable', 'valid_months'];
}
