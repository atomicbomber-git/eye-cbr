<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function() {
            factory(Feature::class, 30)
                ->create();
        });
    }
}
