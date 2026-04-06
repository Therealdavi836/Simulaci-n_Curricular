<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_subjects', function (Blueprint $table) {
            $table->string('type')->nullable()->after('display_order');
            $table->boolean('is_required')->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('program_subjects', function (Blueprint $table) {
            $table->dropColumn(['type', 'is_required']);
        });
    }
};
