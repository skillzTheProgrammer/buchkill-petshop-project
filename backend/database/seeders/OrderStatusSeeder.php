<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;
use Illuminate\Support\Str;

class OrderStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            'open',
            'pending payment',
            'paid',
            'shipped',
            'cancelled'
        ];

        foreach ($statuses as $status) {
            OrderStatus::create([
                'uuid' => Str::uuid(),
                'title' => $status
            ]);
        }
    }
}
