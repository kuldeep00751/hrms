<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class Payment extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['user_info_id','payment_date','payment_amount','payment_reference', 'payment_method_id', 'received_by', 'payment_description', 'pop_reference'];


    public function userInfo(){
        return $this->belongsTo(UserInfo::class);
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }
}
