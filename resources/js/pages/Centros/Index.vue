<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { centrosApi } from '@/services/api';
import type { CentroDeportivo } from '@/types/reservas';

const centros = ref<CentroDeportivo[]>([]);

onMounted(async () => {
    try {
        const response = await centrosApi.getAll();
        centros.value = response.data;
    } catch (error) {
        console.error('Error loading centros:', error);
    }
});
</script>

<template>
    <Head title="Centros Deportivos" />

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Centros Deportivos</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="centro in centros"
                    :key="centro.id"
                    class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow"
                >
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ centro.nombre }}</h2>
                    <p class="text-gray-600 mb-4">{{ centro.direccion }}</p>
                    <p class="text-sm text-gray-500 mb-4">
                        {{ centro.canchas.length }} canchas disponibles
                    </p>
                    <router-link
                        :to="`/centros/${centro.id}`"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                    >
                        Ver Canchas
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>
