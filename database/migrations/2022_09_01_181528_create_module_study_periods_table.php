<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModuleStudyPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_study_periods', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
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
        Schema::drop('module_study_periods');
    }
}
