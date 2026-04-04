<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->string('subject_code', 20);
            $table->foreign('subject_code')->references('code')->on('subjects')->cascadeOnDelete();
            $table->unique(['program_id', 'subject_code']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_subjects');
    }
};
