<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employer;
use Faker\Generator as Faker;

$factory->define(Employer::class, function (Faker $faker) {
    return [
        'business_name' => $faker->word(),
        'introduction' => $faker->paragraph,
        'city' => $faker->city,
        'website' => $faker->url,
        'phone_number' => $faker->phoneNumber,
        
    ];
});
