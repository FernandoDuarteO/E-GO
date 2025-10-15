<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Agrega el seeder de categorías aquí
        $this->call([
            CategorySeeder::class,
        ]);

        // Agrega el seeder de productos aquí
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
