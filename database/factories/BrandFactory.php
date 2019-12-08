<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brand;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {
    $brand = $faker->unique()->word;
    return [
        'name' => $brand,
        'slug' =>mb_strtolower(Str::slug( $brand)),
        'description' => $faker->paragraph,
        'status' => '1',
        'image' => $faker->imageUrl(),
    ];
});
