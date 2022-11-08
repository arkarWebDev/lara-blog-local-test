<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create();
        
        User::factory()->create([
            'name' => 'Htoo Arkar Linn',
            'email' => 'admin@gmail.com',
            'role' => "0"
        ]);

        User::factory()->create([
            'name' => 'Thel Su Yin Nway',
            'email' => 'editor@gmail.com',
            'role' => "1"
        ]);
    }
}