<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class AcademicStructure extends Model
{
    use SpatieLogsActivity;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'academic_structures';

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
                  'academic_year_id',
                  'qualification_id',
                  'year_level_id',
                  'study_period_id',
                  'module_id'
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
    
    /**
     * Get the academicYear for this model.
     *
     * @return App\Models\AcademicYear
     */
    public function academicYear()
    {
        return $this->belongsTo('App\Models\AcademicYear','academic_year_id');
    }

    /**
     * Get the qualification for this model.
     *
     * @return App\Models\Qualification
     */
    public function qualification()
    {
        return $this->belongsTo('App\Models\Qualification','qualification_id');
    }

    /**
     * Get the yearLevel for this model.
     *
     * @return App\Models\YearLevel
     */
    public function yearLevel()
    {
        return $this->belongsTo('App\Models\YearLevel','year_level_id');
    }

    /**
     * Get the studyPeriod for this model.
     *
     * @return App\Models\StudyPeriod
     */
    public function studyPeriod()
    {
        return $this->belongsTo('App\Models\StudyPeriod','study_period_id');
    }

    /**
     * Get the module for this model.
     *
     * @return App\Models\Module
     */
    public function module()
    {
        return $this->belongsTo('App\Models\Module','module_id');
    }



}
