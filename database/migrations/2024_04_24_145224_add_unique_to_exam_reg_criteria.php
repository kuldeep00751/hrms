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
        Schema::table('exam_registration_criterias', function (Blueprint $table) {
            $table->dropUnique('exam_registration_criterias_unique');
            $table->unique(['academic_year_id', 'assessment_type_id', 'required_assessment_mark'], 'exam_registration_criterias_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_registration_criterias', function (Blueprint $table) {
            $table->dropUnique('exam_registration_criterias_unique');
            $table->unique(['academic_year_id', 'assessment_type_id', 'required_assessment_mark']);
        });
    }
};
