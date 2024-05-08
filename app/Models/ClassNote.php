<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class ClassNote extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['module_id', 'description', 'document_name', 'uploaded_by', 'published'];

    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function uploadedBy(){
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
