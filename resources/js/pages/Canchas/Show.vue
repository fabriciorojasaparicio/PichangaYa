<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { canchasApi, reservasApi } from '@/services/api';
import type { Cancha, HorarioSlot } from '@/types/reservas';

const cancha = ref<Cancha | null>(null);
const slots = ref<HorarioSlot[]>([]);
const selectedSlots = ref<number[]>([]);
const fecha = ref(new Date().toISOString().split('T')[0]);
const canchaId = ref<number>(0);

onMounted(async () => {
    canchaId.value = parseInt($route.params.cancha as string);
    await loadCancha();
    await loadSlots();
});

const loadCancha = async () => {
    try {
        const response = await canchasApi.getById(canchaId.value);
        cancha.value = response.data;
    } catch (error) {
        console.error('Error loading cancha:', error);
    }
};

const loadSlots = async () => {
    try {
        const response = await canchasApi.getSlots(canchaId.value, fecha.value);
        slots.value = response.data;
    } catch (error) {
        console.error('Error loading slots:', error);
    }
};

const toggleSlot = (slotId: number) => {
    const index = selectedSlots.value.indexOf(slotId);

    if (index > -1) {
        selectedSlots.value.splice(index, 1);
    } else {
        if (selectedSlots.value.length < (cancha.value?.max_bloques_reserva || 0)) {
            selectedSlots.value.push(slotId);
        }
    }
};

const reservar = async () => {
    if (selectedSlots.value.length === 0) {
return;
}

    try {
        await reservasApi.create({
            cancha_id: canchaId.value,
            slots: selectedSlots.value,
        });

        alert('Reserva creada correctamente!');
        selectedSlots.value = [];
        await loadSlots();
    } catch (error: any) {
        alert(error.response?.data?.message || 'Error al reservar');
    }
};
</script>

<template>
    <Head title="Reservar Cancha" />

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div v-if="cancha" class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ cancha.nombre }}</h1>
                <p class="text-gray-600 mb-4">{{ cancha.centro_deportivo.nombre }}</p>
                <p class="text-gray-600">${{ cancha.precio_por_bloque }} por bloque</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">Seleccionar Fecha</h2>
                <input
                    v-model="fecha"
                    type="date"
                    @change="loadSlots"
                    class="border border-gray-300 rounded-md px-3 py-2"
                />
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Horarios Disponibles</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <button
                        v-for="slot in slots"
                        :key="slot.id"
                        @click="slot.estado === 'libre' ? toggleSlot(slot.id) : null"
                        :class="[
                            'p-3 rounded-md text-sm font-medium transition-colors',
                            slot.estado === 'libre'
                                ? selectedSlots.includes(slot.id)
                                    ? 'bg-blue-600 text-white'
                                    : 'bg-green-100 text-green-800 hover:bg-green-200'
                                : 'bg-gray-100 text-gray-500 cursor-not-allowed'
                        ]"
                    >
                        {{ slot.hora_inicio }} - {{ slot.hora_fin }}
                        <span class="block text-xs capitalize">({{ slot.estado }})</span>
                    </button>
                </div>

                <div class="mt-6 flex justify-between items-center">
                    <p class="text-gray-600">
                        Seleccionados: {{ selectedSlots.length }} / {{ cancha?.max_bloques_reserva || 0 }}
                    </p>
                    <button
                        @click="reservar"
                        :disabled="selectedSlots.length === 0"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition-colors"
                    >
                        Reservar ({{ selectedSlots.length * (cancha?.precio_por_bloque || 0) }})
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
