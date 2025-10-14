<?php

namespace Database\Seeders;
use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['type' => 'Ropa', 'description' => 'Ropa y accesorios']);
        Category::create(['type' => 'Juguetes', 'description' => 'Juguetes para niños']);
        Category::create(['type' => 'Tecnología', 'description' => 'Celulares y electrónicos']);
        Category::create(['type' => 'Electrodomésticos', 'description' => 'Aparatos para el hogar']);
        Category::create(['type' => 'Libros', 'description' => 'Libros y revistas']);
        Category::create(['type' => 'Rosas', 'description' => 'Flores y plantas']);
    }
}
