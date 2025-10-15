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
        Category::create([
            'type' => 'Ropa',
            'description' => 'Ropa y accesorios',
            'icon' => 'fa-shirt'
        ]);
        Category::create([
            'type' => 'Juguetes',
            'description' => 'Juguetes para niños',
            'icon' => 'fa-gamepad'
        ]);
        Category::create([
            'type' => 'Tecnología',
            'description' => 'Celulares y electrónicos',
            'icon' => 'fa-microchip'
        ]);
        Category::create([
            'type' => 'Electrodomésticos',
            'description' => 'Aparatos para el hogar',
            'icon' => 'fa-blender'
        ]);
        Category::create([
            'type' => 'Libros',
            'description' => 'Libros y revistas',
            'icon' => 'fa-book'
        ]);
        Category::create([
            'type' => 'Rosas',
            'description' => 'Flores y plantas',
            'icon' => 'fa-spa'
        ]);
        Category::create([
            'type' => 'Piñatas',
            'description' => 'Piñatas temáticas y tradicionales',
            'icon' => 'fa-face-grin-stars'
        ]);
    }
}
