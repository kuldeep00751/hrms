<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class OtherFee extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = [
        'fee_type_id',
        'academic_year_id',
        'created_by',
        'amount',
        'student_type_id',
        'academic_process',
        'qualification_id',
        'year_level_id',
        'active'
    ];

    public function studentType()
    {
        return $this->belongsTo(StudentType::class);
    }


    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    public function yearLevel()
    {
        return $this->belongsTo(YearLevel::class);
    }
}
