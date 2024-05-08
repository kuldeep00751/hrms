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
        Schema::table('module_registrations', function (Blueprint $table) {
            $table->integer('qualification_id')->after('user_info_id');
            $table->index('qualification_id');	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('module_registrations', function (Blueprint $table) {
            $table->dropColumn('qualification_id');
            $table->dropIndex('qualification_id');
        });
    }
};
