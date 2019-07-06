<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Video::class, function (Faker $faker) {
    return [
        'youtube_id' => $faker->bothify('????????????'),
        'youtube_start_time' => $faker->numberBetween(1,500),
        'race_id' => function () {
            return factory(App\Race::class)->create()->id;
        },
    ];
});
