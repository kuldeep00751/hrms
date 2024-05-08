<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use App\Core\Traits\SpatieLogsActivity;

class AcademicYear extends Model
{
    
    use SpatieLogsActivity;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'academic_years';

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
                  'name',
                  'start',
                  'end'
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
    



}
