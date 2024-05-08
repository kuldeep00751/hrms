<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class Module extends Model
{

    use SpatieLogsActivity;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modules';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'module_code',
                  'module_name',
                  'nqf_level_id',
                'module_credits',
                'module_level_id',
                'year_level_id',
                'lecture_duration'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected $with = ['studyPeriods', 'studyModes', 'moduleLevel', 'nqfLevel', 'qualifications', 'examPapers'];
    

    public function studyPeriods()
    {
        return $this->belongsToMany(StudyPeriod::class, 'module_study_periods');
    }

    public function studyModes()
    {
        return $this->belongsToMany(StudyMode::class, 'module_study_modes');
    }

    public function moduleLevel()
    {
        return $this->belongsTo(ApplicationType::class);
    }

    public function nqfLevel()
    {
        return $this->belongsTo(NqfLevel::class);
    }

    public function qualifications()
    {
        return $this->belongsToMany(Qualification::class, 'academic_structures');
    }

    public function examPapers(){
        return $this->hasMany(ExamPaper::class);
    }

}
