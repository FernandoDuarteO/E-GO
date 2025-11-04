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
        Schema::create('entrepreneurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->integer('age')->default(0);
            $table->string('sex', 10)->default('');
            $table->string('identification_card', 20)->unique()->nullable();
            $table->string('telephone', 8)->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('country')->default('');
            $table->string('nationality')->default('');
            $table->string('municipality')->default('');
            $table->string('department')->default('');
            $table->string('media_file')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrepreneurs');
    }
};
