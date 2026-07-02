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
        Schema::create('reserva_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reserva_id')->constrained()->cascadeOnDelete();
            $table->foreignId('horario_slot_id')->constrained()->cascadeOnDelete();
            $table->unique(['reserva_id', 'horario_slot_id'], 'reserva_slots_reserva_horario_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva_slots');
    }
};
