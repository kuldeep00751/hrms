<?php 

namespace App\ModelFilters;

use App\Models\UserInfo;
use EloquentFilter\ModelFilter;

class ApplicationFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    protected $drop_id = false;


    public function academicYear($id)
    {
        return $this->where('academic_year_id', $id);
    }

    public function academicIntake($id)
    {
        return $this->where('academic_intake_id', $id);
    }

    public function applicationType($id)
    {
        return $this->where('application_type_id', $id);
    }

    public function qualification($id)
    {
        return $this->where('qualification_id', $id);
    }

    public function studyMode($id)
    {
        return $this->where('study_mode_id', $id);
    }

    public function campus($id)
    {
        return $this->where('campus_id', $id);
    }

    public function studentNumber($id)
    {
        $userInfo = UserInfo::where('student_number', $id)->first();

        return $this->where('user_info_id', $userInfo->student_number);
    }
}
