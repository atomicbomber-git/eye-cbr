<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Feature;
use App\CaseRecord;
use App\CaseRecordFeature;

class UnverifiedCaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $case_record->load('case_record_features:id,feature_id,case_record_id,value');

        $case_record = (object) [
            'id' => $case_record->id,
            'level' => $case_record->level,
            'verified' => $case_record->verified,
            'case_record_features' => $case_record->case_record_features
                ->mapWithKeys(function ($case_record_feature) {
                    return [$case_record_feature->feature_id => $case_record_feature->value];
                })
        ];

        $features = Feature::select('id', 'description')->get();

        return view('unverified_case.edit', compact('case_record', 'features'));
    }
    
    public function update(CaseRecord $case_record)
    {
        $data = $this->validate(request(), [
            'level' => ['required', Rule::in(array_keys(CaseRecord::LEVELS))],
            'case_record_features' => 'array',
            'case_record_features.*.feature_id' => 'required|exists:features,id',
            'case_record_features.*.value' => 'nullable'
        ]);
        
        DB::transaction(function () use ($data, $case_record) {
            $case_record->level = $data['level'];
            $case_record->save();
            $case_record->case_record_features()->delete();

            collect($data['case_record_features'])
                ->each(function ($case_record_feature) use ($case_record) {
                    CaseRecordFeature::create([
                        'case_record_id' => $case_record->id,
                        'feature_id' => $case_record_feature['feature_id'],
                        'value' => isset($case_record_feature['value']) ? 1 : 0
                    ]);
                });
        });

        return back()
            ->with([
                'message' => __('messages.update.success'),
                'message_state' => 'success'
            ]);
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
