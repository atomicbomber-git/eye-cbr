<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Kasus;
use App\Gejala;
use App\CaseRecordFeature;

class CaseRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $verified_cases_count = (int) $this->command->ask("How many verifed cases do you want to be seeded with?");
        $unverified_cases_count = (int) $this->command->ask("How many unverified cases do you want to be seeded with?");

        DB::transaction(function() use($verified_cases_count, $unverified_cases_count) {
            
            $features = Gejala::select('id')->get();

            $verified_cases = factory(Kasus::class, $verified_cases_count)
                ->states('verified')
                ->create();

            $unverified_cases = factory(Kasus::class, $unverified_cases_count)
                ->states('unverified')
                ->create();

            $verified_cases->merge($unverified_cases)
                ->each(function ($caseRecord) use ($features) {
                    foreach ($features as $feature) {
                        factory(CaseRecordFeature::class)->create([
                            'case_record_id' => $caseRecord->id,
                            'feature_id' => $feature->id
                        ]);
                    }
                });
        });
    }
}
