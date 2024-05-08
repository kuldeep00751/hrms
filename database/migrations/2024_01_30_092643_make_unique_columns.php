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
        Schema::table('ca_mark_types', function (Blueprint $table) {
            $table->unique(['user_info_id', 'academic_year_id', 'campus_id', 'module_id', 'mark_type_id'], 'unique_mark_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ca_mark_types', function (Blueprint $table) {
            $table->dropUnique('unique_mark_types');

        });
    }
};
