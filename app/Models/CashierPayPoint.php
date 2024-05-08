<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class CashierPayPoint extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['user_id', 'campus_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}
