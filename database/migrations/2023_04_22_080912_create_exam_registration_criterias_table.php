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
        Schema::create('exam_registration_criterias', function (Blueprint $table) {
            $table->id();
            $table->integer('academic_year_id');
            $table->integer('assessment_type_id');
            $table->string('required_assessment_mark');
            $table->integer('required_assessment_exam_id');
            $table->integer('minimum_mark');
            $table->integer('maximum_mark');
            $table->unique(['academic_year_id', 'assessment_type_id'], 'exam_registration_criterias_unique');
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
        Schema::dropIfExists('exam_registration_criterias');
    }
};
