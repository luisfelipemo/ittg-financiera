<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Loan;
use Faker\Generator as Faker;

$factory->define(Loan::class, function (Faker $faker) {
    return [
        'client_id'     => $faker->numberBetween($min = 1, $max = 50),
        'amount'        => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
        'payments_n'    => $faker->randomDigit(),
        'quota'          => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
        'total'         => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
        'ministering_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'due_date'      => $faker->date($format = 'Y-m-d', $max = 'now'),
        'finished'      => $faker->boolean(),
    ];
});
