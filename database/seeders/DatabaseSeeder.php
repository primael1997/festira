<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Edition;
use App\Models\Participant;
use App\Models\Post;
use App\Models\Sponsort;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(10)->create();
        Edition::factory(10)->create();
        Post::factory(30)->create();
        Participant::factory(50)->create();
        Sponsort::factory(50)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
    }
}
