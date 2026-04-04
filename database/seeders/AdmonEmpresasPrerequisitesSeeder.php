<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdmonEmpresasPrerequisitesSeeder extends Seeder
{
    public function run(): void
    {
        $prerequisites = [
            '1000005' => ['1000004'],
            '4100642' => ['4100622'],
            '4100630' => ['1000005'],
            '4100617' => ['4100618'],
            '4100643' => ['4100642'],
            '1000045' => ['1000044'],
            '4100578' => ['1000005'],
            '4100614' => ['4100617'],
            '4100631' => ['4100539', '1000005'],
            '4100580' => ['4100630'],
            '1000046' => ['1000045'],
            '4100579' => ['4100578'],
            '4100615' => ['4100614'],
            '4100628' => ['4100631'],
            '1000047' => ['1000046'],
            '4100641' => ['4100645'],
            '4100636' => ['4100621'],
            '4100550' => ['4100645'],
            '4100634' => ['4100683'],
            '4100635' => ['4100628'],
            '4100637' => ['4100636'],
            '4100648' => ['4100580'],
            '4100624' => ['4100634'],
            '4100649' => ['4100637'],
            '4100632' => ['4100635'],
            '4100633' => ['4100632'],
        ];

        foreach ($prerequisites as $subjectCode => $prereqCodes) {
            foreach ($prereqCodes as $prereqCode) {
                $exists = DB::table('subjects')->where('code', $subjectCode)->exists()
                       && DB::table('subjects')->where('code', $prereqCode)->exists();

                if (!$exists) {
                    continue;
                }

                DB::table('subject_prerequisites')->updateOrInsert(
                    [
                        'subject_code'     => $subjectCode,
                        'prerequisite_code' => $prereqCode,
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }

        $this->command->info("Prerrequisitos de Administración de Empresas cargados correctamente.");
    }
}
