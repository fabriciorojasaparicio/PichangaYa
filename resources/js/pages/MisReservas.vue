<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { reservasApi } from '@/services/api';
import type { Reserva } from '@/types/reservas';

const reservas = ref<Reserva[]>([]);

onMounted(async () => {
    await loadReservas();
});

const loadReservas = async () => {
    try {
        const response = await reservasApi.getMyReservations();
        reservas.value = response.data;
    } catch (error) {
        console.error('Error loading reservas:', error);
    }
};
</script>

<template>
    <Head title="Mis Reservas" />

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Mis Reservas</h1>

            <div v-if="reservas.length === 0" class="text-center py-12">
                <p class="text-gray-500 text-lg">No tienes reservas activas.</p>
            </div>

            <div v-else class="space-y-6">
                <div
                    v-for="reserva in reservas"
                    :key="reserva.id"
                    class="bg-white rounded-lg shadow-md p-6"
                >
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ reserva.cancha.nombre }}
                            </h3>
                            <p class="text-gray-600">{{ reserva.cancha.centro_deportivo.nombre }}</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                            {{ reserva.estado }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <h4 class="font-medium text-gray-900 mb-2">Horarios:</h4>
                        <div class="flex flex-wrap gap-2">
                            <span
                                v-for="slot in reserva.slots"
                                :key="slot.id"
                                class="px-3 py-1 bg-blue-100 text-blue-800 rounded-md text-sm"
                            >
                                {{ slot.fecha }} {{ slot.hora_inicio }} - {{ slot.hora_fin }}
                            </span>
                        </div>
                    </div>

                    <div class="text-sm text-gray-500">
                        Creada: {{ new Date(reserva.created_at).toLocaleDateString() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
