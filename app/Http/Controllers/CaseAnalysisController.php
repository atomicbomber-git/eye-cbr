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
        $case_records = $case_record->getClosestCaseRecords();

        return view('case_analysis.show', [
            "case_record" => $case_record,
            "case_records" => $case_records,
            "features" => Gejala::query()->select('id', 'description')->get()->keyBy('id')
        ]);
    }
}
