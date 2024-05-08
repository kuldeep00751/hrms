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
        Schema::table('user_info_school_subjects', function (Blueprint $table) {
            $table->dropColumn('mid_term_result');
            $table->dropColumn('mid_term_points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_info_school_subjects', function (Blueprint $table) {
            //
        });
    }
};
