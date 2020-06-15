<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Ussd::class, function (Faker $faker) {
    return [
        'customeridnumber' => $faker->randomDigit,
        'customermobilenumber' => $faker->randomDigit,
        'loanproduct' => $faker->text(50),
        'loanamount' => $faker->randomDigit,
        'loanterm' => $faker->text(50),
        'customerfullnames' => $faker->text(50),
        'loanapplicationdate' => $faker->randomDigit
    ];
});
