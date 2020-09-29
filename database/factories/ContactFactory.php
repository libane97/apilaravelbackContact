<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(6,true),
        'telephone' => $faker->e164PhoneNumber(3,true),
        'address' => $faker->sentence(4,true),
        'civility' => $faker->sentence(5,true)
    ];
});
