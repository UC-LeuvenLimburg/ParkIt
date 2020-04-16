<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lease;
use Faker\Generator as Faker;

$factory->define(Lease::class, function (Faker $faker) {
    return [
        'user_id' => $faker -> randomNumber(2),
        'rentable_id' => $faker -> randomNumber(2),
        'start_time' => $faker-> time,
        'end_time' => $faker-> time,
    ];
});
