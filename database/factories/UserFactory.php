<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
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
    return [
        'name' => $faker->name,
        'lastname' => $faker->userName,
        'birthday' => $faker->dateTime($max = 'now', $timezone = null),
        'gender' =>'male',
        'address' =>$faker->address,
        'avatar' =>$faker->imageUrl(),
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->unique()->phoneNumber,
        'email_verified_at' => now(),
        'password' => bcrypt('12345678'), // password
        'remember_token' => Str::random(10),
    ];
});
