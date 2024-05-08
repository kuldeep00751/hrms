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
        Schema::create('user_info_school_subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->integer('school_subject_id');
            $table->integer('matric_type_id');
            $table->string('mid_term_result');
            $table->integer('mid_term_points');
            $table->string('final_term_result');
            $table->integer('final_term_points');
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
        Schema::dropIfExists('user_info_school_subjects');
    }
};
