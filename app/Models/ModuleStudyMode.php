<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class ModuleStudyMode extends Model
{
    use SpatieLogsActivity;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'module_study_modes';

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
                  'study_mode_id',
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
     * Get the studyMode for this model.
     *
     * @return App\Models\StudyMode
     */
    public function studyMode()
    {
        return $this->belongsTo('App\Models\StudyMode','study_mode_id');
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
