<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lease;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Lease::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 50),
        'rentable_id' => $faker->numberBetween(1, 50),
        'start_time' => $faker->time,
        'end_time' => $faker->time,
        'phone_nr' => $faker->phoneNumber,
        'license_plate' => Str::random(7),
    ];
});
