<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class StudentNoticeBoardAttachment extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['student_notice_board_id', 'document_name', 'document_path'];
}
