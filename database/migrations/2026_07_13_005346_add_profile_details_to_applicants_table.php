<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('applicants', function (Blueprint $table) {
        $table->string('contact_number', 20)->nullable();
        $table->string('barangay', 100)->nullable();
        $table->string('course_year', 150)->nullable();
        $table->string('school_name', 150)->nullable();
    });
}

public function down(): void
{
    Schema::table('applicants', function (Blueprint $table) {
        $table->dropColumn(['contact_number', 'barangay', 'course_year', 'school_name']);
    });
}
};