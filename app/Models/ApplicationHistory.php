<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class ApplicationHistory extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['application_id', 'admission_status_id', 'remark', 'user_id'];

    public function admissionStatus(){
        return $this->belongsTo(AdmissionStatus::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
