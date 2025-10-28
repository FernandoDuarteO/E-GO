<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            // usar el mismo tipo que products->increments('id') => INT UNSIGNED
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')
                  ->references('id')->on('products')
                  ->onDelete('cascade')->onUpdate('cascade');

            // ruta del archivo en storage (ej: products/abcd.jpg)
            $table->string('file_path');
            // opcional: orden en el carrusel
            $table->unsignedInteger('order')->nullable();
            // opcional: texto alternativo
            $table->string('alt')->nullable();
            $table->timestamps();

            // índice (opcional, la FK ya crea índice)
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};