<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class SubjectStudyPeriod extends Model
{
    use SpatieLogsActivity;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subject_study_periods';

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
                  'subject_id',
                  'study_period_id'
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
     * Get the subject for this model.
     *
     * @return App\Models\Subject
     */
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject','subject_id');
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



}
