<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Kasus;
use App\Gejala;
use App\CaseRecordFeature;

class CaseRecordSeeder extends Seeder
{
    const BASE_CASES = [
        ["F1, F9, F10 ", "Miopi"],
        ["F1, F6, F14 ", "Miopi"],
        ["F1, F6, F10, F13 ", "Miopi"],
        ["F1, F13, F14 ", "Miopi"],
        ["F1, F6, F9 ", "Miopi"],
        ["F1, F9, F14 ", "Miopi"],
        ["F1, F6, F9, F14 ", "Miopi"],
        ["F11, F12, F18 ", "Hordeolum"],
        ["F8, F11, F18 ", "Hordeolum"],
        ["F3, F8, F18 ", "Hordeolum"],
        ["F3, F11, F12 ", "Hordeolum"],
        ["F3, F12, F18 ", "Hordeolum"],
        ["F3, F11, F18 ", "Hordeolum"],
        ["F8, F11, F12 ", "Hordeolum"],
        ["F1, F3, F13 ", "Katarak"],
        ["F1, F3, F15 ", "Katarak"],
        ["F1, F13, F15 ", "Katarak"],
        ["F1, F13, F17 ", "Katarak"],
        ["F1, F2, F6, F16 ", "Katarak"],
        ["F1, F2, F16 ", "Katarak"],
        ["F1, F6, F13 ", "Katarak"],
        ["F4 ", "Konjungtivitis"],
        ["F7 ", "Konjungtivitis"],
        ["F4, F8 ", "Konjungtivitis"],
        ["F2, F3, F6 ", "Glaukoma"],
        ["F1, F3, F13 ", "Glaukoma"],
        ["F1, F3, F15 ", "Glaukoma"],
        ["F3, F4, F6 ", "Glaukoma"],
        ["F1, F3, F4 ", "Glaukoma"],
        ["F1, F4, F13 ", "Glaukoma"],
        ["F1, F3, F6 ", "Glaukoma"],
        ["F1, F4, F6 ", "Glaukoma"],
        ["F1, F6, F15 ", "Glaukoma"],
        ["F1, F6, F13 ", "Glaukoma"],
        ["F1, F15", "Glaukoma"],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $app_features = Gejala::query()
            ->get();

        foreach (self::BASE_CASES as $baseCase) {
            $features = $baseCase[0];
            $diagnosis = $baseCase[1];

            $case_record = Kasus::query()->create([
                "diagnosis" => $diagnosis,
                "verified" => 1.0,
            ]);

            $features = array_map(
                function ($feature) {
                    return ltrim(trim($feature), "Ff");
                },
                explode(",", $features)
            );

            foreach ($app_features as $app_feature) {
                CaseRecordFeature::query()->create([
                    "feature_id" => $app_feature->id,
                    "case_record_id" => $case_record->id,
                    "value" => in_array($app_feature->id, $features)
                ]);
            }
        }
    }
}
