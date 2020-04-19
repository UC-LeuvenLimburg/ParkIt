<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Rentable;
use Faker\Generator as Faker;

$factory->define(Rentable::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,50),
        'adress' => $faker->streetAddress(),
        'postal_code' => $faker->postcode(),
        'date_of_hire' => $faker->date(),
        'start_time_rp' => $faker->time(),
        'end_time_rp' => $faker->time(),
        'price' => $faker->randomDigitNotNull(),
        'bankaccount_nr' => $faker->bankAccountNumber(),
        'description' => $faker->sentence(),
    ];
});
