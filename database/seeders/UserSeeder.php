<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // Create random count of users
        $count = fake()->numberBetween(50, 100);

        // Create 10 users
        \App\Models\User::factory()->count($count)->create();
    }
}
