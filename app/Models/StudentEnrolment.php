<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class StudentEnrolment extends Model
{
    use HasFactory;
    use SpatieLogsActivity;
}
