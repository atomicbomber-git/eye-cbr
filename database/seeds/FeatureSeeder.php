<?php

use App\Gejala;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    const FEATURE_NAMES = [
        "Kabur",
        "Mengalami penurunan tajam penglihatan",
        "Mengalami nyeri kepala",
        "Mengalami mata merah",
        "Pandangan tampak ganda",
        "Silau",
        "Mengalami mata perih",
        "Tajam penglihatan tidak terganggu",
        "Penglihatan jarak jauh buram",
        "Penglihatan jarak dekat baik",
        "Terdapat benjolan pada kelopak mata",
        "Tampak kemerahan pada kelopak mata",
        "Mengalami mata berair",
        "Mengalami mata gatal",
        "Pandangan seperti berkabut",
        "Merasa seperti ada bayangan hitam",
        "Merasa lengket di sekitar bola mata",
        "Mengalami bengkak",
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        foreach (self::FEATURE_NAMES as $feature_name) {
            Gejala::query()->create([
                "description" => $feature_name,
            ]);
        }

        DB::commit();
    }
}
