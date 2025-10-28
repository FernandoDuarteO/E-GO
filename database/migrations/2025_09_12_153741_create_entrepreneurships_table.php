<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entrepreneurships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->string('description', 1000)->default('');
            $table->string('address')->default('');
            $table->string('type')->default('');
            $table->string('telephone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('media_file')->nullable();
            $table->string('business_name');
            $table->string('department');
            $table->integer('years_experience')->default(0);
            $table->string('business_type')->default('');

            // Relaciones existentes
            $table->unsignedInteger('entrepreneur_id')->nullable();
            $table->foreign('entrepreneur_id')->references('id')->on('entrepreneurs')
                  ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')
                  ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('user_id'); // ID del usuario propietario
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrepreneurships');
    }
};