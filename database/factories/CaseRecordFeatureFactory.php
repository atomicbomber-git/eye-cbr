<?php

use Faker\Generator as Faker;

$factory->define(App\CaseRecordFeature::class, function (Faker $faker) {
    return [
        'value' => rand(0, 1)
    ];
});
