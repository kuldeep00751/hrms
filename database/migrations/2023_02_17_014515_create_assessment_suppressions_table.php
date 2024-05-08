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
        Schema::create('assessment_suppressions', function (Blueprint $table) {
            $table->id();
            $table->integer('academic_year_id');
            $table->integer('academic_intake_id');
            $table->integer('campus_id');
            $table->integer('study_mode_id');
            $table->string('suppression_type');
            $table->tinyInteger('suppress_yn')->default(1);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->unique(['academic_year_id', 'academic_intake_id', 'campus_id', 'study_mode_id', 'suppression_type'],'assessment_suppression_unq');
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
        Schema::dropIfExists('assessment_suppressions');
    }
};
