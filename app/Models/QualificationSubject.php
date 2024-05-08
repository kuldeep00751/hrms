<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class QualificationSubject extends Model
{
    use SpatieLogsActivity;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'qualification_subjects';

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
                  'qualification_id',
                  'subject_id'
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
     * Get the qualification for this model.
     *
     * @return App\Models\Qualification
     */
    public function qualification()
    {
        return $this->belongsTo('App\Models\Qualification','qualification_id');
    }

    /**
     * Get the subject for this model.
     *
     * @return App\Models\Subject
     */
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject','subject_id');
    }



}
