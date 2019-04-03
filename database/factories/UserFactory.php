<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $profile_pictures = ['UU8DI2g.jpg', 'l0o31Tn.png', '6a0LF3N.jpg', 'caHQ0Ht.png', 'OqJb76V.jpg', 'qWouajd.jpg', 'cyWrrAA.jpg'];

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'profile_picture' => 'https://i.imgur.com/'.$profile_pictures[rand(0, count($profile_pictures) - 1)],
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
