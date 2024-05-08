<?php

namespace App\Actions;

use App\Models\ModuleStudyMode;

class CreateModuleStudyMode{
    public function create($data, $id)
    {

        foreach ($data['study_mode_id'] as $key => $value) {
            ModuleStudyMode::create(['study_mode_id' => $value, 'module_id' =>  $id]);
        }
    }

    public function update($data, $module)
    {
        ModuleStudyMode::where('module_id', $module->id)->delete();

        foreach ($data['study_mode_id'] as $key => $value) {
            ModuleStudyMode::create(['study_mode_id' => $value, 'module_id' =>  $module->id]);
        }
    }
}