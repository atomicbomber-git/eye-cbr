<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Kasus;
use App\CaseRecordFeature;
use App\Gejala;

class VerifiedCaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        session(['page' => request('page')]);

        $features = Gejala::select('id')->get();

        $case_records = Kasus::query()->select('id', 'verified', 'diagnosis')
            ->with('case_record_features:id,feature_id,case_record_id,value')
            ->verified()
            ->orderByDesc('updated_at', 'created_at')
            ->paginate(config('pagination.default'));

        $case_records->getCollection()
            ->transform(function ($case_record) {
                return (object) [
                    'id' => $case_record->id,
                    'verified' => $case_record->verified,
                    'diagnosis' => Kasus::HASIL_DIAGNOSIS[$case_record->diagnosis] ?? '-',
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
        $features = Gejala::select('id', 'description')->get();
        return view('verified_case.create', compact('features'));
    }

    public function store()
    {
        $data = $this->validate(request(), [
            'diagnosis' => ['required', Rule::in(array_keys(Kasus::HASIL_DIAGNOSIS))],
            'case_record_features' => 'array',
            'case_record_features.*.feature_id' => 'required|exists:features,id',
            'case_record_features.*.value' => 'nullable'
        ]);

        DB::transaction(function () use($data) {
            $case_record = Kasus::create([
                'diagnosis' => $data['diagnosis'],
                'verified' => 1
            ]);

            collect($data['case_record_features'])
                ->each(function ($case_record_feature) use ($case_record) {
                    CaseRecordFeature::create([
                        'case_record_id' => $case_record->id,
                        'feature_id' => $case_record_feature['feature_id'],
                        'value' => isset($case_record_feature['value']) ? 1 : 0
                    ]);
                });
        });

        return redirect()
            ->route('verified_case.index')
            ->with([
                'message' => __('messages.create.success'),
                'message_state' => 'success'
            ]);
    }
    
    public function edit(Kasus $case_record)
    {
        $case_record->load('case_record_features:id,feature_id,case_record_id,value');

        $case_record = (object) [
            'id' => $case_record->id,
            'verified' => $case_record->verified,
            'diagnosis' => $case_record->diagnosis,
            'case_record_features' => $case_record->case_record_features
                ->mapWithKeys(function ($case_record_feature) {
                    return [$case_record_feature->feature_id => $case_record_feature->value];
                })
        ];

        $features = Gejala::select('id', 'description')->get();

        return view('verified_case.edit', compact('case_record', 'features'));
    }
    
    public function update(Request $request, Kasus $case_record)
    {
        $data = $this->validate(request(), [
            'diagnosis' => ['required', Rule::in(array_keys(Kasus::HASIL_DIAGNOSIS))],
            'case_record_features' => 'array',
            'case_record_features.*.feature_id' => 'required|exists:features,id',
            'case_record_features.*.value' => 'nullable'
        ]);
        
        DB::transaction(function () use ($data, $case_record) {
            $case_record->update(['diagnosis' => $data['diagnosis']]);
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
    
    public function delete(Kasus $case_record)
    {
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
