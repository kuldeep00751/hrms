<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class CreditMemo extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['user_info_id', 'amount', 'transaction_id', 'transaction_description', 'transaction_date', 'created_by'];

    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
