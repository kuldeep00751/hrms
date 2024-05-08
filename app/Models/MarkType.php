<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class MarkType extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['mark_type'];
}
