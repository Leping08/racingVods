<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Season::class, function (Faker $faker) {
    return [
        'name' => '20' . $faker->numberBetween(10,19),
    ];
});
