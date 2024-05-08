<?php

namespace App\Actions;

use App\Models\UserInfoNextOfKin;

class CreateNextOfKin
{
    public function create($data, $user_info)
    {
        $user_info->nextOfKin()->delete();

        for ($i=0; $i < count($data['nok_relationship_id']); $i++) {
            UserInfoNextOfKin::create([
                'nok_relationship_id' => $data['nok_relationship_id'][$i],
                'nok_full_names' => $data['nok_full_names'][$i],
                'nok_contact_number' => $data['nok_contact_number'][$i],
                'user_info_id' =>  $user_info->id,
                'nok_id_number' => $data['nok_id_number'][$i] ?? null,
                'nok_address_line1' => $data['nok_address_line1'][$i] ?? null,
                'nok_town' => $data['nok_town'][$i] ?? null,
                'nok_suburb' => $data['nok_suburb'][$i] ?? null,
                'nok_country_id' => $data['nok_country_id'][$i] ?? null
            ]);
        }
    }
}
