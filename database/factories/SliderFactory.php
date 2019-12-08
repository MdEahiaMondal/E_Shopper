<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Slider;
use Faker\Generator as Faker;

$factory->define(Slider::class, function (Faker $faker) {
    $slider = $faker->imageUrl();
    return [
        'image' => $slider,
        'slug' =>mb_strtolower(Str::slug($slider)),
        'description' => $faker->paragraph,
        'status' => '1',
    ];
});
