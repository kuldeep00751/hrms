<?php

namespace App\Actions;

use App\Models\AcademicStructure;

class CreateCurriculum
{
    public function create($data, $id)
    {
        
        foreach ($data['qualification_id'] as $key => $value) {
            AcademicStructure::create(['qualification_id' => $value, 'module_id' =>  $id, 'year_level_id' => $data['year_level_id']]);
        }
    }

    public function update($data, $module)
    {
        $module->qualifications()->detach();

        foreach ($data['qualification_id'] as $key => $value) {
            AcademicStructure::create(['qualification_id' => $value, 'module_id' =>  $module->id, 'year_level_id' => $module->year_level_id]);
        }
    }
}
