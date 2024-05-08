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
        Schema::create('student_letters', function (Blueprint $table) {
            $table->id();
            $table->string('letter_name');
            $table->json('academic_year_id');
            $table->json('academic_intake_id');
            $table->json('qualification_id');
            $table->json('application_type_id');
            $table->json('study_mode_id');
            $table->json('campus_id');
            $table->json('admission_status_id');
            $table->text('content');
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
        Schema::dropIfExists('student_letters');
    }
};
