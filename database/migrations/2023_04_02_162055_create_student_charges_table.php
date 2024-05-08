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
        Schema::create('student_charges', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->integer('student_charge_type_id');
            $table->double('amount', 15,2);
            $table->string('transaction_id');
            $table->date('transaction_date');
            $table->integer('created_by');
            $table->string('status')->default('active');
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
        Schema::dropIfExists('student_charges');
    }
};
