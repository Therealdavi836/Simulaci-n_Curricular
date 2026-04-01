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
        Schema::table('curriculum_versions', function (Blueprint $table) {
            $table->foreignId('program_id')
                  ->nullable()
                  ->after('user_id')
                  ->constrained('programs')
                  ->nullOnDelete();

            $table->index('program_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curriculum_versions', function (Blueprint $table) {
            $table->dropForeign(['program_id']);
            $table->dropIndex(['program_id']);
            $table->dropColumn('program_id');
        });
    }
};
