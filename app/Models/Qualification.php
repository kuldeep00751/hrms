<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; use App\Core\Traits\SpatieLogsActivity;

class Qualification extends Model
{
    use SpatieLogsActivity;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'qualifications';

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
                  'qualification_name',
                  'qualification_code',
                  'number_of_years',
                  'qualification_credits',
                  'qualification_type_id',
                  'nqf_level_id'
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
    public function studyModes()
    {
        return $this->hasMany(QualificationStudyMode::class);
    }

    public function campuses()
    {
        return $this->hasMany(QualificationCampus::class);
    }

    public function numberOfYears()
    {
        return $this->belongsTo(YearLevel::class, 'number_of_years', 'id');
    }

    public function nqfLevel()
    {
        return $this->belongsTo(NqfLevel::class);
    }

    public function qualificationType()
    {
        return $this->belongsTo(ApplicationType::class, 'qualification_type_id');
    }

    public function modules(){
        return $this->belongsToMany(Module::class, 'academic_structures');
    }

}
