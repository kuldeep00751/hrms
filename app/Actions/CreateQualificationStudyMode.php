<?php

namespace App\Actions;

use App\Models\QualificationStudyMode;

class CreateQualificationStudyMode {
    public function create($data, $id)
    {

        foreach ($data['study_mode_id'] as $key => $value) {
            QualificationStudyMode::create(['study_mode_id' => $value, 'qualification_id' =>  $id]);
        }
    }

    public function update($data, $qualification)
    {
        $qualification->studyModes()->delete();

        foreach ($data['study_mode_id'] as $key => $value) {
            QualificationStudyMode::create(['study_mode_id' => $value, 'qualification_id' =>  $qualification->id]);
        }
    }
}