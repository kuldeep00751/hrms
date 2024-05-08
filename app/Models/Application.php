<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Core\Traits\SpatieLogsActivity;
use EloquentFilter\Filterable;


class Application extends Model
{
    use HasFactory;
    use Filterable;
    use SpatieLogsActivity;

    protected $fillable = ['user_info_id',
                            'qualification_id',
                            'application_type_id',
                            'study_mode_id',
                            'campus_id',
                            'academic_year_id',
                            'academic_intake_id',
                            'choice_number'];

    protected $with = ['qualification', 'userInfo'];
    
    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\ApplicationFilter::class);
    }
    
    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function academicIntake()
    {
        return $this->belongsTo(AcademicIntake::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    public function applicationType()
    {
        return $this->belongsTo(ApplicationType::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function studyMode()
    {
        return $this->belongsTo(StudyMode::class);
    }
    
    public function userInfo(){
        return $this->belongsTo(UserInfo::class);
    }

    public function applicationHistory(){
        return $this->hasMany(ApplicationHistory::class);
    }

    public function registration(){
        return $this->hasOne(Registration::class);
    }

    public function admissionStatus(){
        return $this->belongsTo(AdmissionStatus::class, 'application_status_id');
    }
}
