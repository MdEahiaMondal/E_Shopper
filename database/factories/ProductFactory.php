<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brand;
use App\Category;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->unique(true)->sentence(4, true);
    return [
        'name' => $name,
        'slug' => mb_strtolower(Str::slug($name)),
        'category_id' => function(){
            return   Category::inRandomOrder()->first()->id;
        },
        'brand_id' => function(){
            return   Brand::inRandomOrder()->first()->id;
        },
        'description' => $faker->paragraph,
        'image' => $faker->imageUrl(),
        'price' => $faker->randomDigit,
        'quantity' => $faker->randomDigit,
        'size' => $faker->randomDigit,
        'color' => $faker->colorName,
        'status' => '1',
        'features' => '1',
    ];
});
