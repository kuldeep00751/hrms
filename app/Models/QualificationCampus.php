<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class QualificationCampus extends Model
{
    use SpatieLogsActivity;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'qualification_campuses';

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
                  'campus_id',
                  'qualification_id'
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
     * Get the campus for this model.
     *
     * @return App\Models\Campus
     */
    public function campus()
    {
        return $this->belongsTo('App\Models\Campus','campus_id');
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

}
