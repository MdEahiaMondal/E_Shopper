<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $category = $faker->unique(true)->company;
    return [
        'name' => $category,
        'slug' =>mb_strtolower(Str::slug( $category)),
        'description' => $faker->paragraph,
        'status' => '1',
    ];
});
