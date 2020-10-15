<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->firstName(6,true),
        'message' => $faker->text(10,true),
        'picture' => $faker->imageUrl($width = 640, $height = 480, 'cats', true, 'Faker'),
        'likes' => $faker->numberBetween($min = 1, $max = 50),
    ];
});
