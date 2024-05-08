<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcademicStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_structures', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('academic_year_id')->unsigned()->nullable()->index();
            $table->integer('qualification_id')->unsigned()->nullable()->index();
            $table->integer('year_level_id')->unsigned()->nullable()->index();
            $table->integer('study_period_id')->unsigned()->nullable()->index();
            $table->integer('module_id')->unsigned()->nullable()->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('academic_structures');
    }
}
