<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Program;

class ProgramSubjectsSeeder extends Seeder
{
    public function run(): void
    {
        $asi   = Program::where('code', 'ASI')->first();
        $admon = Program::where('code', 'ADMON')->first();

        if (!$asi || !$admon) {
            $this->command->error("Programas ASI o ADMON no encontrados.");
            return;
        }

        // Limpiar para re-seed limpio
        DB::table('program_subjects')->whereIn('program_id', [$asi->id, $admon->id])->delete();

        // ASI — todos sin override de semestre
        $codesASI = [
            '4200910','1000004','4100538','4100543','#LIBRE-01',
            '4100548','4200919','1000005','4100539','#LIBRE-02','1000044',
            '4200916','4200908','4100578','4100550','1000003','1000045',
            '4100549','4100552','4100555','4200909','4100591','1000046',
            '4100553','4200915','4100541','#OPTFUN-01','#LIBRE-03','1000047',
            '4100554','4100557','4200917','#OPTDIS-01','#OPTFUN-02','#LIBRE-04',
            '4100561','4100558','4100544','#OPTDIS-02','#LIBRE-05','#LIBRE-06',
            '4200914','4100562','4200911','4100560','4200918','#LIBRE-07',
            '4200921','4100563','4100565','#OPTDIS-03','#LIBRE-08','#LIBRE-09',
            '4100573','4100559','#LIBRE-10','#LIBRE-11',
        ];
        $this->insertPlain($asi->id, $codesASI);

        // ADMON — códigos sin override
        $codesADMON = [
            '1000004','4100645','4100622','4100646','#LIBRE-01',
            '1000005','4100623','4100618','4100642','1000044',
            '4100630','4100617','4100643','1000045',
            '4100614','4100631','4100580','1000046',
            '4100629','4100579','4100615','4100628','#OPTDIS-01-ADMON','1000047',
            '4100621','4100641','4100683','#OPTDIS-02-ADMON','#LIBRE-02-ADMON',
            '4100636','4100550','4100634','4100635','4100626','#LIBRE-03-ADMON',
            '4100637','4100648','4100624','#OPTDIS-03-ADMON','#LIBRE-04-ADMON',
            '4100649','4100632','#LIBRE-05-ADMON','#LIBRE-06-ADMON',
            '4100633','#OPTDIS-04-ADMON','#LIBRE-07-ADMON','#LIBRE-08-ADMON',
        ];
        $this->insertPlain($admon->id, $codesADMON);

        // ADMON — overrides de semestre para materias compartidas
        $overridesADMON = [
            ['code' => '4100539', 'semester' => 3, 'display_order' => 3, 'type' => 'profesional'],
            ['code' => '4100578', 'semester' => 4, 'display_order' => 4],
            ['code' => '4100550', 'semester' => 7, 'display_order' => 7],
        ];
        $this->insertOverrides($admon->id, $overridesADMON);

        $this->command->info("program_subjects poblado para ASI y ADMON.");
    }

    private function insertPlain(int $programId, array $codes): void
    {
        foreach ($codes as $code) {
            $exists = DB::table('subjects')->where('code', $code)->exists();
            if (!$exists) continue;

            DB::table('program_subjects')->updateOrInsert(
                ['program_id' => $programId, 'subject_code' => $code],
                [
                    'semester'      => null,
                    'display_order' => null,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]
            );
        }
    }

    private function insertOverrides(int $programId, array $overrides): void
    {
        foreach ($overrides as $item) {
            $exists = DB::table('subjects')->where('code', $item['code'])->exists();
            if (!$exists) continue;

            DB::table('program_subjects')->updateOrInsert(
                ['program_id' => $programId, 'subject_code' => $item['code']],
                [
                    'semester'      => $item['semester'] ?? null,
                    'display_order' => $item['display_order'] ?? null,
                    'type'          => $item['type'] ?? null,
                    'is_required'   => $item['is_required'] ?? null,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]
            );
        }
    }
}
