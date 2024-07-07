<?php

// database/seeders/OrderSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderStatus;
use App\Models\Payment;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('is_admin', 0)->get();
        $statuses = OrderStatus::all();
        $paymentMethods = ['Credit Card', 'PayPal', 'Bank Transfer'];

        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                $status = $statuses->random();
                $payment = null;

                if ($status->title === 'paid' || $status->title === 'shipped') {
                    $payment = Payment::create([
                        'uuid' => Str::uuid(),
                        'type' => $paymentMethods[array_rand($paymentMethods)],
                        'details' => json_encode(['info' => 'Payment details']),
                        'user_id' => $user->id
                    ]);
                }

                Order::create([
                    'user_id' => $user->id,
                    'order_status_id' => $status->id,
                    'payment_id' => $payment ? $payment->id : null,
                    'uuid' => Str::uuid(),
                    'products' => json_encode(['product_1' => 'Product details']),
                    'address' => 'Somewhere in the world',
                    'delivery_fee' => 15.00,
                    'amount' => 100.00,
                    'shipped_at' => $status->title === 'shipped' ? now() : null
                ]);
            }
        }
    }
}
