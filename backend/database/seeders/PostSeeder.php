<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        Post::create([
            'uuid' => Str::uuid(),
            'title' => 'Welcome to our shop!',
            'slug' => Str::slug('Welcome to our shop!'),
            'content' => 'We are glad to have you here. Enjoy shopping!',
            'metadata' => json_encode(['author' => 'Admin'])
        ]);

        Post::create([
            'uuid' => Str::uuid(),
            'title' => 'New Arrivals!',
            'slug' => Str::slug('New Arrivals!'),
            'content' => 'Check out our new arrivals in the electronics section.',
            'metadata' => json_encode(['author' => 'Admin'])
        ]);
    }
}
