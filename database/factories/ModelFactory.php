<?php

use App\Site;
use App\System;
use App\Customer;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Customer::class, function ($faker) {
  return [
    'name' => $faker->company,
    'address1' => $faker->address,
    'city' => $faker->city,
    'state_id' => $faker->numberBetween($min = 1, $max = 51),
    'zip' => $faker->postcode,
    'added_by' => function () {
      return factory('App\User')->create()->id;
    }
  ];
});
