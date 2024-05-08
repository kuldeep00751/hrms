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
        Schema::create('attendance_register_students', function (Blueprint $table) {
            $table->id();
            $table->integer('attendance_register_id');
            $table->integer('user_info_id');
            $table->integer('student_number');
            $table->string('first_names');
            $table->string('surname');
            $table->integer('attendance_duration');
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
        Schema::dropIfExists('attendance_register_students');
    }
};
