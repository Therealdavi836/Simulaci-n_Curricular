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
        Schema::table('programs', function (Blueprint $table) {
            // Add the FK — nullable to not break the ASI record existent before seeder
            $table->foreignId('faculty_id')
                  ->nullable()
                  ->after('code')
                  ->constrained('faculties')
                  ->nullOnDelete();

            // Delete the string column 'faculty' that won't be used anymore
            $table->dropColumn('faculty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign(['faculty_id']);
            $table->dropColumn('faculty_id');
            $table->string('faculty')->nullable();
        });
    }
};
