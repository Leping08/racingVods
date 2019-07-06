<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Series::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'full_name' => $faker->name,
        'image' => $faker->imageUrl() . '.jpg',
        'description' => $faker->paragraph,
        'website' => $faker->url,
        'youtube_chanel_name' => $faker->word,
    ];
});
