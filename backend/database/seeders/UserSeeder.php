<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        //for admin users
        // Admin::create([
        //     'uuid' => Str::uuid(),
        //     'first_name' => 'Admin',
        //     'last_name' => 'User',
        //     'is_admin' => 1,
        //     'email' => 'admin@buckhill.co.uk',
        //     'password' => Hash::make('admin'),
        // ]);

        // Create dummy users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'uuid' => Str::uuid(),
                'first_name' => "User{$i}",
                'last_name' => "Lastname{$i}",
                'is_admin' => 0,
                'email' => "user{$i}@example.com",
                'phone_number' => "090{$i}90786",
                'address' => "no {$i} thomson ave nigeria",
                'password' => Hash::make('userpassword'),
            ]);
        }
    }
}
