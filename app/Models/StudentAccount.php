<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class StudentAccount extends Model
{
    use HasFactory;

    protected $fillable = ['user_info_id', 'financial_year_id', 'reference', 'transaction_date', 'transaction_description', 'debit', 'credit', 'transaction_type','model_type', 'model_id'];
}
