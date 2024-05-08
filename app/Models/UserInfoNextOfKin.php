<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class UserInfoNextOfKin extends Model
{
    use HasFactory;
    use SpatieLogsActivity;

    protected $fillable = [
        'nok_relationship_id', 
        'user_info_id', 
        'nok_full_names', 
        'nok_contact_number', 
        'nok_id_number',
        'nok_address_line1',
        'nok_town',
        'nok_suburb',
        'nok_country_id'
    ];


    public function relationship()
    {
        return $this->belongsTo(NextOfKinRelationship::class, 'nok_relationship_id');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'nok_country_id');
    }
}
