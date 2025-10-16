<?php

namespace Database\Seeders;
use App\Models\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Piñata de Shrek',
            'quantity' => '5',
            'description' => 'Piñata temática de Shrek, ideal para fiestas infantiles.',
            'price' => 100.99,
            'media_file' => 'piñata.jpg', // El nombre exacto de la imagen que pusiste en storage/app/public
            'category_id' => 1 // O el ID de la categoría que corresponda
        ]);
    }
}
