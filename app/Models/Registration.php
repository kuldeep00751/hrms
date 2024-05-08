<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;
use EloquentFilter\Filterable;


class Registration extends Model
{
    use HasFactory;
    use Filterable;
    use SpatieLogsActivity;
    use \Awobaz\Compoships\Compoships;

    protected $fillable = [
        'user_info_id',
        'application_id',
        'qualification_id',
        'application_type_id',
        'study_mode_id',
        'campus_id',
        'year_level_id',
        'academic_year_id',
        'academic_intake_id',
        'choice_number',
        'registration_status_id',
        'promotion_status',
        'created_by',
        'updated_by'
    ];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\ApplicationFilter::class);
    }

    public function academicYear()
    {
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

    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function registrationStatus(){
        
        return $this->belongsTo(RegistrationStatus::class);
    }

    public function yearLevel()
    {
        return $this->belongsTo(YearLevel::class);
    }

    public function promotionStatus()
    {
        return $this->belongsTo(PromotionStatus::class, 'promotion_status');
    }

    public function modules()
    {
        return $this->hasMany(ModuleRegistration::class, ['user_info_id', 'study_mode_id','qualification_id', 'campus_id', 'academic_year_id', 'academic_intake_id'], 
                                                         ['user_info_id', 'study_mode_id', 'qualification_id','campus_id', 'academic_year_id', 'academic_intake_id']);
    }

}
