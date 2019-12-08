<?php

use App\Brand;
use App\Category;
use App\Product;
use App\Slider;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
            factory(User::class, 50)->create();
            $this->call(AdminTableSeeder::class);
            factory(Category::class, 10)->create();
            factory(Brand::class, 10)->create();
            factory(Slider::class, 10)->create();
            factory(Product::class, 50)->create();

    }
}
