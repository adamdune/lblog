<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 4)->create();
        factory(App\User::class)->make([
            'name' => 'Demoman Demo',
            'email' => 'demo@demo.com',
            'email_verified_at' => now(),
            'profile_picture' => 'https://i.imgur.com/UU8DI2g.jpg',
            'password' => bcrypt('password1'),
            'remember_token' => Str::random(10),
        ])->save();
    }
}
