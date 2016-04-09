<?php

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
    $passcode = str_random(10);
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        "passcode"       => $passcode,
        'password'       => bcrypt($passcode),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Report::class, function(Faker\Generator $faker) {
    return[
        "user_id" => function () {
            return factory(App\User::class)->create()->id;
        },
        "test_date"        => \Carbon\Carbon::now()->format('d-m-Y'),
        "testing_lab"      => $faker->company,
        "case_number"      => str_random(12),
        "report_name"      => $faker->streetName,
        "patient_history"  => $faker->text(),
        "description"      => $faker->text(),
        "status"           => '0',
        "addition_details" => $faker->text()
    ];
});
