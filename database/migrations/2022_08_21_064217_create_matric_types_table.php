<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatricTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matric_types', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('education_system_id');
            $table->string('matric_type');
            $table->string('grade');
            $table->integer('points');
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
        Schema::drop('matric_types');
    }
}
