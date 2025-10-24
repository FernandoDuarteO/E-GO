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
            // CORREGIDO: Los siguientes campos deben ser nullable para permitir el registro sin llenarlos
            $table->string('name')->nullable();         // <-- antes era obligatorio, ahora nullable
            $table->text('description')->nullable();    // <-- antes era obligatorio, ahora nullable
            $table->string('address')->nullable();      // <-- antes era obligatorio, ahora nullable
            $table->string('type')->nullable();         // <-- antes era obligatorio, ahora nullable
            $table->string('telephone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('media_file')->nullable();

            // NUEVOS CAMPOS EN INGLÉS
            $table->string('business_name');           // Nombre del emprendimiento
            $table->string('department');              // Departamento
            $table->integer('years_experience')->nullable(); // Años de trayectoria
            $table->string('business_type');           // Tipo de emprendimiento

            // Relaciones existentes
            $table->integer('entrepreneur_id')->unsigned()->nullable();
            $table->foreign('entrepreneur_id')->references('id')->on('entrepreneurs')
                  ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('client_id')->unsigned()->nullable();
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
