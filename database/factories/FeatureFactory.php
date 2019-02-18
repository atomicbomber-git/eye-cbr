<?php

use Faker\Generator as Faker;

$factory->define(App\Feature::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'weight' => 1.0,
    ];
});
