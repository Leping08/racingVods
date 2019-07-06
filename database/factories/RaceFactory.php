<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Race::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'race_date' => $faker->dateTimeBetween('-1 year', 'now'),
        'series_id' => function () {
            return factory(App\Series::class)->create()->id;
        },
        'track_id' => function () {
            return factory(App\Track::class)->create()->id;
        },
        'duration' => $faker->numberBetween(1,24) . ' Hours ' . $faker->numberBetween(0,60) . 'Minutes',
        'season_id' => function () {
            return factory(App\Season::class)->create()->id;
        },
    ];
});
