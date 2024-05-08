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
        Schema::create('health_questionnaires', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->tinyInteger('chronic_illness_yn');
            $table->text('chronic_illness_description')->nullable();
            $table->tinyInteger('disability_yn');
            $table->text('disability_description')->nullable();
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
        Schema::dropIfExists('health_questionnaires');
    }
};
