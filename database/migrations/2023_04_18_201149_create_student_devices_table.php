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
        Schema::create('student_devices', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->integer('academic_year_id');
            $table->string('provider');
            $table->string('issue_date')->nullable();
            $table->string('sim_serial');
            $table->string('mobile_number');
            $table->string('device_imei');
            $table->integer('captured_by');
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
        Schema::dropIfExists('student_devices');
    }
};
