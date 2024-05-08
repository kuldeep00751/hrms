<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class SubjectStudyMode extends Model
{
    use SpatieLogsActivity;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subject_study_modes';

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
                  'study_mode_id'
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
     * Get the studyMode for this model.
     *
     * @return App\Models\StudyMode
     */
    public function studyMode()
    {
        return $this->belongsTo('App\Models\StudyMode','study_mode_id');
    }



}
