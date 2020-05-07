<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Rentable;
use Faker\Generator as Faker;

$factory->define(Rentable::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('nl_BE');
    return [
        'user_id' => $faker->numberBetween(1, 50),
        'adress' => $faker->streetAddress(),
        'postal_code' => $faker->postcode(),
        'lat' => $faker->latitude(50.425440, 51.210950),
        'long' => $faker->longitude(3.226630, 6.029510),
        'date_of_hire' => $faker->dateTimeBetween('+30 days', '+2 years'),
        'start_time' => date('H:i', rand(3900, 42000)),
        'end_time' => date('H:i', rand(46800, 86100)),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 0.40) * 10,
        'bankaccount_nr' => $faker->bankAccountNumber(),
        'description' => $faker->sentence(),
    ];
});
