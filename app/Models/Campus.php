<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class Campus extends Model
{
    
    use SpatieLogsActivity;
    use SpatieLogsActivity;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'campuses';

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
                    'address_line_1',
                    'address_line_2',
                    'address_line_3',
                    'bank_name',
                    'account_number',
                    'branch_name',
                    'branch_code',
                    'swift_code',
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
