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
            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->string('type');
            $table->string('telephone')->unique();
            $table->string('email')->unique();
            $table->string('media_file')->nullable();

            // NUEVOS CAMPOS EN INGLÉS
            $table->string('business_name');           // Nombre del emprendimiento
            $table->string('department');              // Departamento
            $table->integer('years_experience')->nullable(); // Años de trayectoria
            $table->string('business_type');           // Tipo de emprendimiento

            // Relaciones existentes
            $table->integer('entrepreneur_id')->unsigned();
            $table->foreign('entrepreneur_id')->references('id')->on('entrepreneurs')
                  ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')
                  ->onDelete('cascade')->onUpdate('cascade');

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
