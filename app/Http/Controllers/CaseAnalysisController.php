<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kasus;
use App\Gejala;

class CaseAnalysisController extends Controller
{
    public function show(Kasus $case_record)
    {
        $case_record->load('case_record_features:id,case_record_id,feature_id,value');

        $case_record = (object) [
            'id' => $case_record->id,
            'verified' => $case_record->verified,
            'diagnosis' => $case_record->diagnosis,
            'case_record_features' => $case_record->case_record_features
                ->mapWithKeys(function ($case_record_feature) {
                    return [$case_record_feature->feature_id => $case_record_feature->value];
                })
        ];

        $features = Gejala::select('id', 'weight', 'description')->get()->keyBy('id');

        $case_records = Kasus::query()
            ->verified()
            ->with('case_record_features:id,case_record_id,feature_id,value')
            ->get()
            ->map(function ($verified_case) use($case_record) {
                $verified_case = collect($verified_case);

                $verified_case["case_record_features"] = collect($verified_case["case_record_features"])
                    ->keyBy('feature_id');

                $verified_case["distance"] = 0;
                $verified_case["diagnosis"] = Kasus::HASIL_DIAGNOSIS[$verified_case["diagnosis"]] ?? '-';

                foreach ($verified_case["case_record_features"] as $case_record_feature) {
                    $verified_case["distance"] += 
                        pow($case_record_feature["value"] - $case_record->case_record_features[$case_record_feature["feature_id"]], 2);
                }

                $verified_case["distance"] = sqrt($verified_case["distance"]);
                return $verified_case;
            })
            ->sortBy('distance')
            ->values()
            ->take(10);

        return view('case_analysis.show', compact('case_record', 'case_records', 'features'));
    }
}
