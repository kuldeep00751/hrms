<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class GradingScale extends Model
{
    use SpatieLogsActivity;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'grading_scales';

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
                  'matric_type_id',
                  'subject_id',
                  'symbol',
                  'points'
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
     * Get the matricType for this model.
     *
     * @return App\Models\MatricType
     */
    public function matricType()
    {
        return $this->belongsTo('App\Models\MatricType','matric_type_id');
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
