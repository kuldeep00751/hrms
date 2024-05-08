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
        Schema::create('lecture_timetables', function (Blueprint $table) {
            $table->id();
            $table->integer('schedule_group_id');
            $table->json('recurring_days');
            $table->dateTime('end_recur');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('academic_year_id');
            $table->integer('academic_intake_id');
            $table->integer('study_mode_id');
            $table->integer('study_period_id');
            $table->integer('campus_id');
            $table->integer('module_id');
            $table->json('qualification_id');
            $table->integer('instructor_id');
            $table->integer('space_id');
            
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
        Schema::dropIfExists('lecture_timetables');
    }
};
