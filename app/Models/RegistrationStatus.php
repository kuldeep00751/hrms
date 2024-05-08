<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class RegistrationStatus extends Model
{
    use HasFactory;
    use SpatieLogsActivity;
    
    protected $fillable = ['status', 'description'];
}
