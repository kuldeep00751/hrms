<table class="table table-row-dashed table-rounded border">
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Do you suffer from any chronic illness?') }}</th>
        <td>{{ (optional($application->userInfo->healthQuestionnaire)->chronic_illness_yn == 1) ? optional($application->userInfo->healthQuestionnaire)->chronic_illness_description : "No"}}</td>
    </tr>
    <tr>
        <th class="text-start text-gray-400 fw-bold text-uppercase bg-secondary p-3 table-row-bordered">{{ __('Do you have any disability?') }}</th>
        <td>{{ (optional($application->userInfo->healthQuestionnaire)->disability_yn == 1) ? optional($application->userInfo->healthQuestionnaire)->disability_description : "No"}}</td>
        </td>
    </tr>
</table>