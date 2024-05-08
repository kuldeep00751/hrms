<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class PromotionStatus extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['promoted', 'description'];
}
