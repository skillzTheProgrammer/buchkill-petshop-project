<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;
use Illuminate\Support\Str;

class PromotionSeeder extends Seeder
{
    public function run()
    {
        Promotion::create([
            'uuid' => Str::uuid(),
            'title' => 'Summer Sale',
            'content' => 'Enjoy our summer sale with up to 50% off!',
            'metadata' => json_encode(['discount' => '50%'])
        ]);

        Promotion::create([
            'uuid' => Str::uuid(),
            'title' => 'Winter Sale',
            'content' => 'Winter sale with discounts on all winter clothes!',
            'metadata' => json_encode(['discount' => '30%'])
        ]);
    }
}
