<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => fake()->name,
            'email' => fake()->email,
        ]);

        Film::factory()->create([
            'creator_id'=>fake()->numberBetween(0,5),
            'name'=>fake()->text(50),
            'description'=>fake()->text(150),
            'date'=>fake()->date,
        ]);
    }
}
