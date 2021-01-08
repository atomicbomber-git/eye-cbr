<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property Collection|CaseRecordFeature[] case_record_features
 * @property Collection case_feature_map
 */
class Kasus extends Model
{
    protected $table = "case_records";
    protected $guarded = [];

    const HASIL_DIAGNOSIS = [
        'GLAUKOMA' => 'Glaukoma',
        'KATARAK' => 'Katarak',
        'KONJUNGTIVITIS' => 'Konjungtivitis',
        'MIOPI' => 'Miopi',
        'HORDEOLUM' => 'Hordeolum',
    ];

    const SOLUSI_KASUS = [
        "GLAUKOMA" => "Pada glaukoma, melakukan skrining glaucoma, rutin melakukan pemeriksaan dan kontrol ke dokter karena penyakit ini bersifat seumur hidup, Rutin minum obat sesuai anjuran dokter, Menggunakan kacamata koreksi yang tepat bila memiliki hipermetropi/miopi/astigmatisme dan segera berobat ke faskes terdekat bila ada keluhan penurunan tajam penglihatan secara mendadak, mata merah dan nyeri kepala.",
        "KATARAK" => "Pada katarak, melakukan skrining pemeriksaan mata khususnya pada usia >50tahun, Mengobati penyakit denegeratif seperti diabetes melitus tipe 2 yang merupakan faktor resiko katarak, Menggunakan kacamata hitam untuk mengurangi silau, Menggunakan kacamata koreksi yang tepat untuk mengurangi keluhan tajam penglihatan yang menurun, bersifat sementara dan melakukan tindakan pembedahan, sebab terapi utama pada katarak adalah tindakan operatif.",
        "KONJUNGTIVITIS" => "Pada konjungtivitis, segera konsultasi ke dokter, Minum obat teratur, Jangan mengucek mata, Membersihkan kotoran mata menggunakan kain berbahan lembut yang dibasahi air hangat 2 kali sehari dan Cuci tangan sesudah dan setelah membersihkan mata atau menggunakan obat tetes/salep mata.",
        "MIOPI" => "Pada miopi, menggunakan kacamata koreksi yang tepat, Memeriksakan diri ke dokter tiap 6 bulan hingga satu tahun sekali, Sering melakukan aktivitas yang memanfaatkan penglihatan jauh,  Menggunakan kacamata ketika melihat jauh dan jika menggunakan kontak lensa, wajib menjaga kebersihan kontak lensa.",
        "HORDEOLUM" => "Pada hordeolum, jangan mengucek mata, Membersihkan kotoran mata menggunakan kain berbahan lembut yang dibasahi air hangat 2 kali sehari, Kompres mata dengan air hangat 4-6 kali sehari selama 15 menit, Cuci tangan sesudah dan setelah membersihkan mata atau menggunakan obat tetes/salep mata dan minum obat teratur, bila tidak ada perbaikan segera ke faskes terdekat",
    ];

    public function case_record_features()
    {
        return $this->hasMany(CaseRecordFeature::class, "case_record_id");
    }

    public function scopeVerified($query)
    {
        $query->where('verified', 1);
    }

    public function scopeUnverified($query)
    {
        $query->where('verified', 0);
    }

    public function loadCaseFeaturesMap()
    {
        $this->case_feature_map = $this->case_record_features
            ->mapWithKeys(function ($case_record_feature) {
                return [$case_record_feature->feature_id => $case_record_feature->value];
            });
    }

    public function getClosestCaseRecords($quantity = 10)
    {
        $this->loadCaseFeaturesMap();

        return Kasus::query()
            ->verified()
            ->with('case_record_features:id,case_record_id,feature_id,value')
            ->get()
            ->map(function (Kasus $verified_case, $index) {
                $verified_case->loadCaseFeaturesMap();

                $similar_count = 0;

                $sum = 0;
                $sim_sum = 0;

                foreach ($this->case_feature_map as $feature_id => $value) {

                    $both_exists = (1 === $value) && (1 === $verified_case->case_feature_map[$feature_id]);
                    $sum += pow($value - $verified_case->case_feature_map[$feature_id], 2);

                    $similar_count += $both_exists ? 1 : 0;
                    if ($both_exists) {
                        $sim_sum += pow($value - $verified_case->case_feature_map[$feature_id], 2);
                    }

                }
                $ratio = $similar_count / count($this->case_feature_map);

                $verified_case["distance"] = sqrt($sum);
                $verified_case["similarity"] = $ratio * (1 - sqrt($sim_sum));

                return $verified_case;
            })
            ->sortBy('distance')
            ->values()
            ->take($quantity);
    }
}
