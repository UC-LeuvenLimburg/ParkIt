<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lease;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Lease::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('nl_BE');
    return [
        'user_id' => $faker->numberBetween(1, 50),
        'rentable_id' => $faker->numberBetween(5, 50),
        'start_time' => date('H:i', rand(3900, 42000)),
        'end_time' => date('H:i', rand(46800, 86100)),
        'phone_nr' => $faker->phoneNumber,
        'license_plate' => Str::random(9),
        'payed_at' => now(),
    ];
});
