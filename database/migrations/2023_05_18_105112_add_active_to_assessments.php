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
        Schema::table('assessment_types', function (Blueprint $table) {
            $table->tinyInteger('active')->after('maximum_mark')->default(1);
        });

        Schema::table('academic_intakes', function (Blueprint $table) {
            $table->tinyInteger('active')->after('name')->default(1);
        });

        Schema::table('admission_statuses', function (Blueprint $table) {
            $table->tinyInteger('active')->after('full_admission')->default(1);
        });

        Schema::table('application_types', function (Blueprint $table) {
            $table->tinyInteger('active')->after('application_type')->default(1);
        });

        Schema::table('campuses', function (Blueprint $table) {
            $table->tinyInteger('active')->after('address_line_3')->default(1);
        });

        Schema::table('fee_types', function (Blueprint $table) {
            $table->tinyInteger('active')->after('fee_type_name')->default(1);
        });

        Schema::table('mark_types', function (Blueprint $table) {
            $table->tinyInteger('active')->after('mark_type')->default(1);
        });

        Schema::table('modules', function (Blueprint $table) {
            $table->tinyInteger('active')->after('lecture_duration')->default(1);
        });

        Schema::table('next_of_kin_relationships', function (Blueprint $table) {
            $table->tinyInteger('active')->after('relationship')->default(1);
        });

        Schema::table('payment_methods', function (Blueprint $table) {
            $table->tinyInteger('active')->after('payment_method')->default(1);
        });

        Schema::table('promotion_statuses', function (Blueprint $table) {
            $table->tinyInteger('active')->after('description')->default(1);
        });

        Schema::table('qualifications', function (Blueprint $table) {
            $table->tinyInteger('active')->after('qualification_type_id')->default(1);
        });

        Schema::table('required_documents', function (Blueprint $table) {
            $table->tinyInteger('active')->after('is_required')->default(1);
        });

        Schema::table('student_types', function (Blueprint $table) {
            $table->tinyInteger('active')->after('student_type')->default(1);
        });

        Schema::table('study_modes', function (Blueprint $table) {
            $table->tinyInteger('active')->after('study_mode')->default(1);
        });

        Schema::table('study_periods', function (Blueprint $table) {
            $table->tinyInteger('active')->after('study_period')->default(1);
        });

        Schema::table('subject_fees', function (Blueprint $table) {
            $table->tinyInteger('active')->after('academic_process')->default(1);
        });

        Schema::table('titles', function (Blueprint $table) {
            $table->tinyInteger('active')->after('title')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessment_types', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('academic_intakes', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('admission_statuses', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('application_types', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('campuses', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('fee_types', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('mark_types', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('modules', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('next_of_kin_relationships', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('payment_methods', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('promotion_statuses', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('qualifications', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('required_documents', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('student_types', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('study_modes', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('study_periods', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('subject_fees', function (Blueprint $table) {
            $table->dropColumn('active');
        });

        Schema::table('titles', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
};
