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
        Schema::create('tipos_cancha', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('cancha_tipo', function (Blueprint $table) {
            $table->foreignId('cancha_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tipo_cancha_id')->constrained('tipos_cancha')->cascadeOnDelete();
            $table->unique(['cancha_id', 'tipo_cancha_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancha_tipo');
        Schema::dropIfExists('tipos_cancha');
    }
};
