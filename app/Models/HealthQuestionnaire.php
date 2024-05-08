<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class HealthQuestionnaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_info_id',
        'chronic_illness_yn',
        'chronic_illness_description',
        'disability_yn',
        'disability_description'
    ];
}
