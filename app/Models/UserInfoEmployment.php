<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class UserInfoEmployment extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = [
        'user_info_id',
        'position',
        'department',
        'company_name',
        'company_address',
        'work_contact_number',
        'work_email'
    ];
}
