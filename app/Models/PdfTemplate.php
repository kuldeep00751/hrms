<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class PdfTemplate extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['name', 'template_path'];
}
