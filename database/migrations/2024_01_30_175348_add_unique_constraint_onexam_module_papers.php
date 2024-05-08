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
        Schema::table('exam_module_papers', function (Blueprint $table) {
            $table->unique(['user_info_id', 'academic_year_id', 'academic_intake_id', 'campus_id', 'module_id', 'assessment_type_id', 'exam_paper_id'], 'unique_exam_papers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_module_papers', function (Blueprint $table) {
            $table->dropUnique('unique_exam_papers');
        });
    }
};
