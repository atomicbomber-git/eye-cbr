<?php

use Faker\Generator as Faker;

$factory->define(App\Feature::class, function (Faker $faker) {
    return [
        'description' => $faker->realText,
        'weight' => 1.0,
    ];
});
