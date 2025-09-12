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
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('role');

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('administrator_id')->unsigned();
            $table->foreign('administrator_id')->references('id')->on('administrators')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('entrepreneur_id')->unsigned();
            $table->foreign('entrepreneur_id')->references('id')->on('entrepreneurs')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
