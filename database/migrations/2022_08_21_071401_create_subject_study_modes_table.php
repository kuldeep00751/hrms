<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubjectStudyModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_study_modes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('module_id')->unsigned()->nullable()->index();
            $table->integer('study_mode_id')->unsigned()->nullable()->index();
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
        Schema::drop('subject_study_modes');
    }
}
