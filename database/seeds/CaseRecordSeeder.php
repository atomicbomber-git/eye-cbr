<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\CaseRecord;
use App\Feature;
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
        DB::transaction(function() {
            
            $features = Feature::select('id')->get();

            factory(CaseRecord::class, 1000)
                ->create()
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
