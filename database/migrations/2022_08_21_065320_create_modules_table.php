<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('module_code')->unique();
            $table->string('module_name');
            $table->integer('nqf_level_id');
            $table->integer('module_credits');
            $table->integer('module_level_id');
            $table->integer('year_level_id');
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
        Schema::drop('modules');
    }
}
