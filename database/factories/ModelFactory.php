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

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
  return [
    'name' => $faker->company,
    'address1' => $faker->address,
    'city' => $faker->city,
    'state_id' => $faker->numberBetween($min = 1, $max = 51),
    'zip' => $faker->postcode,
    'added_by' => $faker->numberBetween($min = 1, $max = 8),
  ];
});

$factory->define(App\Site::class, function (Faker\Generator $faker) {
  return [
    'customer_id' => $faker->numberBetween($min = 1, $max = 3),
    'name' => $faker->company,
    'address1' => $faker->address,
    'city' => $faker->city,
    'state_id' => $faker->numberBetween($min = 1, $max = 51),
    'zip' => $faker->postcode,
    'added_by' => $faker->numberBetween($min = 1, $max = 8),
    'lat' => $faker->latitude($min = 42.072400, $max = 48.085300),
    'lon' => $faker->longitude($min = -113.792400, $max = -123.841300),
    'added_by' => $faker->numberBetween($min = 1, $max = 8),
  ];
});

$factory->define(App\System::class, function (Faker\Generator $faker) {
  return [
    'site_id' => $faker->numberBetween($min = 1, $max = 3),
    'name' => $faker->randomElement[
      'FM-200',
      'Novec',
      'Inergen',
      'Building Fire Alarm',
      'Dry Chem'
      ] . ' ' . 'System',
    'system_type_id' => $faker->numberBetween($min = 1, $max = 12),
    'install_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'ssi_install' => mt_rand(0, 1),
    'ssi_test_acct' => mt_rand(0, 1),
    'is_active' => 1,
    'notes' => $faker->sentence,
    'added_by' => mt_rand(1, 8),,
  ];
});
