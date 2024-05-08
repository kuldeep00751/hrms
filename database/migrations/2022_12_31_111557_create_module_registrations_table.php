<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->integer('module_id');
            $table->integer('academic_year_id');
            $table->integer('student_year_level');
            $table->integer('study_mode_id');
            $table->integer('study_period_id');
            $table->integer('assessment_type_id');
            $table->integer('campus_id');
            $table->integer('academic_intake_id');
            $table->integer('registration_status_id')->default(1);
            $table->dateTime('cancel_date')->nullable();
            $table->tinyInteger('is_cancelled')->default(0);
            $table->dateTime('exemption_date')->nullable();
            $table->tinyInteger('is_exempted')->default(0);
            $table->string('cancel_reason')->nullable();
            $table->string('exemption_reason')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->unique(['module_id', 'academic_year_id', 'user_info_id', 'study_period_id', 'academic_intake_id'], 'unique_module_registration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_registrations');
    }
};
