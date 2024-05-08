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
        Schema::table('student_examinations', function (Blueprint $table) {
            $table->integer('assessment_result_code_id')->default(0)->after('pass_fail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_examinations', function (Blueprint $table) {
            $table->dropColumn('assessment_result_code_id');
        });
    }
};
