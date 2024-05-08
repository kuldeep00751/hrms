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
        Schema::create('user_info_previous_qualifications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->integer('level_id');
            $table->string('student_number')->nullable();
            $table->string('institution');
            $table->string('qualification_name');
            $table->tinyInteger('awarded_yn');
            $table->string('from_date');
            $table->string('to_date')->nullable();
            $table->string('document_path')->nullable();
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
        Schema::dropIfExists('user_info_previous_qualifications');
    }
};
