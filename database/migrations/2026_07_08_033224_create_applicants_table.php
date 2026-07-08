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
    Schema::create('applicants', function (Blueprint $table) {
        $table->id();
        $table->string('first_name', 100);
        $table->string('last_name', 100);
        $table->string('school_id', 50)->nullable();
        $table->decimal('grade_average', 5, 2)->nullable();
        $table->enum('program_type', ['current', 'aspiring']);
        $table->string('status', 50)->default('submitted');
        $table->unsignedBigInteger('family_household_id')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
