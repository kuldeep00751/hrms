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
        Schema::table('exam_admission_criterias', function (Blueprint $table) {
            $table->string('absent_exam_indicator')->after('exam_weight')->nullable();
            $table->string('absent_exam_result_code')->after('absent_exam_indicator');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_admission_criterias', function (Blueprint $table) {
            $table->dropColumn('absent_exam_indicator');
            $table->dropColumn('absent_exam_result_code');
        });
    }
};
