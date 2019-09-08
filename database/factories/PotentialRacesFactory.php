<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\PotentialRace::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'youtube_id' => $faker->bothify('????????????'),
        'email_sent' => false,
        'season_id' => function () {
            return factory(App\Season::class)->create()->id;
        },
        'series_id' => function () {
            return factory(App\Series::class)->create()->id;
        },
        'track_id' => function () {
            return factory(App\Track::class)->create()->id;
        },
    ];
});
