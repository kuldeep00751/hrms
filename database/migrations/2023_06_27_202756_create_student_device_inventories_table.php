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
        Schema::create('student_device_inventories', function (Blueprint $table) {
            $table->id();
            $table->integer('student_device_type_id');
            $table->string('device_imei');
            $table->string('description');
            $table->string('remarks')->nullable();
            $table->string('status')->default('Available');
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
        Schema::dropIfExists('student_device_inventories');
    }
};
