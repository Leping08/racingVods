<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Track::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'length' => $faker->randomFloat(2, 1, 14),
        'image' => $faker->imageUrl(),
        'website' => $faker->url,
        'number_of_corners' => $faker->numberBetween(1,25),
    ];
});
