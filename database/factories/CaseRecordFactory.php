<?php

use Faker\Generator as Faker;

$factory->define(App\CaseRecord::class, function (Faker $faker) {
    return [
        'verified' => rand(0, 1)
    ];
});
