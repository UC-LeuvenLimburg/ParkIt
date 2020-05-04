<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Rentable;
use Faker\Generator as Faker;

$factory->define(Rentable::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 50),
        'adress' => $faker->streetAddress(),
        'postal_code' => $faker->postcode(),
        'date_of_hire' => $faker->dateTimeBetween('+30 days', '+2 years'),
        'start_time' => date('H:i', rand(3900, 42000)),
        'end_time' => date('H:i', rand(46800, 86100)),
        'price' => $faker->randomDigitNotNull(),
        'bankaccount_nr' => $faker->bankAccountNumber(),
        'description' => $faker->sentence(),
    ];
});
