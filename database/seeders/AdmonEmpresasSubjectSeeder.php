<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Program;

class AdmonEmpresasSubjectSeeder extends Seeder
{
    public function run(): void
    {
        $program = Program::where('code', 'ADMON')->first();

        if (!$program) {
            $this->command->error("Programa ADMON no encontrado. Ejecuta primero ProgramSeeder.");
            return;
        }

        // Materias exclusivas de ADMON (las compartidas con ASI ya existen sin program_id)
        $subjects = [
            // Semestre 1
            ['code' => '4100645', 'name' => 'INFORMÁTICA Y LÓGICA',                          'semester' => 1,  'credits' => 2, 'classroom_hours' => 4, 'student_hours' => 2,  'type' => 'fundamental',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100622', 'name' => 'FUNDAMENTOS PSICOLÓGICOS PARA ADMINISTRACIÓN',   'semester' => 1,  'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 3,  'type' => 'fundamental',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100646', 'name' => 'FUNDAMENTOS DE ADMINISTRACIÓN Y ORGANIZACIONES', 'semester' => 1,  'credits' => 4, 'classroom_hours' => 4, 'student_hours' => 8,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],

            // Semestre 2
            ['code' => '4100623', 'name' => 'FUNDAMENTOS SOCIOLÓGICOS Y ANTROPOLÓGICOS',      'semester' => 2,  'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 3,  'type' => 'fundamental',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100618', 'name' => 'CONTABILIDAD FINANCIERA',                        'semester' => 2,  'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100642', 'name' => 'TEORÍA DE LAS ORGANIZACIONES I',                 'semester' => 2,  'credits' => 4, 'classroom_hours' => 6, 'student_hours' => 6,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],

            // Semestre 3
            ['code' => '4100630', 'name' => 'MATEMÁTICAS PARA ADMINISTRACIÓN',               'semester' => 3,  'credits' => 4, 'classroom_hours' => 6, 'student_hours' => 7,  'type' => 'fundamental',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100617', 'name' => 'CONTABILIDAD ADMINISTRATIVA',                    'semester' => 3,  'credits' => 3, 'classroom_hours' => 6, 'student_hours' => 3,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100643', 'name' => 'TEORÍA DE LAS ORGANIZACIONES II',                'semester' => 3,  'credits' => 4, 'classroom_hours' => 6, 'student_hours' => 6,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],

            // Semestre 4
            ['code' => '4100614', 'name' => 'ADMINISTRACIÓN FINANCIERA I',                    'semester' => 4,  'credits' => 4, 'classroom_hours' => 6, 'student_hours' => 6,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100631', 'name' => 'MICROECONOMÍA',                                  'semester' => 4,  'credits' => 4, 'classroom_hours' => 6, 'student_hours' => 6,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100580', 'name' => 'INVESTIGACIÓN DE OPERACIONES I',                 'semester' => 4,  'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],

            // Semestre 5
            ['code' => '4100629', 'name' => 'MARKETING',                                      'semester' => 5,  'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100579', 'name' => 'ESTADÍSTICA II',                                 'semester' => 5,  'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'fundamental',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100615', 'name' => 'ADMINISTRACIÓN FINANCIERA II',                   'semester' => 5,  'credits' => 4, 'classroom_hours' => 4, 'student_hours' => 8,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100628', 'name' => 'MACROECONOMÍA',                                  'semester' => 5,  'credits' => 2, 'classroom_hours' => 4, 'student_hours' => 2,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '#OPTDIS-01-ADMON', 'name' => 'ASIGNATURA OPTATIVA DISCIPLINAR',       'semester' => 5,  'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'optativa_profesional', 'is_required' => false, 'is_leveling' => false],

            // Semestre 6
            ['code' => '4100621', 'name' => 'EPISTEMOLOGÍA DE LA ADMINISTRACIÓN',             'semester' => 6,  'credits' => 2, 'classroom_hours' => 4, 'student_hours' => 2,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100641', 'name' => 'SISTEMAS DE INFORMACIÓN DE MERCADOS',            'semester' => 6,  'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100683', 'name' => 'TEORÍA ADMINISTRATIVA',                          'semester' => 6,  'credits' => 4, 'classroom_hours' => 6, 'student_hours' => 6,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '#OPTDIS-02-ADMON', 'name' => 'ASIGNATURA OPTATIVA DISCIPLINAR',       'semester' => 6,  'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'optativa_profesional', 'is_required' => false, 'is_leveling' => false],
            ['code' => '#LIBRE-02-ADMON',  'name' => 'LIBRE ELECCIÓN',                        'semester' => 6,  'credits' => 4, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'libre_eleccion',      'is_required' => false, 'is_leveling' => false],

            // Semestre 7
            ['code' => '4100636', 'name' => 'SEMINARIO DE PROCESOS DE INVESTIGACIÓN E INTERVENCIÓN I',  'semester' => 7, 'credits' => 2, 'classroom_hours' => 4, 'student_hours' => 2, 'type' => 'profesional', 'is_required' => true, 'is_leveling' => false],
            ['code' => '4100634', 'name' => 'PROCESOS DE GESTIÓN HUMANA',                     'semester' => 7,  'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100635', 'name' => 'PROYECTOS DE DESARROLLO',                        'semester' => 7,  'credits' => 4, 'classroom_hours' => 6, 'student_hours' => 6,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100626', 'name' => 'LEGISLACIÓN EMPRESARIAL Y LABORAL',              'semester' => 7,  'credits' => 3, 'classroom_hours' => 6, 'student_hours' => 3,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '#LIBRE-03-ADMON',  'name' => 'LIBRE ELECCIÓN',                        'semester' => 7,  'credits' => 4, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'libre_eleccion',      'is_required' => false, 'is_leveling' => false],

            // Semestre 8
            ['code' => '4100637', 'name' => 'SEMINARIO DE PROCESOS DE INVESTIGACIÓN E INTERVENCIÓN II', 'semester' => 8, 'credits' => 2, 'classroom_hours' => 4, 'student_hours' => 3, 'type' => 'profesional', 'is_required' => true, 'is_leveling' => false],
            ['code' => '4100648', 'name' => 'GESTIÓN DE LA PRODUCCIÓN Y LA CALIDAD',          'semester' => 8,  'credits' => 3, 'classroom_hours' => 6, 'student_hours' => 3,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '4100624', 'name' => 'GERENCIA ESTRATÉGICA DEL TALENTO HUMANO',        'semester' => 8,  'credits' => 2, 'classroom_hours' => 3, 'student_hours' => 3,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '#OPTDIS-03-ADMON', 'name' => 'ASIGNATURA OPTATIVA DISCIPLINAR',       'semester' => 8,  'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'optativa_profesional', 'is_required' => false, 'is_leveling' => false],
            ['code' => '#LIBRE-04-ADMON',  'name' => 'LIBRE ELECCIÓN',                        'semester' => 8,  'credits' => 4, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'libre_eleccion',      'is_required' => false, 'is_leveling' => false],

            // Semestre 9
            ['code' => '4100649', 'name' => 'TRABAJO DE GRADO',                               'semester' => 9,  'credits' => 6, 'classroom_hours' => 1, 'student_hours' => 16, 'type' => 'trabajo_grado',       'is_required' => true,  'is_leveling' => false],
            ['code' => '4100632', 'name' => 'PRÁCTICA COMUNITARIA',                           'semester' => 9,  'credits' => 3, 'classroom_hours' => 1, 'student_hours' => 7,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '#LIBRE-05-ADMON',  'name' => 'LIBRE ELECCIÓN',                        'semester' => 9,  'credits' => 4, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'libre_eleccion',      'is_required' => false, 'is_leveling' => false],
            ['code' => '#LIBRE-06-ADMON',  'name' => 'LIBRE ELECCIÓN',                        'semester' => 9,  'credits' => 4, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'libre_eleccion',      'is_required' => false, 'is_leveling' => false],

            // Semestre 10
            ['code' => '4100633', 'name' => 'PRÁCTICA EMPRESARIAL',                           'semester' => 10, 'credits' => 3, 'classroom_hours' => 1, 'student_hours' => 7,  'type' => 'profesional',         'is_required' => true,  'is_leveling' => false],
            ['code' => '#OPTDIS-04-ADMON', 'name' => 'ASIGNATURA OPTATIVA DISCIPLINAR',       'semester' => 10, 'credits' => 4, 'classroom_hours' => 4, 'student_hours' => 8,  'type' => 'optativa_profesional', 'is_required' => false, 'is_leveling' => false],
            ['code' => '#LIBRE-07-ADMON',  'name' => 'LIBRE ELECCIÓN',                        'semester' => 10, 'credits' => 4, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'libre_eleccion',      'is_required' => false, 'is_leveling' => false],
            ['code' => '#LIBRE-08-ADMON',  'name' => 'LIBRE ELECCIÓN',                        'semester' => 10, 'credits' => 4, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'libre_eleccion',      'is_required' => false, 'is_leveling' => false],
        ];

        // Las compartidas con ASI se registran con program_id = null (ya existen o se crean sin dueño)
        $shared = ['1000004', '1000005', '1000044', '1000045', '1000046', '1000047', '4100539', '4100578', '4100579', '4100550'];

        // Insertar materias exclusivas de ADMON
        foreach ($subjects as $index => $subject) {
            DB::table('subjects')->updateOrInsert(
                ['code' => $subject['code']],
                [
                    'name'            => $subject['name'],
                    'semester'        => $subject['semester'],
                    'display_order'   => $index + 1,
                    'credits'         => $subject['credits'],
                    'classroom_hours' => $subject['classroom_hours'],
                    'student_hours'   => $subject['student_hours'],
                    'type'            => $subject['type'],
                    'is_required'     => $subject['is_required'],
                    'is_leveling'     => $subject['is_leveling'],
                    'program_id'      => $program->id,
                    'updated_at'      => now(),
                    'created_at'      => now(),
                ]
            );
        }

        // Materias compartidas: asegurar que existen sin program_id exclusivo
        $sharedData = [
            ['code' => '1000004', 'name' => 'CÁLCULO DIFERENCIAL',    'semester' => 1, 'credits' => 4, 'classroom_hours' => 4, 'student_hours' => 4,  'type' => 'fundamental', 'is_required' => true, 'is_leveling' => false],
            ['code' => '1000005', 'name' => 'CÁLCULO INTEGRAL',       'semester' => 2, 'credits' => 4, 'classroom_hours' => 4, 'student_hours' => 4,  'type' => 'fundamental', 'is_required' => true, 'is_leveling' => false],
            ['code' => '1000044', 'name' => 'INGLÉS I',               'semester' => 2, 'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'nivelacion',  'is_required' => true, 'is_leveling' => true],
            ['code' => '1000045', 'name' => 'INGLÉS II',              'semester' => 3, 'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'nivelacion',  'is_required' => true, 'is_leveling' => true],
            ['code' => '1000046', 'name' => 'INGLÉS III',             'semester' => 4, 'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'nivelacion',  'is_required' => true, 'is_leveling' => true],
            ['code' => '1000047', 'name' => 'INGLÉS IV',              'semester' => 5, 'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'nivelacion',  'is_required' => true, 'is_leveling' => true],
            ['code' => '4100539', 'name' => 'FUNDAMENTOS DE ECONOMÍA','semester' => 3, 'credits' => 3, 'classroom_hours' => 6, 'student_hours' => 3,  'type' => 'profesional', 'is_required' => true, 'is_leveling' => false],
            ['code' => '4100578', 'name' => 'ESTADÍSTICA I',          'semester' => 4, 'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'fundamental', 'is_required' => true, 'is_leveling' => false],
            ['code' => '4100550', 'name' => 'SISTEMAS DE INFORMACIÓN','semester' => 7, 'credits' => 3, 'classroom_hours' => 4, 'student_hours' => 5,  'type' => 'fundamental', 'is_required' => true, 'is_leveling' => false],
        ];

        foreach ($sharedData as $subject) {
            // Solo actualiza program_id a null si actualmente apunta solo a ASI
            DB::table('subjects')
                ->where('code', $subject['code'])
                ->update(['program_id' => null]);
        }

        // Libre elección semestre 1 (compartida con ASI, solo asegurar que existe)
        DB::table('subjects')->updateOrInsert(
            ['code' => '#LIBRE-01'],
            [
                'name'            => 'LIBRE ELECCIÓN',
                'semester'        => 1,
                'display_order'   => 5,
                'credits'         => 4,
                'classroom_hours' => 4,
                'student_hours'   => 5,
                'type'            => 'libre_eleccion',
                'is_required'     => false,
                'is_leveling'     => false,
                'program_id'      => null,
                'updated_at'      => now(),
                'created_at'      => now(),
            ]
        );

        $this->command->info("Malla de Administración de Empresas cargada correctamente.");
    }
}
