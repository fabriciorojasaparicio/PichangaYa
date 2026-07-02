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
        Schema::create('cancha_deporte', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cancha_id')->constrained()->cascadeOnDelete();
            $table->foreignId('deporte_id')->constrained('deportes')->cascadeOnDelete();
            $table->decimal('precio_hora', 8, 2)->nullable();
            $table->timestamps();
            
            $table->unique(['cancha_id', 'deporte_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancha_deporte');
    }
};
