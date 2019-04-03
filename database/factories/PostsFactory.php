<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(50, 2),
        'body' => $faker->realText(1000, 2),
        'user_id' =>$faker->numberBetween(1, 4)
    ];
});
