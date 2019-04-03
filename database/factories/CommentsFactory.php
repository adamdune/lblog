<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'comment' => "<p>{$faker->realText(75, 2)}</p>",
        'user_id' => $faker->numberBetween(1, 4),
        'post_id' => $faker->numberBetween(98, 117),
    ];
});
