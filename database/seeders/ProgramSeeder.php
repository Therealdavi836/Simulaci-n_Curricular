<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Subject;
use App\Models\CurriculumVersion;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create headquarters
        $campus = Campus::firstOrCreate(
            ['code' => 'MAN'],
            ['name' => 'Sede Manizales', 'is_active' => true]
        );

        // 2. Create faculty linked to the campus
        $faculty = Faculty::firstOrCreate(
            ['code' => 'ADMON-MAN'],
            ['campus_id' => $campus->id, 'name' => 'Facultad de Administración', 'is_active' => true]
        );

        // 3. Update the existing program with the faculty FK
        $program = Program::firstOrCreate(
            ['code' => 'ASI'],
            [
                'name'            => 'Administración de Sistemas Informáticos',
                'faculty_id'      => $faculty->id,
                'total_semesters' => 10,
                'is_active'       => true,
            ]
        );

        // Si ya existía pero sin faculty_id, actualizarlo
        if (!$program->faculty_id) {
            $program->update(['faculty_id' => $faculty->id]);
        }

        // 4. Assign program_id to curriculum versions that don't have it
        CurriculumVersion::whereNull('program_id')
            ->update(['program_id' => $program->id]);

        $this->command->info("Sede '{$campus->name}', Facultad '{$faculty->name}' creadas.");
        $this->command->info("Programa '{$program->name}' vinculado correctamente.");
    }
}
