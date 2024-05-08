<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class StudentNoticeBoard extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['title', 'slug', 'short_description', 'full_description', 'published', 'posted_by', 'updated_by', 'category'];

    public static function getCategoryClassNames($category){
        switch ($category){
            case 'announcement':
                return "badge badge-primary";
            break;
            case 'information':
                return "badge badge-info";
                break;
            case 'information request':
                return "badge badge-secondary";
                break;
            case 'lost-and-found':
                return "badge badge-warning";
                break;
            case 'selling':
                return "badge badge-success";
                break;
        }
    }

    public function postedBy(){
        return $this->belongsTo(User::class,'posted_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(StudentNoticeBoardAttachment::class);
    }
}
