<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Job;
use App\Models\Type;
use App\Models\Employer;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    $type = Type::all()->random();
    return [
        'title' => $faker->jobTitle,
        'city' => $faker->city,
        'suburb' => $faker->state,
        'description' => $faker->text(200),
        'salary' => '$0 - $20000',
        'use_range' => true,
        'type_id' => $type->id,
    ];
});
