<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradingScalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grading_scales', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('matric_type_id')->unsigned()->nullable()->index();
            $table->integer('subject_id')->unsigned()->nullable()->index();
            $table->string('symbol')->nullable();
            $table->string('points')->nullable();
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
        Schema::drop('grading_scales');
    }
}
