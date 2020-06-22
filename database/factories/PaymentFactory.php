<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'loan_id' => $faker->numberBetween($min = 1, $max = 50),
        'payment_number'=> $faker->numberBetween($min = 0, $max = 50),
        'amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
        'date_payment' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'received_amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
    ];
});
