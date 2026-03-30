<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migration for creating the programs table.
     * 
     * This migration creates the 'programs' table in the database, which is responsible
     * for storing academic program information including program details, metadata,
     * and relationships to courses and other curriculum components.
     * this migrations is a reference table to store the academic programs offered by the national university of colombia manizales headquarters.
     * it includes the four faculty of the headquarters: Facultad de Administración, Facultad de Ciencias Exactas y Naturales, Facultad de Ingeniería y Arquitectura, and Facultad de Ciencias humanas y Sociales.
     * @return void
     */
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the academic program');
            $table->integer('code')->comment('Code of the academic program, e.g., 4046 for ASI');
            $table->string('name')->comment('Name of the academic program, e.g., Administración de Sistemas Informáticos');
            $table->string('faculty')->comment('Faculty or department offering the program, e.g., Facultad de Administración');
            $table->integer('total_semesters')->comment('Duration of the program in semesters, e.g., 10 for ASI');
            $table->boolean('is_active')->comment('Indicates whether the program is currently active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
