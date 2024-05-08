<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQualificationModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualification_modules', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('academic_year')->unsigned()->nullable()->index();
            $table->integer('year_level_id')->unsigned()->nullable()->index();
            $table->integer('qualification_id')->unsigned()->nullable()->index();
            $table->integer('module_id')->unsigned()->nullable()->index();
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
        Schema::drop('qualification_subjects');
    }
}
