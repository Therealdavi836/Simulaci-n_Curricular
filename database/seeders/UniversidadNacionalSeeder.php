<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\Faculty;
use App\Models\Program;
use Illuminate\Database\Seeder;

class UniversidadNacionalSeeder extends Seeder
{
    public function run(): void
    {
        //Just limits manizales campus, but it can be extended to other campuses in the future
        $campus = Campus::firstOrCreate(
            ['code' => 'MAN'],
            ['name' => 'Sede Manizales', 'is_active' => true]
        );

        $faculties = [
            // Each faculty has a list of programs with their respective codes, names, and total semesters

            // Facultad de Administración
            [
                'code' => 'ADMON-MAN',
                'name' => 'Facultad de Administración',
                'programs' => [
                    ['code' => 'ADMON', 'name' => 'Administración de Empresas', 'total_semesters' => 10],
                    ['code' => 'ADMON-NOC', 'name' => 'Administración de Empresas - Jornada Nocturna', 'total_semesters' => 12],
                    ['code' => 'ASI', 'name' => 'Administración de Sistemas Informáticos', 'total_semesters' => 10], // the best career in the world
                ],
            ],

            // Facultad de Ingeniería y Arquitectura
            [
                'code' => 'ING-MAN',
                'name' => 'Facultad de Ingeniería y Arquitectura',
                'programs' => [
                    ['code' => 'ING-EL2', 'name' => 'Ingeniería Electrónica', 'total_semesters' => 10],
                    ['code' => 'ING-CIV', 'name' => 'Ingeniería Civil', 'total_semesters' => 10],
                    ['code' => 'ING-EL1', 'name' => 'Ingeniería Eléctrica', 'total_semesters' => 10],
                    ['code' => 'ING-IND', 'name' => 'Ingeniería Industrial', 'total_semesters' => 10],
                    ['code' => 'ING-QUI', 'name' => 'Ingeniería Química', 'total_semesters' => 10],
                    ['code' => 'ARQ',     'name' => 'Arquitectura', 'total_semesters' => 10],
                ],
            ],

            // Facultad de Ciencias Exactas y Naturales
            [
                'code' => 'CEN-MAN',
                'name' => 'Facultad de Ciencias Exactas y Naturales',
                'programs' => [
                    ['code' => 'MAT', 'name' => 'Matemáticas', 'total_semesters' => 8],
                    ['code' => 'CDC', 'name' => 'Ciencias de la Computación', 'total_semesters' => 9],
                    ['code' => 'EST', 'name' => 'Estadística', 'total_semesters' => 9],
                    ['code' => 'ING-FIS', 'name' => 'Ingeniería Física', 'total_semesters' => 10],
                    ['code' => 'ING-BIO', 'name' => 'Ingeniería Biológica', 'total_semesters' => 10],
                ],
            ],

            // Facultad de Ciencias Humanas y Sociales
            [
                'code' => 'HUM-MAN',
                'name' => 'Facultad de Ciencias Humanas y Sociales',
                'programs' => [
                    ['code' => 'GES', 'name' => 'Gestión Cultural y Comunicativa', 'total_semesters' => 8],
                    // queda pendiente agregar más programas a esta facultad debido a que no hay mucha información,
                    // pero por ahora solo se registra este programa para ilustrar el proceso de creación de facultades y programas en la base de datos
                ],
            ],
        ];

        foreach ($faculties as $facultyData) {
            $faculty = Faculty::firstOrCreate(
                ['code' => $facultyData['code']],
                [
                    'campus_id' => $campus->id,
                    'name'      => $facultyData['name'],
                    'is_active' => true,
                ]
            );

            foreach ($facultyData['programs'] as $programData) {
                Program::firstOrCreate(
                    ['code' => $programData['code']],
                    [
                        'faculty_id'      => $faculty->id,
                        'name'            => $programData['name'],
                        'total_semesters' => $programData['total_semesters'],
                        'is_active'       => true,
                    ]
                );
            }

            $this->command->info("Facultad '{$faculty->name}': " . count($facultyData['programs']) . " carrera(s) registradas.");
        }
    }
}
