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
        Schema::create('pokemons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id');
            $table->string('name');
            $table->string('abilities')->nullable();
            $table->string('habitat')->nullable();
            $table->string('front_default')->nullable();
            $table->string('back_default')->nullable();
            $table->string('front_female')->nullable();
            $table->string('back_female')->nullable();
            $table->string('front_shiny')->nullable();
            $table->string('back_shiny')->nullable();
            $table->string('front_shiny_female')->nullable();
            $table->string('back_shiny_female')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemons');
    }
};
