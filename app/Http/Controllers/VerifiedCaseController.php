<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CaseRecord;
use App\Feature;

class VerifiedCaseController extends Controller
{
    public function index()
    {
        $features = Feature::select('id')->get();

        $case_records = CaseRecord::select('id', 'verified')
            ->with('case_record_features:id,feature_id,case_record_id,value')
            ->paginate(config('pagination.default'));

        $case_records->getCollection()
            ->transform(function ($case_record) {
                return (object) [
                    'id' => $case_record->id,
                    'verified' => $case_record->verified,
                    'case_record_features' => $case_record->case_record_features
                        ->mapWithKeys(function ($case_record_feature) {
                            return [$case_record_feature->feature_id => $case_record_feature->value];
                        })
                ];
            });

        return view('verified_case.index', compact('features', 'case_records'));
    }

    public function create()
    {
    }

    public function store()
    {
    }
    
    public function edit(CaseRecord $verified_case)
    {
    }
    
    public function update(CaseRecord $verified_case)
    {
    }
    
    public function delete(CaseRecord $verified_case)
    {
        DB::transaction(function() use($verified_case) {
            $verified_case->case_record_features()->delete();
            $verified_case->delete();
        });

        return back()
            ->with([
                'message' => __('messages.delete.success'),
                'message_state' => 'success'
            ]);
    }
}
