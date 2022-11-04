<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
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
        \App\Models\User::factory(20)->create();
        
        \App\Models\User::factory()->create([
            'name' => 'Htoo Arkar Linn',
            'email' => 'admin@gmail.com',
            'role' => "0"
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Thel Su Yin Nway',
            'email' => 'editor@gmail.com',
            'role' => "1"
        ]);

        $this->call([
            CategorySeeder::class,
            PostSeeder::class
        ]);
    }
}