<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\SpatieLogsActivity;


class RequiredDocument extends Model
{
    use SpatieLogsActivity;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'document_name',
                  'is_required'
              ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
