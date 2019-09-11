<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\PotentialRace;
use Faker\Generator as Faker;

$factory->define(App\View::class, function (Faker $faker) {
    return [
        'viewable_type' => 'App\Race',
        'viewable_id' => function () {
            return factory(App\Race::class)->create()->id;
        }
    ];
});