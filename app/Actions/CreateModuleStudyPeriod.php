<?php 

namespace App\Actions;

use App\Models\ModuleStudyMode;
use App\Models\ModuleStudyPeriod;

class CreateModuleStudyPeriod {

    public function create($data, $id)
    {

        foreach ($data['study_mode_id'] as $key => $value) {
            ModuleStudyPeriod::create(['study_period_id' => $value, 'module_id' =>  $id]);
        }
    }

    public function update($data, $module)
    {
        //$module->studyPeriods()->delete();
        ModuleStudyPeriod::where('module_id', $module->id)->delete();

        foreach ($data['study_period_id'] as $key => $value) {
            ModuleStudyPeriod::create(['study_period_id' => $value, 'module_id' =>  $module->id]);
        }
    }
}