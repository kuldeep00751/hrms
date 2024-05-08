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
        Schema::create('debit_memos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->double('amount', 15, 2);
            $table->string('transaction_id');
            $table->string('transaction_description');
            $table->date('transaction_date');
            $table->integer('created_by');
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
        Schema::dropIfExists('debit_memos');
    }
};
