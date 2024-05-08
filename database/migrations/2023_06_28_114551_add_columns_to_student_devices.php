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
        Schema::table('student_devices', function (Blueprint $table) {
            $table->dropColumn('provider');
            $table->dropColumn('sim_serial');
            $table->dropColumn('mobile_number');
            $table->dropColumn('device_imei');
            $table->integer('student_device_inventory_id')->after('academic_year_id');
            $table->date('valid_until')->after('issue_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_devices', function (Blueprint $table) {
            //
        });
    }
};
