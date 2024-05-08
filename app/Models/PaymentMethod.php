<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Core\Traits\SpatieLogsActivity;

class PaymentMethod extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = ['payment_method', 'payment_receipt_required'];
}
