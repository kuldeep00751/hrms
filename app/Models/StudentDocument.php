<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class StudentDocument extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['user_info_id', 'required_document_id', 'document_path'];

    public function requiredDocument(){
        return $this->belongsTo(RequiredDocument::class);
    }

    public function userInfo(){
        return $this->belongsTo(UserInfo::class);
    }
}
