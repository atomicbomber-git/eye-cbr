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
        $feature_count = (int) $this->command->ask("How many features do you want to be seeded?");

        DB::transaction(function() use($feature_count) {
            factory(Feature::class, $feature_count)
                ->create();
        });
    }
}
