<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'phone_number' => $faker->phoneNumber,
        'summary' => $faker->paragraph,
        'resume_path' => $faker->url,
    ];
});
