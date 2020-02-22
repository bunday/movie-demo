<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Movie::class, function (Faker $faker) {
    $title = $faker->word;
    return [
        'title' => $title,
        'description' => $faker->text,
        'image' => url('/').('/images/default.png'),
        'release_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'rating' => $faker->numberBetween($min = 1, $max = 5),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000) ,
        'country' => $faker->country,
        'genre' => $faker->words($nb = 3, $asText = true),
        'user_id' => 1, // test account
        'slug' => Str::slug($title)
    ];
});
