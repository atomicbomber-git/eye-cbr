<?php

use Faker\Generator as Faker;

$factory->define(App\CaseRecord::class, function (Faker $faker) {
    return [
        'level' => $faker->randomElement(array_keys(App\CaseRecord::LEVELS)),
        'verified' => rand(0, 1)
    ];
});
