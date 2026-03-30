<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * This migration adds a foreign key column 'program_id' to the 'subjects' table, establishing a relationship between subjects and academic programs. 
     * The 'program_id' column references the 'id' column in the 'programs' table, allowing each subject to be associated with a specific academic program. 
     * This change is essential for organizing subjects under their respective programs and enabling efficient querying of subjects based on their program affiliation.
     */
    public function up(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('program_id')->nullable()->after('id');
            $table->foreign('program_id')->references('id')->on('programs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['program_id']);
            $table->dropColumn('program_id');
        });
    }
};
