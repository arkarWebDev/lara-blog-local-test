<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Nation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nations = ["Myanmar","Thailand","Japan"];
        foreach($nations as $nation){
            Nation::factory()->create([
                "name" => $nation
            ]);
        }
    }
}