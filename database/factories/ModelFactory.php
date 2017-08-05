<?php

use App\Component;
use App\Component_category;
use App\Customer;
use App\Manufacturer;
use App\Site;
use App\System;
use App\WorkOrderNumber;
use Carbon\Carbon;

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


$factory->define(App\State::class, function (Faker\Generator $faker) {
    return [
        'state' => $faker->state,
        'abbreviated' => $faker->stateAbbr,
    ];
});

$factory->define(App\Customer::class, function ($faker) {
  return [
    'name' => $faker->company,
    'address1' => $faker->streetAddress,
    'city' => $faker->city,
    'state_id' => function () {
      return factory('App\State')->create()->id;
    },
    'zip' => $faker->postcode,
    'added_by' => function () {
      return factory('App\User')->create()->id;
    }
  ];
});

$factory->define(App\Site::class, function ($faker) {
  return [
    'customer_id' => function () {
      return factory('App\Customer')->create()->id;
    },
    'name' => $faker->company,
    'address1' => $faker->streetAddress,
    'city' => $faker->city,
    'state_id' => function () {
      return factory('App\State')->create()->id;
    },
    'zip' => $faker->postcode,
    'lat' => $faker->latitude($min = 42.100000, $max = 48.9000000),
    'lon' => $faker->longitude($min = -112.440000, $max = -122.110000),
    'branch_office_id' => function () {
      return factory('App\BranchOffice')->create()->id;
    },
    'added_by' => function () {
      return factory('App\User')->create()->id;
    }
  ];
});

$factory->define(App\BranchOffice::class, function ($faker) {
  return [
    'name' => $faker->company,
    'address1' => $faker->streetAddress,
    'address1' => $faker->streetAddress,
    'city' => $faker->city,
    'state_id' => function () {
      return factory('App\State')->create()->id;
    },
    'zip' => $faker->postcode,
  ];
});

$factory->define(App\System::class, function ($faker) {
  return [
    'name' => $faker->company . ' System',
    'site_id' => function () {
      return factory('App\Site')->create()->id;
    },
    'system_type_id' => 1,
    'install_date' => '2000-01-01',
    'ssi_install' => 0,
    'ssi_test_acct' => 0,
    'next_test_date' => Carbon::now('America/Los_Angeles')->addYear()->toDateString(),
    'is_active' => 1,
  ];
});

$factory->define(App\Component::class, function ($faker) {
  return [
    'manufacturer_id' => function () {
      return factory('App\Manufacturer')->create()->id;
    },
    'component_category_id' => function () {
      return factory('App\Component_category')->create()->id;
    },
    'model' => $faker->word . $faker->randomNumber(6),
    'description' => $faker->sentence(50),
    'discontinued' => 0,
  ];
});

$factory->define(App\Manufacturer::class, function ($faker) {
  return [
    'name' => $faker->word,
  ];
});

$factory->define(App\Component_category::class, function ($faker) {
  return [
    'name' => $faker->word,
  ];
});

// WORK ORDERS

$factory->define(App\WorkOrder::class, function ($faker) {
  return [
    'site_id' => function () {
      return factory('App\Site')->create()->id;
    },
    'created_by' => function () {
      return factory('App\User')->create()->id;
    },
    'assigned_to' => function () {
      return factory('App\User')->create()->id;
    },
    'completed_by' => function () {
      return factory('App\User')->create()->id;
    },
    'status_id' => function () {
      return factory('App\WorkOrderStatus')->create()->id;
    },
    'type_id' => function () {
      return factory('App\WorkOrderType')->create()->id;
    },
    'work_order_billing_status_id' => function () {
      return factory('App\WorkOrderBillingStatus')->create()->id;
    },
    'point_of_contact' => $faker->firstName . ' ' . $faker->lastName . ', ' . $faker->phoneNumber,
    'customer_purchase_order' => $faker->randomNumber(4) . '-' . $faker->randomNumber(5),
    'title' => $faker->sentence,
    'scope_of_work' => $faker->paragraph,
    'resolution' => $faker->paragraph,
    'charges' => $faker->sentence,
    'closed_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'created_at_pst' => Carbon::now('America/Los_Angeles')
  ];
});

$factory->define(App\WorkOrderStatus::class, function ($faker) {
  return ['status' => $faker->word];
});

$factory->define(App\WorkOrderBillingStatus::class, function ($faker) {
  return ['status' => $faker->word];
});

$factory->define(App\WorkOrderType::class, function ($faker) {
  return ['name' => $faker->word];
});
