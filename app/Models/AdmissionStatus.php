<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Core\Traits\SpatieLogsActivity;

class AdmissionStatus extends Model
{
    use SpatieLogsActivity;
    use HasFactory;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order',
        'status',
        'description',
        'full_admission'
    ];

}
