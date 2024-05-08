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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->integer('qualification_id');
            $table->integer('application_type_id');
            $table->integer('study_mode_id');
            $table->integer('campus_id');
            $table->integer('academic_year_id');
            $table->integer('academic_intake_id');
            $table->integer('choice_number');
            $table->string('application_status')->default('pending');
            $table->string('application_status_id')->default(0);
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
        Schema::dropIfExists('applications');
    }
};
