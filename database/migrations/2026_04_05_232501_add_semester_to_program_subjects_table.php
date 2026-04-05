<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_subjects', function (Blueprint $table) {
            $table->integer('semester')->nullable()->after('subject_code');
            $table->integer('display_order')->nullable()->after('semester');
        });
    }

    public function down(): void
    {
        Schema::table('program_subjects', function (Blueprint $table) {
            $table->dropColumn(['semester', 'display_order']);
        });
    }
};
