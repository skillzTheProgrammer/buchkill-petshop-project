<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        // Get a random valid order status id
        $orderStatusId = OrderStatus::inRandomOrder()->first()->id;

        return [
            'user_id' => User::factory(),
            'order_status_id' => $orderStatusId, // Ensure this is a valid status ID
            'payment_id' => null,
            'uuid' => Str::uuid(),
            'products' => json_encode(['product_name' => 'Sample Product', 'quantity' => 1]),
            'address' => 'Sample Street, Sample City, Sample State',
            'delivery_fee' => 5.00,
            'amount' => 50.00,
            'shipped_at' => now(),
        ];
    }
}
