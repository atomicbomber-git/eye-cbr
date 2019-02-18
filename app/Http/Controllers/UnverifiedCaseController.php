<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Feature;
use App\CaseRecord;

class UnverifiedCaseController extends Controller
{
    public function index()
    {
        session(['page' => request('page')]);

        $features = Feature::select('id')->get();

        $case_records = CaseRecord::select('id', 'verified')
            ->with('case_record_features:id,feature_id,case_record_id,value')
            ->verified()
            ->orderByDesc('updated_at', 'created_at')
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

        return view('unverified_case.index', compact('features', 'case_records'));
    }
    
    public function create()
    {
    }
    
    public function store()
    {   
    }
    
    public function edit(CaseRecord $case_record)
    {
    }
    
    public function update(CaseRecord $case_record)
    {
    }
    
    public function delete(CaseRecord $case_record) {
        DB::transaction(function () use ($case_record) {
            $case_record->case_record_features()->delete();
            $case_record->delete();
        });

        return back()
            ->with([
                'message' => __('messages.delete.success'),
                'message_state' => 'success'
            ]);
    }
}
