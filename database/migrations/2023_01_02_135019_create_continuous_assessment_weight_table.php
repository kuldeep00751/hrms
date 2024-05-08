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
        Schema::create('continuous_assessment_weights', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id');
            $table->integer('mark_type_id');
            $table->integer('academic_year_id');
            $table->string('assessment_description');
            $table->decimal('weight', 15,2);
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
        Schema::dropIfExists('continuous_assessments');
    }
};
