<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class StudentLetter extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = [
        'academic_year_id',
        'letter_name', 
        'academic_intake_id', 
        'qualification_id', 
        'campus_id', 
        'admission_status_id', 
        'content', 
        'application_type_id',
        'study_mode_id'];


    protected $casts = [
        'qualification_id' => 'array',
        'campus_id' => 'array',
        'academic_intake_id' => 'array',
        'admission_status_id' => 'array'
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function academicIntake()
    {
        return $this->belongsTo(AcademicIntake::class);
    }

    public function template()
    {
        return $this->belongsTo(PdfTemplate::class, 'pdf_template_id');
    }

    public static function generateLetter($content, $data)
    {
        // Replace placeholders with actual values
        foreach ($data as $key => $value) {
            $content = str_replace("{{$key}}", $value, $content);
        }

        return $content;
    }
}
