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
        Schema::create('user_info_employments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->string('position');
            $table->string('department');
            $table->string('company_name');
            $table->string('company_address');
            $table->string('work_contact_number')->nullable();
            $table->string('work_email')->nullable();
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
        Schema::dropIfExists('user_info_employments');
    }
};
