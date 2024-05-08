<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CampusesController;
use App\Http\Controllers\GenderTypesController;
use App\Http\Controllers\MatricTypesController;
use App\Http\Controllers\AcademicYearsController;
use App\Http\Controllers\GradingScalesController;
use App\Http\Controllers\Logs\AuditLogsController;
use App\Http\Controllers\SchoolSubjectsController;
use App\Http\Controllers\AcademicIntakesController;
use App\Http\Controllers\Logs\SystemLogsController;
use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\AcademicProcessesController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Documentation\ReferencesController;
use App\Http\Controllers\NextOfKinRelationshipsController;
use App\Http\Controllers\YearLevelsController;
use App\Http\Controllers\QualificationsController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\QualificationCampusesController;
use App\Http\Controllers\QualificationStudyModesController;
use App\Http\Controllers\QualificationSubjectsController;
use App\Http\Controllers\StudyModesController;
use App\Http\Controllers\SubjectStudyModesController;
use App\Http\Controllers\SubjectStudyPeriodsController;
use App\Http\Controllers\StudyPeriodsController;
use App\Http\Controllers\RequiredDocumentsController;
use App\Http\Controllers\ApplicationTypesController;
use App\Http\Controllers\StudentTypesController;
use App\Http\Controllers\TitlesController;
use App\Http\Controllers\NqfLevelsController;
use App\Http\Controllers\ModuleStudyPeriodsController;
use App\Http\Controllers\ModuleStudyModesController;
use App\Http\Controllers\AcademicStructuresController;
use App\Http\Controllers\EducationSystemsController;
use App\Http\Controllers\LovController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdmissionStatusController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\AssessmentTypeController;
use App\Http\Controllers\SubjectFeeController;
use App\Http\Controllers\CourseFeeController;
use App\Http\Controllers\OtherFeeController;
use App\Http\Controllers\FeeTypeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RegistrationStatusController;
use App\Http\Controllers\ModuleRegistrationController;
use App\Http\Controllers\MarkTypeController;
use App\Http\Controllers\ContinuousAssessmentController;
use App\Http\Controllers\CaMarkTypesController;
use App\Http\Controllers\ExamAdmissionCriteriaController;
use App\Http\Controllers\ExamPapersController;
use App\Http\Controllers\StudentExaminationController;
use App\Http\Controllers\StudentFinalMarkController;
use App\Http\Controllers\AssessmentResultCodeController;
use App\Http\Controllers\AssessmentSuppressionController;
use App\Http\Controllers\ExamPaperMarkCriteriaController;
use App\Http\Controllers\FinalMarkCriteriaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\StudentAccountController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\PromotionStatusController;
use App\Http\Controllers\StudentAcademicsController;
use App\Http\Controllers\StudentDocumentController;
use App\Http\Controllers\ModuleCancellationPolicyController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentNoticeBoardController;
use App\Http\Controllers\StudentChargeTypeController;
use App\Http\Controllers\StudentBlockController;
use App\Http\Controllers\StudentBlockExceptionController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\ModuleAllocationController;
use App\Http\Controllers\StudentDocsController;
use App\Http\Controllers\StudentChargeController;
use App\Http\Controllers\LecturerModulesController;
use App\Http\Controllers\AttendanceRegisterController;
use App\Http\Controllers\StudentStatementController;
use App\Http\Controllers\StudentDeviceController;
use App\Http\Controllers\ExamRegistrationCriteriaController;
use App\Http\Controllers\ExamRegistrationController;
use App\Http\Controllers\DebitMemoController;
use App\Http\Controllers\CreditMemoController;
use App\Http\Controllers\CompanySetupController;
use App\Http\Controllers\ClassNoteController;
use App\Http\Controllers\CashierPayPointController;
use App\Http\Controllers\AcademicDashboardController;
use App\Http\Controllers\CashUpReportController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\FinanceDashboardController;
use App\Http\Controllers\CommunicationLetterTemplateController;
use App\Http\Controllers\StudentLetterController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\EmailLogController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExamMarkCriteriaController;
use App\Http\Controllers\ExamTimetableController;
use App\Http\Controllers\LectureTimetableController;
use App\Http\Controllers\MaritalStatusController;
use App\Http\Controllers\StudentDeviceTypeController;
use App\Http\Controllers\StudentDeviceInventoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentDescriptionController;
use App\Http\Controllers\SpaceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return redirect('index');
// });

