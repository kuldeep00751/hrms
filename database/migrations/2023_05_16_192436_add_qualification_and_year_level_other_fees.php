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
        Schema::table('other_fees', function (Blueprint $table) {
            $table->integer('qualification_id')->after('academic_year_id');
            $table->integer('year_level_id')->after('qualification_id');
            $table->integer('active')->default(1)->after('student_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('other_fees', function (Blueprint $table) {
            $table->dropColumn('qualification_id');
            $table->dropColumn('year_level_id');
            $table->dropColumn('active');
        });
    }
};
