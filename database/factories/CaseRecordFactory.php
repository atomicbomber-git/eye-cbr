<?php

use Faker\Generator as Faker;

$factory->define(App\Kasus::class, function (Faker $faker) {
    return [
        'diagnosis' => $faker->randomElement(array_keys(App\Kasus::HASIL_DIAGNOSIS)),
        'verified' => rand(0, 1)
    ];
});

$factory->state(App\Kasus::class, 'verified', [
    'verified' => 1,
]);

$factory->state(App\Kasus::class, 'unverified', [
    'verified' => 0,
    'diagnosis' => NULL,
]);
