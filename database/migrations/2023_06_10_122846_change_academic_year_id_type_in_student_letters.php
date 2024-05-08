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
        Schema::table('student_letters', function (Blueprint $table) {
            $table->integer('academic_year_id')->change();
            $table->integer('academic_intake_id')->change();
            $table->string('admission_status_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_letters', function (Blueprint $table) {
            $table->json('academic_year_id')->change();
            $table->json('academic_intake_id')->change();
            $table->json('admission_status_id')->change();
        });
    }
};
