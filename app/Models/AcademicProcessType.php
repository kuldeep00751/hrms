<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class AcademicProcessType extends Model
{
    use SpatieLogsActivity;
    use HasFactory;
}
