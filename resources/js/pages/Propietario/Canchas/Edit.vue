<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps<{ cancha: any; centros: any[] }>();

const form = useForm({
    centro_deportivo_id: props.cancha.centro_deportivo_id,
    nombre: props.cancha.nombre,
    precio_por_bloque: props.cancha.precio_por_bloque,
    max_bloques_reserva: props.cancha.max_bloques_reserva,
    activo: props.cancha.activo,
});

function submit() {
    form.put(route('propietario.canchas.update', props.cancha.id));
}
</script>

<template>
    <Head title="Editar Cancha" />

    <div class="min-h-screen bg-surface px-4 py-8">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-8 shadow-sm">
                <h1 class="text-2xl font-bold">Editar Cancha</h1>

                <form @submit.prevent="submit" class="mt-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Centro</label>
                        <select v-model="form.centro_deportivo_id" class="mt-1 block w-full rounded-lg border p-2">
                            <option v-for="c in props.centros" :value="c.id" :key="c.id">{{ c.nombre }}</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Nombre</label>
                        <input v-model="form.nombre" class="mt-1 block w-full rounded-lg border p-2" />
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-slate-700">Precio por bloque</label>
                            <input v-model.number="form.precio_por_bloque" type="number" step="0.01" class="mt-1 block w-full rounded-lg border p-2" />
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-slate-700">Máx bloques</label>
                            <input v-model.number="form.max_bloques_reserva" type="number" class="mt-1 block w-full rounded-lg border p-2" />
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">Guardar</button>
                        <a :href="`/propietario/canchas`" class="text-sm text-slate-600">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
