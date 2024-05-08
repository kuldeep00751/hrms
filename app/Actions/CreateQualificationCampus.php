<?php

namespace App\Actions;

use App\Models\QualificationCampus;

class CreateQualificationCampus {

    public function create($data, $id) {
        
        foreach ($data['campus_id'] as $key => $value) {
            QualificationCampus::create(['campus_id' => $value, 'qualification_id' =>  $id]);
        }
    }

    public function update($data, $qualification){
        $qualification->campuses()->delete();

        foreach ($data['campus_id'] as $key => $value) {
            QualificationCampus::create(['campus_id' => $value, 'qualification_id' =>  $qualification->id]);
        }
    }
}