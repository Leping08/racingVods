<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\PotentialRaces::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'youtube_id' => $faker->bothify('????????????'),
    ];
});