Route::get('/email/verify', function () {
     return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
     $request->fulfill();

     return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
     $request->user()->sendEmailVerificationNotification();

     return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

$menu = theme()->getMenu();

array_walk($menu, function ($val) {

    if (isset($val['path'])) {

        $route = Route::get($val['path'], [PagesController::class, 'index']);
        // Exclude documentation from auth middleware
        if (!Str::contains($val['path'], 'documentation')) {
            $route->middleware('auth');
        }

          if (!Str::contains($val['path'], 'student/applications')) {

               $route->middleware('auth');
          }
    }
});



Route::get('start_menu', [PagesController::class, 'startMenu'])->name('start_menu');
Route::get('dashboard/academic', [AcademicDashboardController::class, 'index'])->name('dashboard.academic');
Route::get('dashboard/finance', [FinanceDashboardController::class, 'index'])->name('dashboard.finance');

Route::prefix('access-control')->group(function () {

     Route::get('roles', [RolesController::class, 'index'])->name('roles.role.index');
     Route::get('roles/create', [RolesController::class, 'create'])->name('roles.role.create');
     Route::get('roles/show/{role}', [RolesController::class, 'show'])->name('roles.role.show')->where('id', '[0-9]+');
     Route::get('roles/{role}/edit', [RolesController::class, 'edit'])->name('roles.role.edit')->where('id', '[0-9]+');
     Route::post('roles', [RolesController::class, 'store'])->name('roles.role.store');
     Route::put('roles/{role}', [RolesController::class, 'update'])->name('roles.role.update')->where('id', '[0-9]+');
     Route::delete('roles/{role}', [RolesController::class, 'destroy'])->name('roles.role.destroy')->where('id', '[0-9]+');

     Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions.permission.index');
     Route::get('permissions/create', [PermissionsController::class, 'create'])->name('permissions.permission.create');
     Route::get('permissions/show/{permission}', [PermissionsController::class, 'show'])->name('permissions.permission.show')->where('id', '[0-9]+');
     Route::get('permissions/{permission}/edit', [PermissionsController::class, 'edit'])->name('permissions.permission.edit')->where('id', '[0-9]+');
     Route::post('permissions', [PermissionsController::class, 'store'])->name('permissions.permission.store');
     Route::put('permissions/{permission}', [PermissionsController::class, 'update'])->name('permissions.permission.update')->where('id', '[0-9]+');
     Route::delete('permissions/{permission}', [PermissionsController::class, 'destroy'])->name('permissions.permission.destroy')->where('id', '[0-9]+');
});

Route::prefix('communication')->group(function () {

     Route::get('pdf-template', [CommunicationLetterTemplateController::class, 'index'])->name('communication.pdf-template.index');
     Route::get('pdf-template/create', [CommunicationLetterTemplateController::class, 'create'])->name('communication.pdf-template.create');
     Route::get('pdf-template/{template}/edit', [CommunicationLetterTemplateController::class, 'edit'])->name('communication.pdf-template.edit');
     Route::get('pdf-template/{template}/show', [CommunicationLetterTemplateController::class, 'show'])->name('communication.pdf-template.show');
     Route::get('pdf-template/{template}/delete', [CommunicationLetterTemplateController::class, 'destroy'])->name('communication.pdf-template.delete')->where('id', '[0-9]+');
     Route::post('pdf-template', [CommunicationLetterTemplateController::class, 'store'])->name('communication.pdf-template.store');
     Route::put('pdf-template/{template}', [CommunicationLetterTemplateController::class, 'update'])->name('communication.pdf-template.update')->where('id', '[0-9]+');

     Route::get('letters', [StudentLetterController::class, 'index'])->name('communication.letter.index');
     Route::get('letter/create', [StudentLetterController::class, 'create'])->name('communication.letter.create');
     Route::get('letter/{letter}/edit', [StudentLetterController::class, 'edit'])->name('communication.letter.edit');
     Route::get('letter/{letter}/show', [StudentLetterController::class, 'show'])->name('communication.letter.show');
     Route::get('letter/{letter}/pdf', [StudentLetterController::class, 'previewPdf'])->name('communication.letter.pdf');
     Route::get('letter/{letter}/delete', [StudentLetterController::class, 'destroy'])->name('communication.letter.delete')->where('id', '[0-9]+');
     Route::get('letter/{letter}/email', [StudentLetterController::class, 'sendEmail'])->name('communication.letter.email')->where('id', '[0-9]+');
     Route::post('letter', [StudentLetterController::class, 'store'])->name('communication.letter.store');
     Route::put('letter/{letter}', [StudentLetterController::class, 'update'])->name('communication.letter.update')->where('id', '[0-9]+');
     Route::get('letter/{id}/download', [StudentLetterController::class, 'downloadFromApplication'])->name('download.letter');
     Route::get('email-logs', [EmailLogController::class, 'index'])->name('communication.email-log.index');
     Route::get('download/{letter_id}/{application_id}/letter', [StudentLetterController::class, 'downloadFromEmail']);

});

Route::prefix('student')->group(function(){

     Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
     Route::get('notice/{studentNoticeBoard}', [StudentDashboardController::class, 'showNotice'])->name('notice-boards.student-notice-board.show');
     Route::get('profile', [StudentProfileController::class, 'index'])->name('student.profile');
     Route::get('profile/update-account/{id}', [StudentProfileController::class, 'updateAccount']);
     Route::post('profile/{userInfo}', [StudentProfileController::class, 'updatePassword']);

     Route::get('update-biographical', [SettingsController::class, 'index'])->name(' ');
     Route::get('applications', [ApplicationController::class, 'index'])->name('application.index');
     Route::get('application/create', [ApplicationController::class, 'create'])->name('application.create');
     Route::get('application/show/{id}', [ApplicationController::class, 'show'])->name('application.show');
     Route::get('application/{id}/edit', [ApplicationController::class, 'edit'])->name('application.edit');
     Route::post('application', [ApplicationController::class, 'store'])->name('application.store');
     Route::post('application/{id}', [ApplicationController::class, 'update'])->name('application.update');

     Route::get('documents', [StudentDocumentController::class, 'index'])
     ->name('student_documents.student_document.index');
     Route::get('documents/create', [StudentDocumentController::class, 'create'])
     ->name('student_documents.student_document.create');
     Route::get('documents/show/{studentDocument}', [StudentDocumentController::class, 'show'])
     ->name('student_documents.student_document.show')->where('id', '[0-9]+');
     Route::get('documents/{studentDocument}/edit', [StudentDocumentController::class, 'edit'])
     ->name('student_documents.student_document.edit')->where('id', '[0-9]+');
     Route::post('documents', [StudentDocumentController::class, 'store'])
     ->name('student_documents.student_document.store');
     Route::put('documents/{studentDocument}', [StudentDocumentController::class, 'update'])
     ->name('student_documents.student_document.update')->where('id', '[0-9]+');
     Route::delete('documents/{studentDocument}', [StudentDocumentController::class, 'destroy'])
     ->name('student_documents.student_document.destroy')->where('id', '[0-9]+');


});

Route::prefix('portal')->group(function () {
     Route::get('notice-board', [StudentNoticeBoardController::class, 'index'])->name('notice-boards.notice-board.index');
     Route::get('notice-board/create', [StudentNoticeBoardController::class, 'create'])->name('notice-boards.notice-board.create');
     Route::get('notice-board/show/{noticeBoard}', [StudentNoticeBoardController::class, 'show'])->name('notice-boards.notice-board.show')->where('id', '[0-9]+');
     Route::get('notice-board/{noticeBoard}/edit', [StudentNoticeBoardController::class, 'edit'])->name('notice-boards.notice-board.edit')->where('id', '[0-9]+');
     Route::post('notice-board', [StudentNoticeBoardController::class, 'store'])->name('notice-boards.notice-board.store');
     Route::put('notice-board/{noticeBoard}', [StudentNoticeBoardController::class, 'update'])->name('notice-boards.notice-board.update')->where('id', '[0-9]+');
     Route::delete('notice-board/{noticeBoard}', [StudentNoticeBoardController::class, 'destroy'])->name('notice-boards.notice-board.destroy')->where('id', '[0-9]+');
     Route::get('notice-board/{attachment}/download-attachment', [StudentNoticeBoardController::class, 'download'])->name('notice-boards.notice-board.download')->where('id', '[0-9]+');
     Route::get('notice-board/{attachment}/delete-attachment', [StudentNoticeBoardController::class, 'deleteAttachment'])->name('notice-boards.notice-board.delete-attachment')->where('id', '[0-9]+');

     Route::get('student_block', [StudentBlockController::class, 'index'])->name('student_blocks.student_block.index');
     Route::get('student_block/create', [StudentBlockController::class, 'create'])->name('student_blocks.student_block.create');
     Route::post('student_block', [StudentBlockController::class, 'store'])->name('student_blocks.student_block.store');
     Route::post('student_block/bulk-remove', [StudentBlockController::class, 'bulkRemove'])->name('student_blocks.student_block.bulk-remove');

     Route::get('student_block_exceptions', [StudentBlockExceptionController::class, 'index'])->name('student_block_exceptions.student_block_exception.index');
     Route::get('student_block_exceptions/create', [StudentBlockExceptionController::class, 'create'])->name('student_block_exceptions.student_block_exception.create');
     Route::post('student_block_exceptions', [StudentBlockExceptionController::class, 'store'])->name('student_block_exceptions.student_block_exception.store');
     Route::post('student_block_exceptions/bulk-remove', [StudentBlockExceptionController::class, 'bulkRemove'])->name('student_block_exceptions.student_block_exception.bulk-remove');
     Route::delete('student_block_exceptions/{studentBlockException}', [StudentBlockExceptionController::class, 'destroy'])->name('student_block_exceptions.student_block_exception.destroy')->where('id', '[0-9]+');

     Route::get('student_block/advanced_options', [StudentBlockController::class, 'advancedOptions'])->name('student_blocks.advanced_options.index');
     Route::post('student_block/advanced_options', [StudentBlockController::class, 'storeAdvancedOptions'])->name('student_blocks.advanced_options.store');

});

Route::prefix('student_devices')->group(function () {

     Route::get('/', [StudentDeviceController::class, 'index'])->name('student_devices.index');
     Route::get('create', [StudentDeviceController::class, 'create'])->name('student_devices.create');
     Route::post('/', [StudentDeviceController::class, 'store'])->name('student_devices.store');
     Route::get('filter', [StudentDeviceController::class, 'filter'])->name('student_devices.filter');
     Route::get('{id}/print', [StudentDeviceController::class, 'simReplacement'])->name('student_devices.sim_replacement');
     Route::get('get-student-info/{student_number}', [StudentDeviceController::class, 'getStudentInfo']);
     Route::get('add-device-row/', [StudentDeviceController::class, 'addDeviceRow']);
     Route::get('get-device-info/{deviceImei}', [StudentDeviceController::class, 'getDeviceInfo']);
     Route::delete('delete-student-device/{deviceImei}', [StudentDeviceController::class, 'deleteDevice']);
});


Route::prefix('student_device_types')->group(function () {

     Route::get('/', [StudentDeviceTypeController::class, 'index'])->name('student_device_types.student_device_type.index');
     Route::get('create', [StudentDeviceTypeController::class, 'create'])->name('student_device_types.student_device_type.create');
     Route::get('/{studentDeviceType}/edit', [StudentDeviceTypeController::class, 'edit'])->name('student_device_types.student_device_type.edit')->where('id', '[0-9]+');
     Route::put('student_device_type/{studentDeviceType}', [StudentDeviceTypeController::class, 'update'])->name('student_device_types.student_device_type.update')->where('id', '[0-9]+');
     Route::post('/', [StudentDeviceTypeController::class, 'store'])->name('student_device_types.student_device_type.store');
     Route::post('update-status', [StudentDeviceTypeController::class, 'updateStatus']);
});

Route::group([
     'prefix' => 'student_device_inventory',
], function () {
     Route::get('/', [StudentDeviceInventoryController::class, 'index'])
          ->name('student_device_inventories.student_device_inventory.index');

     Route::get('/create', [StudentDeviceInventoryController::class, 'create'])
          ->name('student_device_inventories.student_device_inventory.create');

     Route::get('/show/{studentDeviceInventory}', [StudentDeviceInventoryController::class, 'show'])
          ->name('student_device_inventories.student_device_inventory.show')->where('id', '[0-9]+');

     Route::get('/{studentDeviceInventory}/edit', [StudentDeviceInventoryController::class, 'edit'])
          ->name('student_device_inventories.student_device_inventory.edit')->where('id', '[0-9]+');

     Route::post('/', [StudentDeviceInventoryController::class, 'store'])
          ->name('student_device_inventories.student_device_inventory.store');

     Route::put('gender_type/{studentDeviceInventory}', [StudentDeviceInventoryController::class, 'update'])
          ->name('student_device_inventories.student_device_inventory.update')->where('id', '[0-9]+');

     Route::delete('/gender_type/{studentDeviceInventory}', [StudentDeviceInventoryController::class, 'destroy'])
          ->name('student_device_inventories.student_device_inventory.destroy')->where('id', '[0-9]+');
});


Route::prefix('student_bio')->group(function () {
     Route::get('/', [UserInfoController::class, 'index'])->name('user_infos.user_info.index');

     Route::get('/create', [UserInfoController::class, 'create'])
     ->name('user_infos.user_info.create');

     Route::get('/create_user_info/{userInfo}', [UserInfoController::class, 'createUserInfo'])
     ->name('user_infos.user_info.create_user_info');

     Route::get('/show/{userInfo}', [UserInfoController::class, 'show'])
     ->name('user_infos.user_info.show')->where('id', '[0-9]+');

     Route::get('/{userInfo}/edit', [UserInfoController::class, 'edit'])
     ->name('user_infos.user_info.edit')->where('id', '[0-9]+');

     Route::post('/', [UserInfoController::class, 'store'])
     ->name('user_infos.user_info.store');

     Route::post('/filter', [UserInfoController::class, 'filter'])
     ->name('user_infos.user_info.filter');

     Route::put('user_info/{userInfo}', [UserInfoController::class, 'update'])
     ->name('user_infos.user_info.update')->where('id', '[0-9]+');

     Route::get('/applications/{userInfo}', [UserInfoController::class, 'userInfoApplications'])->name('user_infos.user_info.applications');
     
     Route::get('/imporsonate/{userInfo}', [UserInfoController::class, 'impersonate'])->name('user_infos.user_info.impersonate');

     Route::get('/applications/{userInfo}/create', [UserInfoController::class, 'createApplication'])->name('user_infos.user_info.create-applications');

     Route::get('/applications/{application}/edit', [UserInfoController::class, 'editApplication'])->name('user_infos.user_info.edit-applications');

     Route::post('/applications/{application}/store', [UserInfoController::class, 'storeApplication'])->name('user_infos.user_info.store-applications');

     Route::post('/applications/{application}/update', [UserInfoController::class, 'updateApplication'])->name('user_infos.user_info.update-applications');

     Route::get('/registration/{userInfo}', [UserInfoController::class, 'registrationInfo'])
     ->name('user_infos.user_info.registration')->where('id', '[0-9]+');

     Route::get('/account/{userInfo}', [UserInfoController::class, 'userInfoAccount'])->name('user_infos.user_info.account');
     Route::post('/account/{userInfo}', [UserInfoController::class, 'updateUserInfoAccount'])->name('user_infos.user_info.account_update');

     Route::get('/documents/{userInfo}', [UserInfoController::class, 'userInfoDocuments'])->name('user_infos.user_info.documents');

});

Route::prefix('student_docs')->group(function () {
     Route::get('academic_record', [StudentDocsController::class, 'academicRecord'])->name('academic_record.index');
     Route::get('academic_record/{userInfoId}/qualifications', [StudentDocsController::class, 'academicRecordStudentQualifications'])->name('academic_record.user_info.qualifications');
     Route::post('academic_record/qualifications', [StudentDocsController::class, 'academicRecordQualifications'])->name('academic_record.qualifications');
     Route::get('academic_record/{qualification_id}/{userInfo}/show', [StudentDocsController::class, 'viewAcademicAcademicRecord'])->name('academic_record.show');
     Route::get('academic_record/{qualification_id}/{userInfo}/print', [StudentDocsController::class, 'printAcademicRecord'])->name('academic_record.print');

     Route::get('proof_of_registration', [StudentDocsController::class, 'proofOfRegistration'])->name('proof_of_registration.index');
     Route::get('proof_of_registration/{registrationId}', [StudentDocsController::class, 'showRegistrationModules'])->name('proof_of_registration.modules.show');
     Route::post('proof_of_registration/show', [StudentDocsController::class, 'showProofOfRegistration'])->name('proof_of_registration.show');
     Route::get('proof_of_registration/print/{id}', [StudentDocsController::class, 'printProofOfRegistration'])->name('proof_of_registration.print');

     Route::get('student_letters', [StudentDocsController::class, 'studentLetterIndex'])->name('student_docs.student_letters.index');
     Route::post('student_letters/download', [StudentDocsController::class, 'downloadStudentLetter'])->name('student_docs.student_letters.download');
     Route::get('student_letters/{userInfoId}/print', [StudentDocsController::class, 'printCreditCertificate'])->name('student_docs.student_letters.print');

});

Route::prefix('admission')->group(function () {
     Route::get('applications', [AdmissionController::class, 'index'])->name('admission.applications.index');
     Route::get('applications/filter', [AdmissionController::class, 'filter'])->name('admission.applications.filter');
     Route::get('applications/filtered', [AdmissionController::class, 'filteredApplications'])->name('admission.applications.filtered');
     Route::get('applications/show/{id}', [AdmissionController::class, 'show'])->name('admission.application.show');
     Route::post('applications/export', [AdmissionController::class, 'export'])->name('admission.application.export');
     Route::get('applications/download/{id}', [AdmissionController::class, 'download'])->name('admission.application.download');
     Route::get('applications/display/{id}', [AdmissionController::class, 'displayDocument'])->name('admission.application.display');
     Route::post('process_application', [AdmissionController::class, 'store'])->name('admission.application.process');
     Route::post('register_application', [AdmissionController::class, 'registerStudent'])->name('admission.application.register');
     Route::get('applications/{notifification_id}/download', [AdmissionController::class, 'downloadExcel'])->name('admission.application.download-excel');
});

Route::prefix('registration')->group(function () {
     Route::get('qualification', [RegistrationController::class, 'index'])->name('registration.qualification.index');
     Route::get('qualification/filter', [RegistrationController::class, 'filter'])->name('registration.qualification.filter');
     Route::get('qualification/show/{id}', [RegistrationController::class, 'show'])->name('registration.qualification.show');
     Route::post('qualification', [RegistrationController::class, 'store'])->name('register.qualification');
     Route::get('qualification/filtered', [RegistrationController::class, 'filteredApplications'])->name('registration.qualification.filtered');

     Route::get('qualification-management', [RegistrationController::class, 'qualificationMangementView'])->name('qualification.qualification-management');
     Route::post('qualification-management', [RegistrationController::class, 'qualificationMangementView'])->name('qualification-management.filter');
     Route::post('qualification/cancel', [RegistrationController::class, 'cancelQualification'])->name('registration.qualification.cancel');
     Route::get('registration/{registration}/edit', [RegistrationController::class, 'edit'])->name('registration.qualification.edit');
     Route::put('qualification/{registration}/update', [RegistrationController::class, 'update'])->name('registration.qualification.update');


     Route::get('modules', [ModuleRegistrationController::class, 'index'])->name('registration.modules.index');
     Route::get('modules/filter', [ModuleRegistrationController::class, 'filter'])->name('registration.modules.filter');
     Route::get('modules/show/{id}', [ModuleRegistrationController::class, 'show'])->name('registration.module.show');
     Route::post('modules', [ModuleRegistrationController::class, 'store'])->name('registration.modules.process');
     Route::get('modules/filtered', [ModuleRegistrationController::class, 'filteredApplications'])->name('registration.modules.filtered');

     Route::post('modules/cancel', [ModuleRegistrationController::class, 'cancelModule'])->name('registration.modules.cancel');
     Route::post('modules/exempt', [ModuleRegistrationController::class, 'exemptModule'])->name('registration.modules.exempt');
     Route::post('modules/reverse-cancellation', [ModuleRegistrationController::class, 'reverseCancellation'])->name('registration.modules.reverse-cancellation');
     Route::post('modules/remove-exemption', [ModuleRegistrationController::class, 'removeExemption'])->name('registration.modules.remove-exemption');

     Route::get('module-management', [ModuleRegistrationController::class, 'moduleMangementView'])->name('registration.modules.module-management');
     Route::post('module-management', [ModuleRegistrationController::class, 'moduleMangementView'])->name('module-management.filter');

     Route::get('module-management/{userInfoID}/{academicYeardId}/add-module', [ModuleRegistrationController::class, 'addModule'])->name('registration.modules.add-module');
     Route::post('module-management/add-module', [ModuleRegistrationController::class, 'registerModule'])->name('registration.modules.register-module');
});

Route::prefix('assessments')->group(function () {
     Route::get('continuous_assessments', [CaMarkTypesController::class, 'index'])->name('assessments.ca.index');
     Route::get('continuous_assessments/filter', [CaMarkTypesController::class, 'filter'])->name('assessments.ca.filter');
     Route::get('continuous_assessments/{moduleAllocationId}/show/{continuousAssessmentTypeId}', [CaMarkTypesController::class, 'showAssessment'])->name('assessments.ca.show');
     Route::get('continuous_assessments/report/{id}', [CaMarkTypesController::class, 'viewAll'])->name('assessments.ca.report');
     Route::get('continuous_assessments/download_report/{id}', [CaMarkTypesController::class, 'downloadCaReport'])->name('assessments.ca.download_ca_report');
     Route::post('continuous_assessments', [CaMarkTypesController::class, 'store'])->name('assessments.ca.store');

     Route::get('examinations', [StudentExaminationController::class, 'index'])->name('assessments.exams.index');
     Route::get('examinations/filter', [StudentExaminationController::class, 'filter'])->name('assessments.exams.filter');
     Route::get('examinations/{moduleRegistration}/show/{examPaper}/{assessmentType}', [StudentExaminationController::class, 'showExam'])->name('assessments.exams.show');
     Route::get('examinations/report/{moduleRegistration}/{assessmentType}', [StudentExaminationController::class, 'viewAll'])->name('assessments.exams.report');
     Route::get('examinations/download_report/{moduleRegistration}/{assessmentType}', [StudentExaminationController::class, 'downloadExamReport'])->name('assessments.exams.download_exam_report');
     Route::post('examinations', [StudentExaminationController::class, 'store'])->name('assessments.exams.store');

     Route::get('final_marks', [StudentFinalMarkController::class, 'index'])->name('assessments.final_marks.index');
     Route::get('final_marks/filter', [StudentFinalMarkController::class, 'filter'])->name('assessments.final_marks.filter');
     Route::post('final_marks/process', [StudentFinalMarkController::class, 'process'])->name('assessments.final_marks.process');
     Route::get('final_marks/report/{moduleAllocationId}/{assessmentTypeId}', [StudentFinalMarkController::class, 'processReportView'])->name('assessments.final_marks.report');
     Route::get('final_marks/download_report/{moduleAllocationId}/{assessmentType}', [StudentFinalMarkController::class, 'downloadExamReport'])->name('assessments.final_marks.download_exam_report');
     Route::post('final_marks', [StudentFinalMarkController::class, 'store'])->name('assessments.final_marks.store');

     Route::get('my_modules', [LecturerModulesController::class, 'index'])->name('assessments.my_modules.index');
     Route::get('my_modules/classlist/{moduleAllocation}', [LecturerModulesController::class, 'viewClasslist'])->name('assessments.my_modules.classlist');
     Route::get('my_modules/download_classlist/{moduleAllocation}', [LecturerModulesController::class, 'downloadClasslist'])->name('assessments.my_modules.download-classlist');

     Route::get('my_modules/attendance_register/{moduleAllocation}', [AttendanceRegisterController::class, 'index'])->name('assessments.attendance_register.index');
     Route::get('my_modules/attendance_register/{moduleAllocation}/create', [AttendanceRegisterController::class, 'create'])->name('assessments.attendance_register.create');
     Route::post('my_modules/attendance_register/store', [AttendanceRegisterController::class, 'store'])->name('assessments.attendance_register.store');
     Route::post('my_modules/attendance_register/{attendanceRegister}/update', [AttendanceRegisterController::class, 'update'])->name('assessments.attendance_register.update');
     Route::get('my_modules/attendance_register/{attendanceRegister}/edit', [AttendanceRegisterController::class, 'edit'])->name('assessments.attendance_register.edit');
     Route::get('my_modules/attendance_register/{attendanceRegister}/show', [AttendanceRegisterController::class, 'show'])->name('assessments.attendance_register.show');
     Route::get('my_modules/attendance_register/{attendanceRegister}/delete', [AttendanceRegisterController::class, 'destroy'])->name('assessments.attendance_register.delete');
     Route::get('my_modules/attendance_register/{attendanceRegister}/download', [AttendanceRegisterController::class, 'downloadSingleRegister'])->name('assessments.attendance_register.download_single');
     Route::get('my_modules/attendance_register/{moduleAllocation}/report', [AttendanceRegisterController::class, 'downloadModuleRegister'])->name('assessments.attendance_register.download_all');

     Route::get('suppressions', [AssessmentSuppressionController::class, 'index'])->name('assessments.suppressions.index');
     Route::get('suppressions/create', [AssessmentSuppressionController::class, 'create'])->name('assessments.suppressions.create');
     Route::get('suppressions/filter', [AssessmentSuppressionController::class, 'filter'])->name('assessments.suppressions.filter');
     Route::get('suppressions/show/{id}', [AssessmentSuppressionController::class, 'show'])->name('assessments.suppressions.show');
     Route::post('suppressions', [AssessmentSuppressionController::class, 'store'])->name('assessments.suppressions.store');
     Route::post('suppressions/suppress', [AssessmentSuppressionController::class, 'suppress'])->name('assessments.suppressions.suppress');

     Route::get('module_allocations', [ModuleAllocationController::class, 'index'])->name('assessments.module_allocations.index');
     Route::get('module_allocations/create', [ModuleAllocationController::class, 'create'])->name('assessments.module_allocations.create');
     Route::put('module_allocations/{moduleAllocation}', [ModuleAllocationController::class, 'update'])->name('assessments.module_allocations.update')->where('id', '[0-9]+');
     Route::get('module_allocations/{moduleAllocation}/edit', [ModuleAllocationController::class, 'edit'])->name('assessments.module_allocations.edit');
     Route::get('module_allocations/filter', [ModuleAllocationController::class, 'filter'])->name('assessments.module_allocations.filter');
     Route::get('module_allocations/show/{id}', [ModuleAllocationController::class, 'show'])->name('assessments.module_allocations.show');
     Route::post('module_allocations', [ModuleAllocationController::class, 'store'])->name('assessments.module_allocations.store');
     Route::delete('module_allocations/{moduleAllocation}', [ModuleAllocationController::class, 'destroy'])->name('assessments.module_allocations.destroy')->where('id', '[0-9]+');
     Route::get('module_allocations/copy', [ModuleAllocationController::class, 'copyView'])->name('assessments.module_allocations.copyView');
     Route::post('module_allocations/copy', [ModuleAllocationController::class, 'copy'])->name('assessments.module_allocations.copy');

     Route::get('exam_registration', [ExamRegistrationController::class, 'index'])->name('assessments.exam_registration.index');
     Route::get('exam_registration/filter', [ExamRegistrationController::class, 'filter'])->name('assessments.exam_registration.get-filter');
     Route::post('exam_registration/filter', [ExamRegistrationController::class, 'filter'])->name('assessments.exam_registration.filter');
     Route::post('exam_registration', [ExamRegistrationController::class, 'store'])->name('assessments.exam_registration.store');

     Route::get('class_notes/{module}', [ClassNoteController::class, 'show'])->name('assessments.my_modules.class_notes');
     Route::post('class_notes', [ClassNoteController::class, 'store'])->name('my_modules.class_notes.store');
     Route::post('class_notes/published-status', [ClassNoteController::class, 'changePublishStatus']);
     Route::get('class_notes/{module}/download', [ClassNoteController::class, 'download'])->name('my_modules.class_notes.download');
     Route::get('class_notes/{module}/delete', [ClassNoteController::class, 'delete'])->name('my_modules.class_notes.delete');


});


Route::prefix('promotion')->group(function () {
     Route::get('/', [PromotionController::class, 'index'])->name('promotion.index');
     Route::get('filter', [PromotionController::class, 'filter'])->name('promotion.filter');
     Route::post('/', [PromotionController::class, 'store'])->name('promotion.store');
     Route::get('transcript/{registrationId}', [PromotionController::class, 'studentTranscript'])->name('promotion.transcript');
});

Route::prefix('student')->group(function () {
     Route::get('academic/proof_of_registration', [StudentAcademicsController::class, 'proofOfRegistration'])->name('academic.proof_of_registration');
     Route::get('academic/proof_of_registration/show/{id}', [StudentAcademicsController::class, 'showProofOfRegistration'])->name('academic.por.show');
     Route::get('academic/proof_of_registration/print/{id}', [StudentAcademicsController::class, 'printProofOfRegistration'])->name('academic.por.print');

     Route::get('academic/assessments', [StudentAcademicsController::class, 'assessment'])->name('academic.assessments');
     Route::get('academic/assessments/show/{id}', [StudentAcademicsController::class, 'viewAssessment'])->name('academic.assessments.view');

     Route::get('academic/examination', [StudentAcademicsController::class, 'examinations'])->name('academic.examinations');
     Route::get('academic/examination/show/{id}', [StudentAcademicsController::class, 'viewExaminations'])->name('academic.examinations.view');

     Route::get('academic/transcript', [StudentAcademicsController::class, 'academicTranscript'])->name('academic.transcript');
     Route::get('academic/transcript/show/{id}', [StudentAcademicsController::class, 'viewAcademicTranscript'])->name('academic.transcript.view');
     Route::get('academic/transcript/print/{id}', [StudentAcademicsController::class, 'printAcademicTranscript'])->name('academic.transcript.print');

     Route::get('academic/my_modules', [StudentAcademicsController::class, 'showStudentModules'])->name('academic.my_modules');
     Route::get('academic/my_modules/{module}/class_notes', [StudentAcademicsController::class, 'showClassNotes'])->name('academic.my_modules.class_notes');

     Route::get('blocked', function(){
          return view('pages.student.blocked');
     })->name('student.block');
});

Route::prefix('account')->group(function () {
     Route::get('statement', [StudentAccountController::class, 'index'])->name('student.statement.index');
});

Route::prefix('finance')->group(function () {
     Route::get('cashup-report', [CashUpReportController::class, 'index'])->name('finance.cashup.index');
     Route::get('cashup-report/{paypoint}/{user}/{paymentDate}', [CashUpReportController::class, 'printReceipt'])->name('finance.cashup.receipt');
     Route::get('cashup-transactions/{paypoint}/{user}/{paymentDate}', [CashUpReportController::class, 'transactions'])->name('finance.cashup.transactions');
     Route::get('cashup-transactions/{paypoint}/{user}/{paymentDate}/print', [CashUpReportController::class, 'printTransactions'])->name('finance.cashup.transactions-print');
     Route::get('cashier-paypoints', [CashierPayPointController::class, 'index'])->name('finance.paypoints.index');
     Route::post('cashier-paypoints', [CashierPayPointController::class, 'store'])->name('finance.paypoints.store');
     Route::get('cashier-paypoints/create', [CashierPayPointController::class, 'create'])->name('finance.paypoints.create');
     Route::get('cashier-paypoints/{cashierPaypoint}/edit', [CashierPayPointController::class, 'edit'])->name('finance.paypoints.edit');
     Route::get('cashier-paypoints/create', [CashierPayPointController::class, 'create'])->name('finance.paypoints.create');
     Route::delete('cashier-paypoints/{cashierPaypoint}', [CashierPayPointController::class, 'destroy'])
     ->name('finance.paypoints.destroy')->where('id', '[0-9]+');

     Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
     Route::get('cashier', [PaymentController::class, 'create'])->name('payments.create');
     Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
     Route::get('payments/filter', [PaymentController::class, 'filter'])->name('payments.filter');
     Route::get('payments/receipt/{id}', [PaymentController::class, 'print'])->name('payments.print');

     Route::get('student_charges', [StudentChargeController::class, 'index'])->name('finance.student_charges.index');
     Route::get('student_charges/create', [StudentChargeController::class, 'create'])->name('finance.student_charges.create');
     Route::get('student_charges/create_bulk', [StudentChargeController::class, 'createBulk'])->name('finance.student_charges.createBulk');
     Route::post('student_charges/store_bulk', [StudentChargeController::class, 'storeBulk'])->name('finance.student_charges.storeBulk');
     Route::post('student_charges/store', [StudentChargeController::class, 'store'])->name('finance.student_charges.store');
     Route::post('student_charges/filter', [StudentChargeController::class, 'filter'])->name('finance.student_charges.filter');

     Route::get('debit_memos', [DebitMemoController::class, 'index'])->name('finance.debit_memos.index');
     Route::get('debit_memos/create', [DebitMemoController::class, 'create'])->name('finance.debit_memos.create');
     Route::get('debit_memos/create_bulk', [DebitMemoController::class, 'createBulk'])->name('finance.debit_memos.createBulk');
     Route::post('debit_memos/store_bulk', [DebitMemoController::class, 'storeBulk'])->name('finance.debit_memos.storeBulk');
     Route::post('debit_memos/store', [DebitMemoController::class, 'store'])->name('finance.debit_memos.store');
     Route::post('debit_memos/filter', [DebitMemoController::class, 'filter'])->name('finance.debit_memos.filter');

     Route::get('credit_memos', [CreditMemoController::class, 'index'])->name('finance.credit_memos.index');
     Route::get('credit_memos/create', [CreditMemoController::class, 'create'])->name('finance.credit_memos.create');
     Route::get('credit_memos/create_bulk', [CreditMemoController::class, 'createBulk'])->name('finance.credit_memos.createBulk');
     Route::post('credit_memos/store_bulk', [CreditMemoController::class, 'storeBulk'])->name('finance.credit_memos.storeBulk');
     Route::post('credit_memos/store', [CreditMemoController::class, 'store'])->name('finance.credit_memos.store');
     Route::post('credit_memos/filter', [CreditMemoController::class, 'filter'])->name('finance.credit_memos.filter');

     Route::get('student_statements', [StudentStatementController::class, 'index'])->name('finance.student_statement.index');
     Route::get('student_statements/filter', [StudentStatementController::class, 'filter'])->name('finance.student_statement.filter');
     Route::get('student_statements/{id}/print', [StudentStatementController::class, 'print'])->name('finance.student_statement.print');

});



// Documentations pages
Route::prefix('documentation')->group(function () {
    Route::get('getting-started/references', [ReferencesController::class, 'index']);
    Route::get('getting-started/changelog', [PagesController::class, 'index']);
});
Route::group(['middleware' => ['role:System']], function () {
     Route::middleware(['auth', 'verified'])->group(function () {
     // Account pages


     // Logs pages
     Route::prefix('log')->name('log.')->group(function () {
          Route::resource('system', SystemLogsController::class)->only(['index', 'destroy']);
          Route::resource('audit', AuditLogsController::class)->only(['index', 'destroy']);
     });

          // Settings pages
          Route::prefix('system')->name('log.')->group(function () {
               Route::get('settings', function(){
                    return view('pages.settings.index');
               });
          });
     });
});
Route::prefix('account')->group(function () {
     Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
     Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
     Route::put('settings/email', [SettingsController::class, 'changeEmail'])->name('settings.changeEmail');
     Route::put('settings/password', [SettingsController::class, 'changePassword'])->name('settings.changePassword');
});


Route::resource('users', UsersController::class);
Route::get('users/{userId}/access-control', [UsersController::class, 'accessControlView'])->name('users.access-control');
Route::post('/user/assign-permission', [UsersController::class, 'assignPermission'])->name('user.assign-permission');
Route::post('/user/remove-permission', [UsersController::class, 'removePermission'])->name('user.remove-permission');
Route::post('/user/assign-role', [UsersController::class, 'assignRole'])->name('user.assign-role');
Route::post('/user/remove-role', [UsersController::class, 'removeRole'])->name('user.remove-role');


/**
 * Socialite login using Google service
 * https://laravel.com/docs/8.x/socialite
 */
Route::get('/auth/redirect/{provider}', [SocialiteLoginController::class, 'redirect']);

require __DIR__.'/auth.php';
Route::group(['middleware' => ['permission:access-academic-intakes']], function () {
     Route::group([
     'prefix' => 'academic_intakes',
     ], function () {
     Route::get('/', [AcademicIntakesController::class, 'index'])
          ->name('academic_intakes.academic_intake.index');
     Route::get('/create', [AcademicIntakesController::class, 'create'])
          ->name('academic_intakes.academic_intake.create');
     Route::get('/show/{academicIntake}',[AcademicIntakesController::class, 'show'])
          ->name('academic_intakes.academic_intake.show')->where('id', '[0-9]+');
     Route::get('/{academicIntake}/edit',[AcademicIntakesController::class, 'edit'])
          ->name('academic_intakes.academic_intake.edit')->where('id', '[0-9]+');
     Route::post('/', [AcademicIntakesController::class, 'store'])
          ->name('academic_intakes.academic_intake.store');
     Route::put('academic_intake/{academicIntake}', [AcademicIntakesController::class, 'update'])
          ->name('academic_intakes.academic_intake.update')->where('id', '[0-9]+');
     Route::delete('/academic_intake/{academicIntake}',[AcademicIntakesController::class, 'destroy'])
          ->name('academic_intakes.academic_intake.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [AcademicIntakesController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-academic-years']], function () {
     Route::group([
     'prefix' => 'academic_years',
     ], function () {
     Route::get('/', [AcademicYearsController::class, 'index'])
          ->name('academic_years.academic_year.index');

     Route::get('/create', [AcademicYearsController::class, 'create'])
          ->name('academic_years.academic_year.create');

     Route::get('/show/{academicYear}',[AcademicYearsController::class, 'show'])
          ->name('academic_years.academic_year.show')->where('id', '[0-9]+');

     Route::get('/{academicYear}/edit',[AcademicYearsController::class, 'edit'])
          ->name('academic_years.academic_year.edit')->where('id', '[0-9]+');

     Route::post('/', [AcademicYearsController::class, 'store'])
          ->name('academic_years.academic_year.store');

     Route::put('academic_year/{academicYear}', [AcademicYearsController::class, 'update'])
          ->name('academic_years.academic_year.update')->where('id', '[0-9]+');

     Route::delete('/academic_year/{academicYear}',[AcademicYearsController::class, 'destroy'])
          ->name('academic_years.academic_year.destroy')->where('id', '[0-9]+');
     });
});
Route::group(['middleware' => ['permission:access-academic-processes']], function () {
     Route::group([
     'prefix' => 'academic_processes',
     ], function () {
     Route::get('/', [AcademicProcessesController::class, 'index'])
          ->name('academic_processes.academic_process.index');
     Route::get('/create/{processType}', [AcademicProcessesController::class, 'create'])
          ->name('academic_processes.academic_process.create');
     Route::get('/show/{academicProcess}',[AcademicProcessesController::class, 'show'])
          ->name('academic_processes.academic_process.show')->where('id', '[0-9]+');
     Route::get('/{academicProcess}/edit',[AcademicProcessesController::class, 'edit'])
          ->name('academic_processes.academic_process.edit')->where('id', '[0-9]+');
     Route::post('/', [AcademicProcessesController::class, 'store'])
          ->name('academic_processes.academic_process.store');
     Route::put('academic_process/{academicProcess}', [AcademicProcessesController::class, 'update'])
          ->name('academic_processes.academic_process.update')->where('id', '[0-9]+');
     Route::delete('/academic_process/{academicProcess}',[AcademicProcessesController::class, 'destroy'])
          ->name('academic_processes.academic_process.destroy')->where('id', '[0-9]+');
     });
});
Route::group(['middleware' => ['permission:access-campuses']], function () {
     Route::group([
     'prefix' => 'campuses',
     ], function () {
     Route::get('/', [CampusesController::class, 'index'])
          ->name('campuses.campus.index');
     Route::get('/create', [CampusesController::class, 'create'])
          ->name('campuses.campus.create');
     Route::get('/show/{campus}',[CampusesController::class, 'show'])
          ->name('campuses.campus.show')->where('id', '[0-9]+');
     Route::get('/{campus}/edit',[CampusesController::class, 'edit'])
          ->name('campuses.campus.edit')->where('id', '[0-9]+');
     Route::post('/', [CampusesController::class, 'store'])
          ->name('campuses.campus.store');
     Route::put('campus/{campus}', [CampusesController::class, 'update'])
          ->name('campuses.campus.update')->where('id', '[0-9]+');
     Route::delete('/campus/{campus}',[CampusesController::class, 'destroy'])
          ->name('campuses.campus.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [CampusesController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-spaces']], function () {
     Route::group([
          'prefix' => 'spaces',
     ], function () {
          Route::get('/', [SpaceController::class, 'index'])
               ->name('spaces.space.index');
          Route::get('/create', [SpaceController::class, 'create'])
               ->name('spaces.space.create');
          Route::get('/show/{space}', [SpaceController::class, 'show'])
               ->name('spaces.space.show')->where('id', '[0-9]+');
          Route::get('/{space}/edit', [SpaceController::class, 'edit'])
               ->name('spaces.space.edit')->where('id', '[0-9]+');
          Route::post('/', [SpaceController::class, 'store'])
               ->name('spaces.space.store');
          Route::put('space/{space}', [SpaceController::class, 'update'])
               ->name('spaces.space.update')->where('id', '[0-9]+');
          Route::delete('/space/{space}', [SpaceController::class, 'destroy'])
               ->name('spaces.space.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [SpaceController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-class-timetable']], function () {
     Route::group([
          'prefix' => 'timetable',
     ], function () {
          Route::get('/', [SpaceController::class, 'index'])
               ->name('spaces.space.index');
          Route::get('/create', [SpaceController::class, 'create'])
               ->name('spaces.space.create');
          Route::get('/show/{space}', [SpaceController::class, 'show'])
               ->name('spaces.space.show')->where('id', '[0-9]+');
          Route::get('/{space}/edit', [SpaceController::class, 'edit'])
               ->name('spaces.space.edit')->where('id', '[0-9]+');
          Route::post('/', [SpaceController::class, 'store'])
               ->name('spaces.space.store');
          Route::put('space/{space}', [SpaceController::class, 'update'])
               ->name('spaces.space.update')->where('id', '[0-9]+');
          Route::delete('/space/{space}', [SpaceController::class, 'destroy'])
               ->name('spaces.space.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [SpaceController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-class-timetable', 'permission:access-exam-timetable']], function () {
     Route::group([
          'prefix' => 'timetable',
     ], function () {
          Route::get('/lecture', [LectureTimetableController::class, 'index'])
               ->name('timetable.lecture.index');

          Route::get('/lecture/create', [LectureTimetableController::class, 'create'])
               ->name('timetable.lecture.create');

          Route::post('/lecture', [LectureTimetableController::class, 'store'])
               ->name('timetable.lecture.store');

          Route::put('lecture/{timetable}', [LectureTimetableController::class, 'update'])
               ->name('timetable.lecture.update')->where('id', '[0-9]+');

          Route::delete('/lecture/{timetable}', [LectureTimetableController::class, 'destroy'])
               ->name('timetable.lecture.destroy')->where('id', '[0-9]+');

          Route::get('/exam', [ExamTimetableController::class, 'index'])
               ->name('timetable.exam.index');

          Route::get('/exam/create', [ExamTimetableController::class, 'create'])
               ->name('timetable.exam.create');

          Route::post('/exam', [ExamTimetableController::class, 'store'])
               ->name('timetable.exam.store');

          Route::put('exam/{timetable}', [ExamTimetableController::class, 'update'])
               ->name('timetable.exam.update')->where('id', '[0-9]+');

          Route::delete('/exam/{timetable}', [ExamTimetableController::class, 'destroy'])
               ->name('timetable.exam.destroy')->where('id', '[0-9]+');

     });
});

Route::group(['middleware' => ['permission:access-company-setup']], function () {
     Route::group([
          'prefix' => 'company_setups',
     ], function () {
          Route::get('/', [CompanySetupController::class, 'index'])
               ->name('company_setups.company_setup.index');
          Route::get('/create', [CompanySetupController::class, 'create'])
               ->name('company_setups.company_setup.create');
          Route::get('/show/{companySetup}', [CompanySetupController::class, 'show'])
               ->name('company_setups.company_setup.show')->where('id', '[0-9]+');
          Route::get('/{companySetup}/edit', [CompanySetupController::class, 'edit'])
               ->name('company_setups.company_setup.edit')->where('id', '[0-9]+');
          Route::post('/', [CompanySetupController::class, 'store'])
               ->name('company_setups.company_setup.store');
          Route::put('campus/{companySetup}', [CompanySetupController::class, 'update'])
               ->name('company_setups.company_setup.update')->where('id', '[0-9]+');
          Route::delete('/campus/{companySetup}', [CompanySetupController::class, 'destroy'])
               ->name('company_setups.company_setup.destroy')->where('id', '[0-9]+');
     });
});
Route::group(['middleware' => ['permission:access-metric-subjects']], function () {
     Route::group([
     'prefix' => 'school_subjects',
     ], function () {
     Route::get('/', [SchoolSubjectsController::class, 'index'])
          ->name('school_subjects.school_subject.index');
     Route::get('/create', [SchoolSubjectsController::class, 'create'])
          ->name('school_subjects.school_subject.create');
     Route::get('/show/{schoolSubject}',[SchoolSubjectsController::class, 'show'])
          ->name('school_subjects.school_subject.show')->where('id', '[0-9]+');
     Route::get('/{schoolSubject}/edit',[SchoolSubjectsController::class, 'edit'])
          ->name('school_subjects.school_subject.edit')->where('id', '[0-9]+');
     Route::post('/', [SchoolSubjectsController::class, 'store'])
          ->name('school_subjects.school_subject.store');
     Route::put('school_subject/{schoolSubject}', [SchoolSubjectsController::class, 'update'])
          ->name('school_subjects.school_subject.update')->where('id', '[0-9]+');
     Route::delete('/school_subject/{schoolSubject}',[SchoolSubjectsController::class, 'destroy'])
          ->name('school_subjects.school_subject.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [SchoolSubjectsController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-matric-types']], function () {
     Route::group([
     'prefix' => 'matric_types',
     ], function () {
     Route::get('/', [MatricTypesController::class, 'index'])
          ->name('matric_types.matric_type.index');
     Route::get('/create', [MatricTypesController::class, 'create'])
          ->name('matric_types.matric_type.create');
     Route::get('/show/{matricType}',[MatricTypesController::class, 'show'])
          ->name('matric_types.matric_type.show')->where('id', '[0-9]+');
     Route::get('/{matricType}/edit',[MatricTypesController::class, 'edit'])
          ->name('matric_types.matric_type.edit')->where('id', '[0-9]+');
     Route::post('/', [MatricTypesController::class, 'store'])
          ->name('matric_types.matric_type.store');
     Route::put('matric_type/{matricType}', [MatricTypesController::class, 'update'])
          ->name('matric_types.matric_type.update')->where('id', '[0-9]+');
     Route::delete('/matric_type/{matricType}',[MatricTypesController::class, 'destroy'])
          ->name('matric_types.matric_type.destroy')->where('id', '[0-9]+');
     });
});

Route::group(['middleware' => ['permission:access-matric-types']], function () {
     Route::group([
     'prefix' => 'grading_scales',
     ], function () {
     Route::get('/', [GradingScalesController::class, 'index'])
          ->name('grading_scales.grading_scale.index');
     Route::get('/create', [GradingScalesController::class, 'create'])
          ->name('grading_scales.grading_scale.create');
     Route::get('/show/{gradingScale}',[GradingScalesController::class, 'show'])
          ->name('grading_scales.grading_scale.show')->where('id', '[0-9]+');
     Route::get('/{gradingScale}/edit',[GradingScalesController::class, 'edit'])
          ->name('grading_scales.grading_scale.edit')->where('id', '[0-9]+');
     Route::post('/', [GradingScalesController::class, 'store'])
          ->name('grading_scales.grading_scale.store');
     Route::put('grading_scale/{gradingScale}', [GradingScalesController::class, 'update'])
          ->name('grading_scales.grading_scale.update')->where('id', '[0-9]+');
     Route::delete('/grading_scale/{gradingScale}',[GradingScalesController::class, 'destroy'])
          ->name('grading_scales.grading_scale.destroy')->where('id', '[0-9]+');
     });
});

Route::group(['middleware' => ['permission:access-gender']], function () {
     Route::group([
     'prefix' => 'gender_types',
     ], function () {
     Route::get('/', [GenderTypesController::class, 'index'])
          ->name('gender_types.gender_type.index');
     Route::get('/create', [GenderTypesController::class, 'create'])
          ->name('gender_types.gender_type.create');
     Route::get('/show/{genderType}',[GenderTypesController::class, 'show'])
          ->name('gender_types.gender_type.show')->where('id', '[0-9]+');
     Route::get('/{genderType}/edit',[GenderTypesController::class, 'edit'])
          ->name('gender_types.gender_type.edit')->where('id', '[0-9]+');
     Route::post('/', [GenderTypesController::class, 'store'])
          ->name('gender_types.gender_type.store');
     Route::put('gender_type/{genderType}', [GenderTypesController::class, 'update'])
          ->name('gender_types.gender_type.update')->where('id', '[0-9]+');
     Route::delete('/gender_type/{genderType}',[GenderTypesController::class, 'destroy'])
          ->name('gender_types.gender_type.destroy')->where('id', '[0-9]+');
     });
});

Route::group(['middleware' => ['permission:access-nok-relationship']], function () {
     Route::group([
     'prefix' => 'next_of_kin_relationships',
     ], function () {
     Route::get('/', [NextOfKinRelationshipsController::class, 'index'])
          ->name('next_of_kin_relationships.next_of_kin_relationship.index');
     Route::get('/create', [NextOfKinRelationshipsController::class, 'create'])
          ->name('next_of_kin_relationships.next_of_kin_relationship.create');
     Route::get('/show/{nextOfKinRelationship}',[NextOfKinRelationshipsController::class, 'show'])
          ->name('next_of_kin_relationships.next_of_kin_relationship.show')->where('id', '[0-9]+');
     Route::get('/{nextOfKinRelationship}/edit',[NextOfKinRelationshipsController::class, 'edit'])
          ->name('next_of_kin_relationships.next_of_kin_relationship.edit')->where('id', '[0-9]+');
     Route::post('/', [NextOfKinRelationshipsController::class, 'store'])
          ->name('next_of_kin_relationships.next_of_kin_relationship.store');
     Route::put('next_of_kin_relationship/{nextOfKinRelationship}', [NextOfKinRelationshipsController::class, 'update'])
          ->name('next_of_kin_relationships.next_of_kin_relationship.update')->where('id', '[0-9]+');
     Route::delete('/next_of_kin_relationship/{nextOfKinRelationship}',[NextOfKinRelationshipsController::class, 'destroy'])
          ->name('next_of_kin_relationships.next_of_kin_relationship.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [NextOfKinRelationshipsController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-year-levels']], function () {
     Route::group([
     'prefix' => 'year_levels',
     ], function () {
     Route::get('/', [YearLevelsController::class, 'index'])
          ->name('year_levels.year_level.index');
     Route::get('/create', [YearLevelsController::class, 'create'])
          ->name('year_levels.year_level.create');
     Route::get('/show/{yearLevel}',[YearLevelsController::class, 'show'])
          ->name('year_levels.year_level.show')->where('id', '[0-9]+');
     Route::get('/{yearLevel}/edit',[YearLevelsController::class, 'edit'])
          ->name('year_levels.year_level.edit')->where('id', '[0-9]+');
     Route::post('/', [YearLevelsController::class, 'store'])
          ->name('year_levels.year_level.store');
     Route::put('year_level/{yearLevel}', [YearLevelsController::class, 'update'])
          ->name('year_levels.year_level.update')->where('id', '[0-9]+');
     Route::delete('/year_level/{yearLevel}',[YearLevelsController::class, 'destroy'])
          ->name('year_levels.year_level.destroy')->where('id', '[0-9]+');
     });
});

Route::group(['middleware' => ['permission:access-qualifications']], function () {
     Route::group([
     'prefix' => 'qualifications',
     ], function () {
     Route::get('/', [QualificationsController::class, 'index'])
          ->name('qualifications.qualification.index');
     Route::get('/create', [QualificationsController::class, 'create'])
          ->name('qualifications.qualification.create');
     Route::get('/show/{qualification}',[QualificationsController::class, 'show'])
          ->name('qualifications.qualification.show')->where('id', '[0-9]+');
     Route::get('/{qualification}/edit',[QualificationsController::class, 'edit'])
          ->name('qualifications.qualification.edit')->where('id', '[0-9]+');
     Route::post('/', [QualificationsController::class, 'store'])
          ->name('qualifications.qualification.store');
     Route::put('qualification/{qualification}', [QualificationsController::class, 'update'])
          ->name('qualifications.qualification.update')->where('id', '[0-9]+');
     Route::delete('/qualification/{qualification}',[QualificationsController::class, 'destroy'])
          ->name('qualifications.qualification.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [QualificationsController::class, 'updateStatus']);
     });
});


Route::group(['middleware' => ['permission:access-modules']], function () {
     Route::group([
     'prefix' => 'modules',
     ], function () {
     Route::get('/', [ModulesController::class, 'index'])
          ->name('modules.module.index');
     Route::get('/create', [ModulesController::class, 'create'])
          ->name('modules.module.create');
     Route::get('/show/{module}',[ModulesController::class, 'show'])
          ->name('modules.module.show')->where('id', '[0-9]+');
     Route::get('/{module}/edit',[ModulesController::class, 'edit'])
          ->name('modules.module.edit')->where('id', '[0-9]+');
     Route::post('/', [ModulesController::class, 'store'])
          ->name('modules.module.store');
     Route::put('module/{module}', [ModulesController::class, 'update'])
          ->name('modules.module.update')->where('id', '[0-9]+');
     Route::delete('/module/{module}',[ModulesController::class, 'destroy'])
          ->name('modules.module.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [ModulesController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-qualifications']], function () {
     Route::group([
     'prefix' => 'qualification_campuses',
     ], function () {
     Route::get('/', [QualificationCampusesController::class, 'index'])
          ->name('qualification_campuses.qualification_campus.index');
     Route::get('/create', [QualificationCampusesController::class, 'create'])
          ->name('qualification_campuses.qualification_campus.create');
     Route::get('/show/{qualificationCampus}',[QualificationCampusesController::class, 'show'])
          ->name('qualification_campuses.qualification_campus.show')->where('id', '[0-9]+');
     Route::get('/{qualificationCampus}/edit',[QualificationCampusesController::class, 'edit'])
          ->name('qualification_campuses.qualification_campus.edit')->where('id', '[0-9]+');
     Route::post('/', [QualificationCampusesController::class, 'store'])
          ->name('qualification_campuses.qualification_campus.store');
     Route::put('qualification_campus/{qualificationCampus}', [QualificationCampusesController::class, 'update'])
          ->name('qualification_campuses.qualification_campus.update')->where('id', '[0-9]+');
     Route::delete('/qualification_campus/{qualificationCampus}',[QualificationCampusesController::class, 'destroy'])
          ->name('qualification_campuses.qualification_campus.destroy')->where('id', '[0-9]+');
     });
});

Route::group([
    'prefix' => 'qualification_study_modes',
], function () {
    Route::get('/', [QualificationStudyModesController::class, 'index'])
         ->name('qualification_study_modes.qualification_study_mode.index');
    Route::get('/create', [QualificationStudyModesController::class, 'create'])
         ->name('qualification_study_modes.qualification_study_mode.create');
    Route::get('/show/{qualificationStudyMode}',[QualificationStudyModesController::class, 'show'])
         ->name('qualification_study_modes.qualification_study_mode.show')->where('id', '[0-9]+');
    Route::get('/{qualificationStudyMode}/edit',[QualificationStudyModesController::class, 'edit'])
         ->name('qualification_study_modes.qualification_study_mode.edit')->where('id', '[0-9]+');
    Route::post('/', [QualificationStudyModesController::class, 'store'])
         ->name('qualification_study_modes.qualification_study_mode.store');
    Route::put('qualification_study_mode/{qualificationStudyMode}', [QualificationStudyModesController::class, 'update'])
         ->name('qualification_study_modes.qualification_study_mode.update')->where('id', '[0-9]+');
    Route::delete('/qualification_study_mode/{qualificationStudyMode}',[QualificationStudyModesController::class, 'destroy'])
         ->name('qualification_study_modes.qualification_study_mode.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'qualification_subjects',
], function () {
    Route::get('/', [QualificationSubjectsController::class, 'index'])
         ->name('qualification_subjects.qualification_subject.index');
    Route::get('/create', [QualificationSubjectsController::class, 'create'])
         ->name('qualification_subjects.qualification_subject.create');
    Route::get('/show/{qualificationSubject}',[QualificationSubjectsController::class, 'show'])
         ->name('qualification_subjects.qualification_subject.show')->where('id', '[0-9]+');
    Route::get('/{qualificationSubject}/edit',[QualificationSubjectsController::class, 'edit'])
         ->name('qualification_subjects.qualification_subject.edit')->where('id', '[0-9]+');
    Route::post('/', [QualificationSubjectsController::class, 'store'])
         ->name('qualification_subjects.qualification_subject.store');
    Route::put('qualification_subject/{qualificationSubject}', [QualificationSubjectsController::class, 'update'])
         ->name('qualification_subjects.qualification_subject.update')->where('id', '[0-9]+');
    Route::delete('/qualification_subject/{qualificationSubject}',[QualificationSubjectsController::class, 'destroy'])
         ->name('qualification_subjects.qualification_subject.destroy')->where('id', '[0-9]+');
});

Route::group(['middleware' => ['permission:access-study-modes']], function () {
     Route::group([
     'prefix' => 'study_modes',
     ], function () {
     Route::get('/', [StudyModesController::class, 'index'])
          ->name('study_modes.study_mode.index');
     Route::get('/create', [StudyModesController::class, 'create'])
          ->name('study_modes.study_mode.create');
     Route::get('/show/{studyMode}',[StudyModesController::class, 'show'])
          ->name('study_modes.study_mode.show')->where('id', '[0-9]+');
     Route::get('/{studyMode}/edit',[StudyModesController::class, 'edit'])
          ->name('study_modes.study_mode.edit')->where('id', '[0-9]+');
     Route::post('/', [StudyModesController::class, 'store'])
          ->name('study_modes.study_mode.store');
     Route::put('study_mode/{studyMode}', [StudyModesController::class, 'update'])
          ->name('study_modes.study_mode.update')->where('id', '[0-9]+');
     Route::delete('/study_mode/{studyMode}',[StudyModesController::class, 'destroy'])
          ->name('study_modes.study_mode.destroy')->where('id', '[0-9]+');

     Route::post('update-status', [StudyModesController::class, 'updateStatus']);

     });
});

Route::group([
    'prefix' => 'subject_study_modes',
], function () {
    Route::get('/', [SubjectStudyModesController::class, 'index'])
         ->name('subject_study_modes.subject_study_mode.index');
    Route::get('/create', [SubjectStudyModesController::class, 'create'])
         ->name('subject_study_modes.subject_study_mode.create');
    Route::get('/show/{subjectStudyMode}',[SubjectStudyModesController::class, 'show'])
         ->name('subject_study_modes.subject_study_mode.show')->where('id', '[0-9]+');
    Route::get('/{subjectStudyMode}/edit',[SubjectStudyModesController::class, 'edit'])
         ->name('subject_study_modes.subject_study_mode.edit')->where('id', '[0-9]+');
    Route::post('/', [SubjectStudyModesController::class, 'store'])
         ->name('subject_study_modes.subject_study_mode.store');
    Route::put('subject_study_mode/{subjectStudyMode}', [SubjectStudyModesController::class, 'update'])
         ->name('subject_study_modes.subject_study_mode.update')->where('id', '[0-9]+');
    Route::delete('/subject_study_mode/{subjectStudyMode}',[SubjectStudyModesController::class, 'destroy'])
         ->name('subject_study_modes.subject_study_mode.destroy')->where('id', '[0-9]+');

});

Route::group([
    'prefix' => 'subject_study_periods',
], function () {
    Route::get('/', [SubjectStudyPeriodsController::class, 'index'])
         ->name('subject_study_periods.subject_study_period.index');
    Route::get('/create', [SubjectStudyPeriodsController::class, 'create'])
         ->name('subject_study_periods.subject_study_period.create');
    Route::get('/show/{subjectStudyPeriod}',[SubjectStudyPeriodsController::class, 'show'])
         ->name('subject_study_periods.subject_study_period.show')->where('id', '[0-9]+');
    Route::get('/{subjectStudyPeriod}/edit',[SubjectStudyPeriodsController::class, 'edit'])
         ->name('subject_study_periods.subject_study_period.edit')->where('id', '[0-9]+');
    Route::post('/', [SubjectStudyPeriodsController::class, 'store'])
         ->name('subject_study_periods.subject_study_period.store');
    Route::put('subject_study_period/{subjectStudyPeriod}', [SubjectStudyPeriodsController::class, 'update'])
         ->name('subject_study_periods.subject_study_period.update')->where('id', '[0-9]+');
    Route::delete('/subject_study_period/{subjectStudyPeriod}',[SubjectStudyPeriodsController::class, 'destroy'])
         ->name('subject_study_periods.subject_study_period.destroy')->where('id', '[0-9]+');
});

Route::group(['middleware' => ['permission:access-study-periods']], function () {
     Route::group([
     'prefix' => 'study_periods',
     ], function () {
     Route::get('/', [StudyPeriodsController::class, 'index'])
          ->name('study_periods.study_period.index');
     Route::get('/create', [StudyPeriodsController::class, 'create'])
          ->name('study_periods.study_period.create');
     Route::get('/show/{studyPeriod}',[StudyPeriodsController::class, 'show'])
          ->name('study_periods.study_period.show')->where('id', '[0-9]+');
     Route::get('/{studyPeriod}/edit',[StudyPeriodsController::class, 'edit'])
          ->name('study_periods.study_period.edit')->where('id', '[0-9]+');
     Route::post('/', [StudyPeriodsController::class, 'store'])
          ->name('study_periods.study_period.store');
     Route::put('study_period/{studyPeriod}', [StudyPeriodsController::class, 'update'])
          ->name('study_periods.study_period.update')->where('id', '[0-9]+');
     Route::delete('/study_period/{studyPeriod}',[StudyPeriodsController::class, 'destroy'])
          ->name('study_periods.study_period.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [StudyPeriodsController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-required-documents']], function () {
     Route::group([
     'prefix' => 'required_documents',
     ], function () {
     Route::get('/', [RequiredDocumentsController::class, 'index'])
          ->name('required_documents.required_document.index');
     Route::get('/create', [RequiredDocumentsController::class, 'create'])
          ->name('required_documents.required_document.create');
     Route::get('/show/{requiredDocument}',[RequiredDocumentsController::class, 'show'])
          ->name('required_documents.required_document.show')->where('id', '[0-9]+');
     Route::get('/{requiredDocument}/edit',[RequiredDocumentsController::class, 'edit'])
          ->name('required_documents.required_document.edit')->where('id', '[0-9]+');
     Route::post('/', [RequiredDocumentsController::class, 'store'])
          ->name('required_documents.required_document.store');
     Route::put('required_document/{requiredDocument}', [RequiredDocumentsController::class, 'update'])
          ->name('required_documents.required_document.update')->where('id', '[0-9]+');
     Route::delete('/required_document/{requiredDocument}',[RequiredDocumentsController::class, 'destroy'])
          ->name('required_documents.required_document.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [RequiredDocumentsController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-academic-application-types']], function () {

     Route::group([
     'prefix' => 'application_types',
     ], function () {
     Route::get('/', [ApplicationTypesController::class, 'index'])
          ->name('application_types.application_type.index');
     Route::get('/create', [ApplicationTypesController::class, 'create'])
          ->name('application_types.application_type.create');
     Route::get('/show/{applicationType}',[ApplicationTypesController::class, 'show'])
          ->name('application_types.application_type.show')->where('id', '[0-9]+');
     Route::get('/{applicationType}/edit',[ApplicationTypesController::class, 'edit'])
          ->name('application_types.application_type.edit')->where('id', '[0-9]+');
     Route::post('/', [ApplicationTypesController::class, 'store'])
          ->name('application_types.application_type.store');
     Route::put('application_type/{applicationType}', [ApplicationTypesController::class, 'update'])
          ->name('application_types.application_type.update')->where('id', '[0-9]+');
     Route::delete('/application_type/{applicationType}',[ApplicationTypesController::class, 'destroy'])
          ->name('application_types.application_type.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [ApplicationTypesController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-student-types']], function () {
     Route::group([
     'prefix' => 'student_types',
     ], function () {
     Route::get('/', [StudentTypesController::class, 'index'])
          ->name('student_types.student_type.index');
     Route::get('/create', [StudentTypesController::class, 'create'])
          ->name('student_types.student_type.create');
     Route::get('/show/{studentType}',[StudentTypesController::class, 'show'])
          ->name('student_types.student_type.show')->where('id', '[0-9]+');
     Route::get('/{studentType}/edit',[StudentTypesController::class, 'edit'])
          ->name('student_types.student_type.edit')->where('id', '[0-9]+');
     Route::post('/', [StudentTypesController::class, 'store'])
          ->name('student_types.student_type.store');
     Route::put('student_type/{studentType}', [StudentTypesController::class, 'update'])
          ->name('student_types.student_type.update')->where('id', '[0-9]+');
     Route::delete('/student_type/{studentType}',[StudentTypesController::class, 'destroy'])
          ->name('student_types.student_type.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [StudentTypesController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-titles']], function () {
     Route::group([
     'prefix' => 'titles',
     ], function () {
     Route::get('/', [TitlesController::class, 'index'])
          ->name('titles.title.index');
     Route::get('/create', [TitlesController::class, 'create'])
          ->name('titles.title.create');
     Route::get('/show/{title}',[TitlesController::class, 'show'])
          ->name('titles.title.show')->where('id', '[0-9]+');
     Route::get('/{title}/edit',[TitlesController::class, 'edit'])
          ->name('titles.title.edit')->where('id', '[0-9]+');
     Route::post('/', [TitlesController::class, 'store'])
          ->name('titles.title.store');
     Route::put('title/{title}', [TitlesController::class, 'update'])
          ->name('titles.title.update')->where('id', '[0-9]+');
     Route::delete('/title/{title}',[TitlesController::class, 'destroy'])
          ->name('titles.title.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [TitlesController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-nqf-levels']], function () {
     Route::group([
     'prefix' => 'nqf_levels',
     ], function () {
     Route::get('/', [NqfLevelsController::class, 'index'])
          ->name('nqf_levels.nqf_level.index');
     Route::get('/create', [NqfLevelsController::class, 'create'])
          ->name('nqf_levels.nqf_level.create');
     Route::get('/show/{nqfLevel}',[NqfLevelsController::class, 'show'])
          ->name('nqf_levels.nqf_level.show')->where('id', '[0-9]+');
     Route::get('/{nqfLevel}/edit',[NqfLevelsController::class, 'edit'])
          ->name('nqf_levels.nqf_level.edit')->where('id', '[0-9]+');
     Route::post('/', [NqfLevelsController::class, 'store'])
          ->name('nqf_levels.nqf_level.store');
     Route::put('nqf_level/{nqfLevel}', [NqfLevelsController::class, 'update'])
          ->name('nqf_levels.nqf_level.update')->where('id', '[0-9]+');
     Route::delete('/nqf_level/{nqfLevel}',[NqfLevelsController::class, 'destroy'])
          ->name('nqf_levels.nqf_level.destroy')->where('id', '[0-9]+');
     });
});

Route::group([
    'prefix' => 'module_study_periods',
], function () {
    Route::get('/', [ModuleStudyPeriodsController::class, 'index'])
         ->name('module_study_periods.module_study_period.index');
    Route::get('/create', [ModuleStudyPeriodsController::class, 'create'])
         ->name('module_study_periods.module_study_period.create');
    Route::get('/show/{moduleStudyPeriod}',[ModuleStudyPeriodsController::class, 'show'])
         ->name('module_study_periods.module_study_period.show')->where('id', '[0-9]+');
    Route::get('/{moduleStudyPeriod}/edit',[ModuleStudyPeriodsController::class, 'edit'])
         ->name('module_study_periods.module_study_period.edit')->where('id', '[0-9]+');
    Route::post('/', [ModuleStudyPeriodsController::class, 'store'])
         ->name('module_study_periods.module_study_period.store');
    Route::put('module_study_period/{moduleStudyPeriod}', [ModuleStudyPeriodsController::class, 'update'])
         ->name('module_study_periods.module_study_period.update')->where('id', '[0-9]+');
    Route::delete('/module_study_period/{moduleStudyPeriod}',[ModuleStudyPeriodsController::class, 'destroy'])
         ->name('module_study_periods.module_study_period.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'module_study_modes',
], function () {
    Route::get('/', [ModuleStudyModesController::class, 'index'])
         ->name('module_study_modes.module_study_mode.index');
    Route::get('/create', [ModuleStudyModesController::class, 'create'])
         ->name('module_study_modes.module_study_mode.create');
    Route::get('/show/{moduleStudyMode}',[ModuleStudyModesController::class, 'show'])
         ->name('module_study_modes.module_study_mode.show')->where('id', '[0-9]+');
    Route::get('/{moduleStudyMode}/edit',[ModuleStudyModesController::class, 'edit'])
         ->name('module_study_modes.module_study_mode.edit')->where('id', '[0-9]+');
    Route::post('/', [ModuleStudyModesController::class, 'store'])
         ->name('module_study_modes.module_study_mode.store');
    Route::put('module_study_mode/{moduleStudyMode}', [ModuleStudyModesController::class, 'update'])
         ->name('module_study_modes.module_study_mode.update')->where('id', '[0-9]+');
    Route::delete('/module_study_mode/{moduleStudyMode}',[ModuleStudyModesController::class, 'destroy'])
         ->name('module_study_modes.module_study_mode.destroy')->where('id', '[0-9]+');
});

Route::group([
     'prefix' => 'marital_statuses',
], function () {
     Route::get('/', [MaritalStatusController::class, 'index'])
          ->name('marital_statuses.marital_status.index');
     Route::get('/create', [MaritalStatusController::class, 'create'])
          ->name('marital_statuses.marital_status.create');
     Route::get('/show/{maritalStatus}', [MaritalStatusController::class, 'show'])
          ->name('marital_statuses.marital_status.show')->where('id', '[0-9]+');
     Route::get('/{maritalStatus}/edit', [MaritalStatusController::class, 'edit'])
          ->name('marital_statuses.marital_status.edit')->where('id', '[0-9]+');
     Route::post('/', [MaritalStatusController::class, 'store'])
          ->name('marital_statuses.marital_status.store');
     Route::put('module_study_mode/{maritalStatus}', [MaritalStatusController::class, 'update'])
          ->name('marital_statuses.marital_status.update')->where('id', '[0-9]+');
     Route::delete('/module_study_mode/{maritalStatus}', [MaritalStatusController::class, 'destroy'])
          ->name('marital_statuses.marital_status.destroy')->where('id', '[0-9]+');

     Route::post('update-status', [MaritalStatusController::class, 'updateStatus']);
});

Route::group([
    'prefix' => 'academic_structures',
], function () {
    Route::get('/', [AcademicStructuresController::class, 'index'])
         ->name('academic_structures.academic_structure.index');
    Route::get('/create', [AcademicStructuresController::class, 'create'])
         ->name('academic_structures.academic_structure.create');
    Route::get('/show/{academicStructure}',[AcademicStructuresController::class, 'show'])
         ->name('academic_structures.academic_structure.show')->where('id', '[0-9]+');
    Route::get('/{academicStructure}/edit',[AcademicStructuresController::class, 'edit'])
         ->name('academic_structures.academic_structure.edit')->where('id', '[0-9]+');
    Route::post('/', [AcademicStructuresController::class, 'store'])
         ->name('academic_structures.academic_structure.store');
    Route::put('academic_structure/{academicStructure}', [AcademicStructuresController::class, 'update'])
         ->name('academic_structures.academic_structure.update')->where('id', '[0-9]+');
    Route::delete('/academic_structure/{academicStructure}',[AcademicStructuresController::class, 'destroy'])
         ->name('academic_structures.academic_structure.destroy')->where('id', '[0-9]+');
});
Route::group(['middleware' => ['permission:access-assessment-types']], function () {
     Route::group([
          'prefix' => 'assessment_types',
     ], function () {
          Route::get('/', [AssessmentTypeController::class, 'index'])
               ->name('assessment_types.assessment_type.index');
          Route::get('/create', [AssessmentTypeController::class, 'create'])
               ->name('assessment_types.assessment_type.create');
          Route::get('/show/{assessmentType}', [AssessmentTypeController::class, 'show'])
               ->name('assessment_types.assessment_type.show')->where('id', '[0-9]+');
          Route::get('/{assessmentType}/edit', [AssessmentTypeController::class, 'edit'])
               ->name('assessment_types.assessment_type.edit')->where('id', '[0-9]+');
          Route::post('/', [AssessmentTypeController::class, 'store'])
               ->name('assessment_types.assessment_type.store');
          Route::put('academic_structure/{assessmentType}', [AssessmentTypeController::class, 'update'])
               ->name('assessment_types.assessment_type.update')->where('id', '[0-9]+');
          Route::delete('/academic_structure/{assessmentType}', [AssessmentTypeController::class, 'destroy'])
               ->name('assessment_types.assessment_type.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [AssessmentTypeController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-education-systems']], function () {
     Route::group([
     'prefix' => 'education_systems',
     ], function () {
     Route::get('/', [EducationSystemsController::class, 'index'])
          ->name('education_systems.education_system.index');
     Route::get('/create', [EducationSystemsController::class, 'create'])
          ->name('education_systems.education_system.create');
     Route::get('/show/{educationSystem}',[EducationSystemsController::class, 'show'])
          ->name('education_systems.education_system.show')->where('id', '[0-9]+');
     Route::get('/{educationSystem}/edit',[EducationSystemsController::class, 'edit'])
          ->name('education_systems.education_system.edit')->where('id', '[0-9]+');
     Route::post('/', [EducationSystemsController::class, 'store'])
          ->name('education_systems.education_system.store');
     Route::put('education_system/{educationSystem}', [EducationSystemsController::class, 'update'])
          ->name('education_systems.education_system.update')->where('id', '[0-9]+');
     Route::delete('/education_system/{educationSystem}',[EducationSystemsController::class, 'destroy'])
          ->name('education_systems.education_system.destroy')->where('id', '[0-9]+');
});
});

Route::group(['middleware' => ['permission:access-admission-statuses']], function () {
     Route::group([
          'prefix' => 'admission_statuses',
     ], function () {
          Route::get('/', [AdmissionStatusController::class, 'index'])
               ->name('admission_statuses.admission_status.index');

          Route::get('/create', [AdmissionStatusController::class, 'create'])
               ->name('admission_statuses.admission_status.create');

          Route::get('/show/{admissionStatus}', [AdmissionStatusController::class, 'show'])
               ->name('admission_statuses.admission_statuse.show')->where('id', '[0-9]+');

          Route::get('/{admissionStatus}/edit', [AdmissionStatusController::class, 'edit'])
               ->name('admission_statuses.admission_status.edit')->where('id', '[0-9]+');

          Route::post('/', [AdmissionStatusController::class, 'store'])
               ->name('admission_statuses.admission_status.store');

          Route::put('admission_status/{admissionStatus}', [AdmissionStatusController::class, 'update'])
               ->name('admission_statuses.admission_status.update')->where('id', '[0-9]+');

          Route::delete('/admission_status/{admissionStatus}', [AdmissionStatusController::class, 'destroy'])
               ->name('admission_statuses.admission_status.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [AdmissionStatusController::class, 'updateStatus']);
     });
});


Route::group(['middleware' => ['permission:access-registration-statuses']], function () {
     Route::group([
          'prefix' => 'registration_statuses',
     ], function () {
          Route::get('/', [RegistrationStatusController::class, 'index'])
               ->name('registration_statuses.registration_status.index');

          Route::get('/create', [RegistrationStatusController::class, 'create'])
               ->name('registration_statuses.registration_status.create');

          Route::get('/show/{registrationStatus}', [RegistrationStatusController::class, 'show'])
               ->name('registration_statuses.registration_statuse.show')->where('id', '[0-9]+');

          Route::get('/{registrationStatus}/edit', [RegistrationStatusController::class, 'edit'])
               ->name('registration_statuses.registration_status.edit')->where('id', '[0-9]+');

          Route::post('/', [RegistrationStatusController::class, 'store'])
               ->name('registration_statuses.registration_status.store');

          Route::put('registration_status/{registrationStatus}', [RegistrationStatusController::class, 'update'])
               ->name('registration_statuses.registration_status.update')->where('id', '[0-9]+');

          Route::delete('/registration_status/{registrationStatus}', [RegistrationStatusController::class, 'destroy'])
               ->name('registration_statuses.registration_status.destroy')->where('id', '[0-9]+');
     });
});


Route::group(['middleware' => ['permission:access-promotion-statuses']], function () {
     Route::group([
          'prefix' => 'promotion_statuses',
     ], function () {
          Route::get('/', [PromotionStatusController::class, 'index'])
               ->name('promotion_statuses.promotion_status.index');

          Route::get('/create', [PromotionStatusController::class, 'create'])
               ->name('promotion_statuses.promotion_status.create');

          Route::get('/show/{promotionStatus}', [PromotionStatusController::class, 'show'])
               ->name('promotion_statuses.promotion_status.show')->where('id', '[0-9]+');

          Route::get('/{promotionStatus}/edit', [PromotionStatusController::class, 'edit'])
               ->name('promotion_statuses.promotion_status.edit')->where('id', '[0-9]+');

          Route::post('/', [PromotionStatusController::class, 'store'])
               ->name('promotion_statuses.promotion_status.store');

          Route::put('promotion_status/{promotionStatus}', [PromotionStatusController::class, 'update'])
               ->name('promotion_statuses.promotion_status.update')->where('id', '[0-9]+');

          Route::delete('/promotion_status/{promotionStatus}', [PromotionStatusController::class, 'destroy'])
               ->name('promotion_statuses.promotion_status.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [PromotionStatusController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-mark-types']], function () {
     Route::group([
          'prefix' => 'mark_types',
     ], function () {
          Route::get('/', [MarkTypeController::class, 'index'])
               ->name('mark_types.mark_type.index');

          Route::get('/create', [MarkTypeController::class, 'create'])
               ->name('mark_types.mark_type.create');

          Route::get('/show/{markType}', [MarkTypeController::class, 'show'])
               ->name('mark_types.mark_type.show')->where('id', '[0-9]+');

          Route::get('/{markType}/edit', [MarkTypeController::class, 'edit'])
               ->name('mark_types.mark_type.edit')->where('id', '[0-9]+');

          Route::post('/', [MarkTypeController::class, 'store'])
               ->name('mark_types.mark_type.store');

          Route::put('mark_type/{markType}', [MarkTypeController::class, 'update'])
               ->name('mark_types.mark_type.update')->where('id', '[0-9]+');

          Route::delete('/mark_type/{markType}', [MarkTypeController::class, 'destroy'])
               ->name('mark_types.mark_type.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [MarkTypeController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-continuous-assessments']], function () {
     Route::group([
          'prefix' => 'continuous_assessments',
     ], function () {
          Route::get('/', [ContinuousAssessmentController::class, 'index'])
               ->name('continuous_assessments.continuous_assessment.index');

          Route::get('/create', [ContinuousAssessmentController::class, 'create'])
               ->name('continuous_assessments.continuous_assessment.create');

          Route::get('/show/{continuousAssessment}', [ContinuousAssessmentController::class, 'show'])
               ->name('continuous_assessments.continuous_assessment.show')->where('id', '[0-9]+');

          Route::get('/{continuousAssessment}/edit', [ContinuousAssessmentController::class, 'edit'])
               ->name('continuous_assessments.continuous_assessment.edit')->where('id', '[0-9]+');

          Route::post('/', [ContinuousAssessmentController::class, 'store'])
               ->name('continuous_assessments.continuous_assessment.store');

          Route::put('mark_type/{continuousAssessment}', [ContinuousAssessmentController::class, 'update'])
               ->name('continuous_assessments.continuous_assessment.update')->where('id', '[0-9]+');

          Route::delete('/mark_type/{continuousAssessment}', [ContinuousAssessmentController::class, 'destroy'])
               ->name('continuous_assessments.continuous_assessment.destroy')->where('id', '[0-9]+');

          Route::get('/mark_type/{continuousAssessment}/delete', [ContinuousAssessmentController::class, 'deleteContinuousAssessment']);
     });
});


Route::group(['middleware' => ['permission:access-subject-fees']], function () {
     Route::group([
          'prefix' => 'subject_fees',
     ], function () {
          Route::get('/', [SubjectFeeController::class, 'index'])
               ->name('subjectFees.subjectFee.index');

          Route::get('/create', [SubjectFeeController::class, 'create'])
               ->name('subjectFees.subjectFee.create');

          Route::get('/show/{subjectFee}', [SubjectFeeController::class, 'show'])
               ->name('subjectFees.subjectFee.show')->where('id', '[0-9]+');

          Route::get('/{subjectFee}/edit', [SubjectFeeController::class, 'edit'])
               ->name('subjectFees.subjectFee.edit')->where('id', '[0-9]+');

          Route::post('/', [SubjectFeeController::class, 'store'])
               ->name('subjectFees.subjectFee.store');

          Route::put('subject_fee/{subjectFee}', [SubjectFeeController::class, 'update'])
               ->name('subjectFees.subjectFee.update')->where('id', '[0-9]+');

          Route::delete('/subject_fee/{subjectFee}', [SubjectFeeController::class, 'destroy'])
               ->name('subjectFees.subjectFee.destroy')->where('id', '[0-9]+');

          Route::get('/copy', [SubjectFeeController::class, 'copyForm'])
               ->name('subjectFees.subjectFee.copyForm');

          Route::post('/copy', [SubjectFeeController::class, 'copy'])
               ->name('subjectFees.subjectFee.copy');

          Route::post('update-status', [SubjectFeeController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-course-fees']], function () {
     Route::group([
          'prefix' => 'course_fees',
     ], function () {
          Route::get('/', [CourseFeeController::class, 'index'])
               ->name('courseFees.courseFee.index');

          Route::get('/create', [CourseFeeController::class, 'create'])
               ->name('courseFees.courseFee.create');

          Route::get('/show/{courseFee}', [CourseFeeController::class, 'show'])
               ->name('courseFees.courseFee.show')->where('id', '[0-9]+');

          Route::get('/{courseFee}/edit', [CourseFeeController::class, 'edit'])
               ->name('courseFees.courseFee.edit')->where('id', '[0-9]+');

          Route::post('/', [CourseFeeController::class, 'store'])
               ->name('courseFees.courseFee.store');

          Route::put('course_fee/{courseFee}', [CourseFeeController::class, 'update'])
               ->name('courseFees.courseFee.update')->where('id', '[0-9]+');

          Route::delete('/course_fee/{courseFee}', [CourseFeeController::class, 'destroy'])
               ->name('courseFees.courseFee.destroy')->where('id', '[0-9]+');

          Route::get('/copy', [CourseFeeController::class, 'copyForm'])
               ->name('courseFees.courseFee.copyForm');

          Route::post('/copy', [CourseFeeController::class, 'copy'])
               ->name('courseFees.courseFee.copy');
     });
});

Route::group(['middleware' => ['permission:access-other-fees']], function () {
     Route::group([
          'prefix' => 'other_fees',
     ], function () {
          Route::get('/', [OtherFeeController::class, 'index'])
               ->name('otherFees.otherFee.index');

          Route::get('/create', [OtherFeeController::class, 'create'])
               ->name('otherFees.otherFee.create');

          Route::get('/show/{courseFee}', [OtherFeeController::class, 'show'])
               ->name('otherFees.otherFee.show')->where('id', '[0-9]+');

          Route::get('/{otherFee}/edit', [OtherFeeController::class, 'edit'])
               ->name('otherFees.otherFee.edit')->where('id', '[0-9]+');

          Route::post('/', [OtherFeeController::class, 'store'])
               ->name('otherFees.otherFee.store');

          Route::put('other_fee/{otherFee}', [OtherFeeController::class, 'update'])
               ->name('otherFees.otherFee.update')->where('id', '[0-9]+');

          Route::delete('/fee_type/{otherFee}', [OtherFeeController::class, 'destroy'])
               ->name('otherFees.otherFee.destroy')->where('id', '[0-9]+');

          Route::get('/copy', [OtherFeeController::class, 'copyForm'])
               ->name('otherFees.otherFee.copyForm');

          Route::post('/copy', [OtherFeeController::class, 'copy'])
               ->name('otherFees.otherFee.copy');

          Route::post('update-status', [OtherFeeController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-fee-types']], function () {
     Route::group([
          'prefix' => 'fee_types',
     ], function () {
          Route::get('/', [FeeTypeController::class, 'index'])
               ->name('feeTypes.feeType.index');

          Route::get('/create', [FeeTypeController::class, 'create'])
               ->name('feeTypes.feeType.create');

          Route::get('/show/{feeType}', [FeeTypeController::class, 'show'])
               ->name('feeTypes.feeType.show')->where('id', '[0-9]+');

          Route::get('/{feeType}/edit', [FeeTypeController::class, 'edit'])
               ->name('feeTypes.feeType.edit')->where('id', '[0-9]+');

          Route::post('/', [FeeTypeController::class, 'store'])
               ->name('feeTypes.feeType.store');

          Route::put('fee_types/{feeType}', [FeeTypeController::class, 'update'])
               ->name('feeTypes.feeType.update')->where('id', '[0-9]+');

          Route::delete('/fee_type/{feeType}', [FeeTypeController::class, 'destroy'])
               ->name('feeTypes.feeType.destroy')->where('id', '[0-9]+');

          Route::get('/copy', [FeeTypeController::class, 'copyForm'])
               ->name('feeTypes.feeType.copy');

          Route::post('update-status', [FeeTypeController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-exam-admission-criteria']], function () {
     Route::group([
          'prefix' => 'exam_admission_criteria',
     ], function () {
          Route::get('/', [ExamAdmissionCriteriaController::class, 'index'])
               ->name('exam_admission_criterias.exam_admission_criteria.index');

          Route::get('/create', [ExamAdmissionCriteriaController::class, 'create'])
               ->name('exam_admission_criterias.exam_admission_criteria.create');

          Route::get('/show/{examAdmissionCriteria}', [ExamAdmissionCriteriaController::class, 'show'])
               ->name('exam_admission_criterias.exam_admission_criteria.show')->where('id', '[0-9]+');

          Route::get('/{examAdmissionCriteria}/edit', [ExamAdmissionCriteriaController::class, 'edit'])
               ->name('exam_admission_criterias.exam_admission_criteria.edit')->where('id', '[0-9]+');

          Route::post('/', [ExamAdmissionCriteriaController::class, 'store'])
               ->name('exam_admission_criterias.exam_admission_criteria.store');

          Route::put('exam_paper_mark_criterias/{examAdmissionCriteria}', [ExamAdmissionCriteriaController::class, 'update'])
               ->name('exam_admission_criterias.exam_admission_criteria.update')->where('id', '[0-9]+');

          Route::delete('/exam_paper_mark_criteria/{examAdmissionCriteria}', [ExamAdmissionCriteriaController::class, 'destroy'])
               ->name('exam_admission_criterias.exam_admission_criteria.destroy')->where('id', '[0-9]+');

          Route::get('/copy', [ExamAdmissionCriteriaController::class, 'copyForm'])
               ->name('exam_admission_criterias.exam_admission_criteria.copy');

     });
});

Route::group(['middleware' => ['permission:access-exam-registration-criteria']], function () {
     Route::group([
          'prefix' => 'exam_registration_criteria',
     ], function () {
          Route::get('/', [ExamRegistrationCriteriaController::class, 'index'])
               ->name('exam_registration_criterias.exam_registration_criteria.index');

          Route::get('/create', [ExamRegistrationCriteriaController::class, 'create'])
               ->name('exam_registration_criterias.exam_registration_criteria.create');

          Route::get('/show/{examAdmissionCriteria}', [ExamRegistrationCriteriaController::class, 'show'])
               ->name('exam_registration_criterias.exam_registration_criteria.show')->where('id', '[0-9]+');

          Route::get('/{examAdmissionCriteria}/edit', [ExamRegistrationCriteriaController::class, 'edit'])
               ->name('exam_registration_criterias.exam_registration_criteria.edit')->where('id', '[0-9]+');

          Route::post('/', [ExamRegistrationCriteriaController::class, 'store'])
               ->name('exam_registration_criterias.exam_registration_criteria.store');

          Route::put('exam_paper_mark_criterias/{examAdmissionCriteria}', [ExamRegistrationCriteriaController::class, 'update'])
               ->name('exam_registration_criterias.exam_registration_criteria.update')->where('id', '[0-9]+');

          Route::delete('/exam_paper_mark_criteria/{examAdmissionCriteria}', [ExamRegistrationCriteriaController::class, 'destroy'])
               ->name('exam_registration_criterias.exam_registration_criteria.destroy')->where('id', '[0-9]+');

          Route::get('/copy', [ExamRegistrationCriteriaController::class, 'copyForm'])
               ->name('exam_registration_criterias.exam_registration_criteria.copy');
     });
});

Route::group(['middleware' => ['permission:access-exam-papers']], function () {
     Route::group([
          'prefix' => 'exam_papers',
     ], function () {
          Route::get('/', [ExamPapersController::class, 'index'])
               ->name('exam_papers.exam_paper.index');

          Route::get('/create', [ExamPapersController::class, 'create'])
               ->name('exam_papers.exam_paper.create');

          Route::get('/show/{examPaper}', [ExamPapersController::class, 'show'])
               ->name('exam_papers.exam_paper.show')->where('id', '[0-9]+');

          Route::get('/{examPaper}/edit', [ExamPapersController::class, 'edit'])
               ->name('exam_papers.exam_paper.edit')->where('id', '[0-9]+');

          Route::post('/', [ExamPapersController::class, 'store'])
               ->name('exam_papers.exam_paper.store');

          Route::put('exam_papers/{examPaper}', [ExamPapersController::class, 'update'])
               ->name('exam_papers.exam_paper.update')->where('id', '[0-9]+');

          Route::delete('/exam_paper/{examPaper}', [ExamPapersController::class, 'destroy'])
               ->name('exam_papers.exam_paper.destroy')->where('id', '[0-9]+');

          Route::post('/copy', [ExamPapersController::class, 'copy'])
               ->name('exam_papers.exam_paper.copyForm');

          Route::get('/marks-exist/{examPaper}', [ExamPapersController::class, 'deleteExamPaper']);
     });
});

Route::group(['middleware' => ['permission:access-result-codes']], function () {
     Route::group([
          'prefix' => 'assessment_result_codes',
     ], function () {
          Route::get('/', [AssessmentResultCodeController::class, 'index'])
               ->name('assessment_result_codes.assessment_result_code.index');

          Route::get('/create', [AssessmentResultCodeController::class, 'create'])
               ->name('assessment_result_codes.assessment_result_code.create');

          Route::get('/show/{assessmentResultCode}', [AssessmentResultCodeController::class, 'show'])
               ->name('assessment_result_codes.assessment_result_code.show')->where('id', '[0-9]+');

          Route::get('/{assessmentResultCode}/edit', [AssessmentResultCodeController::class, 'edit'])
               ->name('assessment_result_codes.assessment_result_code.edit')->where('id', '[0-9]+');

          Route::post('/', [AssessmentResultCodeController::class, 'store'])
               ->name('assessment_result_codes.assessment_result_code.store');

          Route::put('assessment_result_codes/{assessmentResultCode}', [AssessmentResultCodeController::class, 'update'])
               ->name('assessment_result_codes.assessment_result_code.update')->where('id', '[0-9]+');

          Route::delete('/assessment_result_code/{assessmentResultCode}', [AssessmentResultCodeController::class, 'destroy'])
               ->name('assessment_result_codes.assessment_result_code.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [AssessmentResultCodeController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-final-mark-criterias']], function () {

     Route::group([
          'prefix' => 'final_mark_criterias',
     ], function () {
          Route::get('/', [FinalMarkCriteriaController::class, 'index'])
               ->name('final_mark_criterias.final_mark_criteria.index');

          Route::get('/create', [FinalMarkCriteriaController::class, 'create'])
               ->name('final_mark_criterias.final_mark_criteria.create');

          Route::get('/show/{finalMarkCriteria}', [FinalMarkCriteriaController::class, 'show'])
               ->name('final_mark_criterias.final_mark_criteria.show')->where('id', '[0-9]+');

          Route::get('/{finalMarkCriteria}/edit', [FinalMarkCriteriaController::class, 'edit'])
               ->name('final_mark_criterias.final_mark_criteria.edit')->where('id', '[0-9]+');

          Route::post('/', [FinalMarkCriteriaController::class, 'store'])
               ->name('final_mark_criterias.final_mark_criteria.store');

          Route::put('final_mark_criterias/{finalMarkCriteria}', [FinalMarkCriteriaController::class, 'update'])
               ->name('final_mark_criterias.final_mark_criteria.update')->where('id', '[0-9]+');

          Route::delete('/final_mark_criteria/{finalMarkCriteria}', [FinalMarkCriteriaController::class, 'destroy'])
               ->name('final_mark_criterias.final_mark_criteria.destroy')->where('id', '[0-9]+');

          Route::post('/copy', [FinalMarkCriteriaController::class, 'copy'])
               ->name('final_mark_criterias.final_mark_criteria.copy');

          Route::get('/filter', [FinalMarkCriteriaController::class, 'filter'])->name('final_mark_criterias.final_mark_criteria.filter');
     });
});

Route::group(['middleware' => ['permission:access-exam-mark-criterias']], function () {

     Route::group([
          'prefix' => 'exam_mark_criterias',
     ], function () {
          Route::get('/', [ExamMarkCriteriaController::class, 'index'])
               ->name('exam_mark_criterias.exam_mark_criteria.index');

          Route::get('/create', [ExamMarkCriteriaController::class, 'create'])
               ->name('exam_mark_criterias.exam_mark_criteria.create');

          Route::get('/show/{examMarkCriteria}', [ExamMarkCriteriaController::class, 'show'])
               ->name('exam_mark_criterias.exam_mark_criteria.show')->where('id', '[0-9]+');

          Route::get('/{examMarkCriteria}/edit', [ExamMarkCriteriaController::class, 'edit'])
               ->name('exam_mark_criterias.exam_mark_criteria.edit')->where('id', '[0-9]+');

          Route::post('/', [ExamMarkCriteriaController::class, 'store'])
               ->name('exam_mark_criterias.exam_mark_criteria.store');

          Route::put('final_mark_criterias/{examMarkCriteria}', [ExamMarkCriteriaController::class, 'update'])
               ->name('exam_mark_criterias.exam_mark_criteria.update')->where('id', '[0-9]+');

          Route::delete('/final_mark_criteria/{examMarkCriteria}', [ExamMarkCriteriaController::class, 'destroy'])
               ->name('exam_mark_criterias.exam_mark_criteria.destroy')->where('id', '[0-9]+');

          Route::post('/copy', [ExamMarkCriteriaController::class, 'copy'])
               ->name('exam_mark_criterias.exam_mark_criteria.copy');

          Route::get('/filter', [ExamMarkCriteriaController::class, 'filter'])->name('exam_mark_criterias.exam_mark_criteria.filter');
     });
});

Route::group(['middleware' => ['permission:access-final-mark-criterias']], function () {
     Route::group([
          'prefix' => 'exam_paper_mark_criterias',
     ], function () {
          Route::get('/', [ExamPaperMarkCriteriaController::class, 'index'])
               ->name('exam_paper_mark_criterias.exam_paper_mark_criteria.index');

          Route::get('/create', [ExamPaperMarkCriteriaController::class, 'create'])
               ->name('exam_paper_mark_criterias.exam_paper_mark_criteria.create');

          Route::get('/show/{examPaperMarkCriteria}', [ExamPaperMarkCriteriaController::class, 'show'])
               ->name('exam_paper_mark_criterias.exam_paper_mark_criteria.show')->where('id', '[0-9]+');

          Route::get('/{examPaperMarkCriteria}/edit', [ExamPaperMarkCriteriaController::class, 'edit'])
               ->name('exam_paper_mark_criterias.exam_paper_mark_criteria.edit')->where('id', '[0-9]+');

          Route::post('/', [ExamPaperMarkCriteriaController::class, 'store'])
               ->name('exam_paper_mark_criterias.exam_paper_mark_criteria.store');

          Route::put('exam_paper_mark_criterias/{examPaperMarkCriteria}', [ExamPaperMarkCriteriaController::class, 'update'])
               ->name('exam_paper_mark_criterias.exam_paper_mark_criteria.update')->where('id', '[0-9]+');

          Route::delete('/exam_paper_mark_criteria/{examPaperMarkCriteria}', [ExamPaperMarkCriteriaController::class, 'destroy'])
               ->name('exam_paper_mark_criterias.exam_paper_mark_criteria.destroy')->where('id', '[0-9]+');

          Route::get('/copy', [ExamPaperMarkCriteriaController::class, 'copyForm'])
               ->name('exam_paper_mark_criterias.exam_paper_mark_criteria.copyForm');
     });
});

Route::group(['middleware' => ['permission:access-payment-methods']], function () {
     Route::group([
          'prefix' => 'payment_methods',
     ], function () {
          Route::get('/', [PaymentMethodController::class, 'index'])
               ->name('payment_methods.payment_method.index');

          Route::get('/create', [PaymentMethodController::class, 'create'])
               ->name('payment_methods.payment_method.create');

          Route::get('/show/{examPaperMarkCriteria}', [PaymentMethodController::class, 'show'])
               ->name('payment_methods.payment_method.show')->where('id', '[0-9]+');

          Route::get('/{examPaperMarkCriteria}/edit', [PaymentMethodController::class, 'edit'])
               ->name('payment_methods.payment_method.edit')->where('id', '[0-9]+');

          Route::post('/', [PaymentMethodController::class, 'store'])
               ->name('payment_methods.payment_method.store');

          Route::put('exam_paper_mark_criterias/{examPaperMarkCriteria}', [PaymentMethodController::class, 'update'])
               ->name('payment_methods.payment_method.update')->where('id', '[0-9]+');

          Route::delete('/exam_paper_mark_criteria/{examPaperMarkCriteria}', [PaymentMethodController::class, 'destroy'])
               ->name('payment_methods.payment_method.destroy')->where('id', '[0-9]+');

          Route::post('update-status', [PaymentMethodController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-student-charge-types']], function () {
     Route::group([
          'prefix' => 'student_charge_types',
     ], function () {
          Route::get('/', [StudentChargeTypeController::class, 'index'])
               ->name('student_charge_types.student_charge_type.index');

          Route::get('/create', [StudentChargeTypeController::class, 'create'])
               ->name('student_charge_types.student_charge_type.create');

          Route::get('/show/{studentChargeType}', [StudentChargeTypeController::class, 'show'])
               ->name('student_charge_types.student_charge_type.show')->where('id', '[0-9]+');

          Route::get('/{studentChargeType}/edit', [StudentChargeTypeController::class, 'edit'])
               ->name('student_charge_types.student_charge_type.edit')->where('id', '[0-9]+');

          Route::post('/', [StudentChargeTypeController::class, 'store'])
               ->name('student_charge_types.student_charge_type.store');

          Route::put('student_charge_types/{studentChargeType}', [StudentChargeTypeController::class, 'update'])
               ->name('student_charge_types.student_charge_type.update')->where('id', '[0-9]+');

          Route::post('update-status', [StudentChargeTypeController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-payment-descriptions']], function () {
     Route::group([
          'prefix' => 'payment_descriptions',
     ], function () {
          Route::get('/', [PaymentDescriptionController::class, 'index'])
               ->name('payment_descriptions.payment_description.index');

          Route::get('/create', [PaymentDescriptionController::class, 'create'])
               ->name('payment_descriptions.payment_description.create');

          Route::get('/show/{studentChargeType}', [PaymentDescriptionController::class, 'show'])
               ->name('payment_descriptions.payment_description.show')->where('id', '[0-9]+');

          Route::get('/{studentChargeType}/edit', [PaymentDescriptionController::class, 'edit'])
               ->name('payment_descriptions.payment_description.edit')->where('id', '[0-9]+');

          Route::post('/', [PaymentDescriptionController::class, 'store'])
               ->name('payment_descriptions.payment_description.store');

          Route::put('student_charge_types/{studentChargeType}', [PaymentDescriptionController::class, 'update'])
               ->name('payment_descriptions.payment_description.update')->where('id', '[0-9]+');

          Route::post('update-status', [PaymentDescriptionController::class, 'updateStatus']);
     });
});

Route::group(['middleware' => ['permission:access-cancellation-policy']], function () {
     Route::group([
          'prefix' => 'module_cancellation_policy',
     ], function () {
          Route::get('/', [ModuleCancellationPolicyController::class, 'index'])
               ->name('module_cancellation_policies.module_cancellation_policy.index');

          Route::get('/create', [ModuleCancellationPolicyController::class, 'create'])
               ->name('module_cancellation_policies.module_cancellation_policy.create');

          Route::get('/show/{moduleCancellationPolicy}', [ModuleCancellationPolicyController::class, 'show'])
               ->name('module_cancellation_policies.module_cancellation_policy.show')->where('id', '[0-9]+');

          Route::get('/{moduleCancellationPolicy}/edit', [ModuleCancellationPolicyController::class, 'edit'])
               ->name('module_cancellation_policies.module_cancellation_policy.edit')->where('id', '[0-9]+');

          Route::post('/', [ModuleCancellationPolicyController::class, 'store'])
               ->name('module_cancellation_policies.module_cancellation_policy.store');

          Route::put('module_cancellation_policy/{moduleCancellationPolicy}', [ModuleCancellationPolicyController::class, 'update'])
               ->name('module_cancellation_policies.module_cancellation_policy.update')->where('id', '[0-9]+');

          Route::delete('/module_cancellation_policy/{moduleCancellationPolicy}', [ModuleCancellationPolicyController::class, 'destroy'])
               ->name('module_cancellation_policies.module_cancellation_policy.destroy')->where('id', '[0-9]+');
     });
});

Route::group(['middleware' => ['permission:access-lovs']], function () {
     Route::group([
          'prefix' => 'lovs',
     ], function () {
          Route::get('/', [LovController::class, 'index'])
               ->name('lovs.lov.index');
          Route::get('/{lov}/edit', [LovController::class, 'edit'])
               ->name('lovs.lov.edit')->where('id', '[0-9]+');
          Route::post('lovs', [LovController::class, 'update'])
               ->name('lovs.lov.update');
     });
});

Route::group(['middleware' => ['permission:access-employees']], function () {
     Route::group([
          'prefix' => 'employees',
     ], function () {
          Route::get('/', [EmployeeController::class, 'index'])
               ->name('employees.employee.index');

          Route::get('/create', [EmployeeController::class, 'create'])
               ->name('employees.employee.create');

          Route::get('/show/{employee}', [EmployeeController::class, 'show'])
               ->name('employees.employee.show')->where('id', '[0-9]+');

          Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])
               ->name('employees.employee.edit')->where('id', '[0-9]+');

          Route::post('/', [EmployeeController::class, 'store'])
               ->name('employees.employee.store');

          Route::put('employees/{employee}', [EmployeeController::class, 'update'])
               ->name('employees.employee.update')->where('id', '[0-9]+');
     });
});

Route::post('check-id-passport', [SettingsController::class, 'checkIdNumber']);
Route::get('add-next-of-kin', [SettingsController::class, 'addNextOfKin']);
Route::get('add-previous-qualification', [SettingsController::class, 'addPreviousQualification']);
Route::get('add-application/{id}', [SettingsController::class, 'addApplication']);
Route::get('edit-application/{id}', [SettingsController::class, 'editApplication']);
Route::delete('delete-next-of-kin/{id}', [SettingsController::class, 'deleteNextOfKin']);
Route::delete('delete-previous-qualification/{id}', [SettingsController::class, 'deletePreviousQualification']);
Route::get('add-school-subject', [SettingsController::class, 'addSchoolSubject']);
Route::get('matric-type-grades/{matric_type}', [SettingsController::class, 'getMatricTypeGrades']);
Route::delete('delete-subject/{id}', [SettingsController::class, 'deleteSchoolSubject']);

Route::get('previous-qualifications/download/{id}/{student_name}', [SettingsController::class, 'downloadPreviousQualificationDocument']);

Route::get('get-qualification-data/{qualificationId}', [QualificationsController::class, 'getQualificationData']);

Route::get('get-modules', [ModulesController::class, 'getModulesViaAjax']);
Route::get('get-mark-types', [MarkTypeController::class, 'getMarkTypesViaAjax']);
Route::get('get-module-papers/{moduleId}/{assessmentTypeId}/{academicYearId}', [ExamPaperMarkCriteriaController::class, 'getModulePapers']);
Route::get('get-result-codes', [FinalMarkCriteriaController::class, 'getResultCodes']);
Route::get('get-student-info/{student_number}', [PaymentController::class, 'getStudentInfo']);

Route::get('/notifications', [NotificationController::class, 'index']);
