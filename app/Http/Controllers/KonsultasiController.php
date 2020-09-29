<?php

namespace App\Http\Controllers;

use App\CaseRecordFeature;
use App\Gejala;
use App\Kasus;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KonsultasiController extends Controller
{
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return $this->responseFactory->view("konsultasi.create", [
            "features" => Gejala::query()
                ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'case_record_features' => 'array',
            'case_record_features.*.feature_id' => 'required|exists:features,id',
            'case_record_features.*.value' => 'nullable'
        ]);

        DB::beginTransaction();

        /** @var Kasus $case_record */
        $case_record = Kasus::query()->create([
            'verified' => 0
        ]);

        collect($data['case_record_features'])
            ->each(function ($case_record_feature) use ($case_record) {
                CaseRecordFeature::query()->create([
                    'case_record_id' => $case_record->id,
                    'feature_id' => $case_record_feature['feature_id'],
                    'value' => isset($case_record_feature['value']) ? 1 : 0
                ]);
            });

        $most_similar = $case_record->getClosestCaseRecords(1)[0];

        $case_record->offsetUnset("case_feature_map");
        $case_record->update([
            "diagnosis" => $most_similar->diagnosis
        ]);

        DB::commit();

        return redirect()
            ->route("konsultasi.show", $case_record);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(Kasus $kasus)
    {
        $kasus->load('case_record_features:id,case_record_id,feature_id,value');
        $case_records = $kasus->getClosestCaseRecords();

        return response()->view('case_analysis.show', [
            "case_record" => $kasus,
            "case_records" => $case_records,
            "features" => Gejala::query()->select('id', 'description')->get()->keyBy('id')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
