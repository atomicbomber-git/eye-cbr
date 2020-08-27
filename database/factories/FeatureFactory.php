<?php

use Faker\Generator as Faker;

$factory->define(App\Gejala::class, function (Faker $faker) {
    return [
        'description' => 'Gejala ' . $faker->index,
        'weight' => 1.0,
    ];
});
