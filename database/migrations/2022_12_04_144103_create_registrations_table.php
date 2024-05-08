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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->integer('application_id');
            $table->integer('qualification_id');
            $table->integer('study_mode_id');
            $table->integer('year_level_id');
            $table->integer('campus_id');
            $table->integer('academic_year_id');
            $table->integer('academic_intake_id');
            $table->integer('choice_number');
            $table->integer('registration_status_id');
            $table->integer('is_cancelled')->default(0);
            $table->date('cancellation_date')->nullable;
            $table->string('cancellation_reason')->nullable();
            $table->tinyInteger('promotion_status')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->unique(['user_info_id', 'application_id', 'qualification_id', 'academic_year_id'], 'unique_qualifications');
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
        Schema::dropIfExists('registrations');
    }
};
