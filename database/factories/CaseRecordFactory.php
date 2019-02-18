<?php

use Faker\Generator as Faker;

$factory->define(App\CaseRecord::class, function (Faker $faker) {
    return [
        'level' => $faker->randomElement(array_keys(App\CaseRecord::LEVELS)),
        'verified' => rand(0, 1)
    ];
});

$factory->state(App\CaseRecord::class, 'verified', [
    'verified' => 1,
]);

$factory->state(App\CaseRecord::class, 'unverified', [
    'verified' => 0,
    'level' => NULL,
]);
