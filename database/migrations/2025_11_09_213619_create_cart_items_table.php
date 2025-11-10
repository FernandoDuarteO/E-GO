<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->cascadeOnDelete();

            // Si products.id fue creado con increments() (unsigned INT) usamos unsignedInteger
            $table->unsignedInteger('product_id');

            $table->unsignedInteger('quantity')->default(1);
            // snapshot price/subtotal (recomendado)
            $table->decimal('price', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->json('options')->nullable();
            $table->timestamps();

            // Clave única por cart/product
            $table->unique(['cart_id', 'product_id'], 'cart_product_unique');

            // Añadir la FK manualmente, especificando tipo EXACTO
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};