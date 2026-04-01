<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Subject;
use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create the only existent program
        $program = Program::firstOrCreate(
            ['code' => 'ASI'],
            [
                'name' => 'Administración de Sistemas Informáticos',
                'faculty' => 'Facultad de Administración',
                'total_semesters' => 10,
                'is_active' => true,
            ]
        );

        // Assign all the existens subjects of this program
        $updated = Subject::whereNull('program_Id')
                          ->update(['program_id' => $program->id]);

        $this->command->info(
            "Programa '{$program->name}' creado o encontrado. Se asignaron {$updated} materia(s) a este programa."
        );
    }
}
