<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use App\Core\Traits\SpatieLogsActivity;
class NextOfKinRelationship extends Model
{
    
    use SpatieLogsActivity;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'next_of_kin_relationships';

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
                  'relationship'
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
