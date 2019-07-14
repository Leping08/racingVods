<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\PotentialRaces;
use Faker\Generator as Faker;

$factory->define(App\ContactUs::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'message' => $faker->paragraph,
    ];
});