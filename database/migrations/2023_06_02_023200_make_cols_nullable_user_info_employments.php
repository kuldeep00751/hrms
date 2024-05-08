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
        Schema::table('user_info_employments', function (Blueprint $table) {
            $table->string('position')->nullable()->change();
            $table->string('department')->nullable()->change();
            $table->string('company_name')->nullable()->change();
            $table->string('company_address')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_info_employments', function (Blueprint $table) {
            //
        });
    }
};
