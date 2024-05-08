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
        Schema::table('student_cas', function (Blueprint $table) {
            $schemaManager = Schema::getConnection()->getDoctrineSchemaManager();
            $tableIndexes = $schemaManager->listTableIndexes('student_examinations');

            if (!array_key_exists("idx_academic_year_id", $tableIndexes)) {
                $table->index('academic_year_id', 'idx_academic_year_id');
            }

            if (!array_key_exists("idx_user_info_id", $tableIndexes)) {
                $table->index('user_info_id', 'idx_user_info_id');
            }

            if (!array_key_exists("idx_module_id", $tableIndexes)) {
                $table->index('module_id', 'idx_module_id');
            }

            if (!array_key_exists("idx_academic_intake_id", $tableIndexes)) {
                $table->index('academic_intake_id', 'idx_academic_intake_id');
            }

            if (!array_key_exists("idx_campus_id", $tableIndexes)) {
                $table->index('campus_id', 'idx_campus_id');
            }

            if (!array_key_exists("idx_study_mode_id", $tableIndexes)) {
                $table->index('study_mode_id', 'idx_study_mode_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_cas', function (Blueprint $table) {
            //
        });
    }
};
