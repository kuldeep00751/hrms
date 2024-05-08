\<?php

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
                $table->integer('minimum_attendance')->after('ca_weight')->default(0);
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
                $table->dropColumn('minimum_attendance');
        });
    }
};
