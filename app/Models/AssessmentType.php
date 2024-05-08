<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class AssessmentType extends Model
{
    use HasFactory;
    use SpatieLogsActivity;
    
    protected $fillable = ['assessment_type','assessment_type_code', 'default', 'maximum_mark'];
}
