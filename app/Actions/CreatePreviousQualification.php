<?php

namespace App\Actions;

use App\Models\UserInfoPreviousQualification;
use Storage;

class CreatePreviousQualification
{
    public function create($data, $user_info)
    {
        if (isset($data['qualification_name'])) {
            
            $uploadedDocuments = $user_info->previousQualification()->select('document_path')->get();
            
            foreach ($uploadedDocuments  as $document) {
                if(!is_null($document->document_path)){
                    Storage::delete($document->document_path);
                }
            }

            $user_info->previousQualification()->delete();
            
            for ($i = 0; $i < count($data['qualification_name']); $i++) {
                
                $path = '';

                if (isset($data['previous_qualification_document'][$i])) {
                    
                    $uploadedDocuments = $user_info->previousQualification()->select('document_path')->get();

                    $path = $this->uploadPreviousQualificationDocument($data['previous_qualification_document'][$i]);
                }

                UserInfoPreviousQualification::create([
                    'level_id' => $data['level_id'][$i],
                    'student_number' => $data['student_number'][$i],
                    'institution' => $data['institution'][$i],
                    'user_info_id' =>  $user_info->id,
                    'qualification_name' => $data['qualification_name'][$i],
                    'awarded_yn' => $data['awarded_yn'][$i],
                    'from_date' => $data['from_date'][$i],
                    'to_date' => $data['to_date'][$i],
                    'document_path' => $path
                ]);
            }
        }
    }

    private function uploadPreviousQualificationDocument($file)
    {
        $path = Storage::putFile('previous-qualification', $file);

        return $path;
    }
}
