<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ModuleRegistrationFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    protected $drop_id = false;


    public function academicYearId($id)
    {
        return $this->where('academic_year_id', $id);
    }

    public function academicIntakeId($id)
    {
        return $this->where('academic_intake_id', $id);
    }

    public function campusId($id)
    {
        return $this->where('campus_id', $id);
    }

    public function assessmentTypeId($id)
    {
        return $this->where('assessment_type_id', $id);
    }

    public function studyModeId($id)
    {
        return $this->where('study_mode_id', $id);
    }

    public function moduleId($id)
    {
        return $this->where('module_id', $id);
    }
}
