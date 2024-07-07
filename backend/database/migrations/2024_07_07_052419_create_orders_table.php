<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('order_status_id')->constrained('order_statuses');
            $table->foreignId('payment_id')->nullable()->constrained('payments'); // Make payment_id nullable
            $table->uuid('uuid');
            $table->json('products')->nullable();
            $table->string('address')->nullable();
            $table->double('delivery_fee', 8, 2)->nullable();
            $table->double('amount', 12, 2)->nullable();
            $table->timestamps();
            $table->timestamp('shipped_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
