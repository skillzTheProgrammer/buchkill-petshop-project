<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            OrderStatusSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            PromotionSeeder::class,
            PostSeeder::class,
            OrderSeeder::class,
            ProductSeeder::class,
        ]);
    }
}