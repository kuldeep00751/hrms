<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class FeeType extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['fee_type_name'];
}
