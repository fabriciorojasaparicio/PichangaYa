<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    nombre: '',
    direccion: '',
    region_id: null,
    ciudad_id: null,
    distrito_id: null,
    latitud: null,
    longitud: null,
});

function submit() {
    form.post(route('propietario.centros.store'));
}
</script>

<template>
    <Head title="Crear Centro" />

    <div class="min-h-screen bg-surface px-4 py-8">
        <div class="mx-auto max-w-3xl">
            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-8 shadow-sm">
                <h1 class="text-2xl font-bold">Crear Centro Deportivo</h1>

                <form @submit.prevent="submit" class="mt-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Nombre</label>
                        <input v-model="form.nombre" class="mt-1 block w-full rounded-lg border p-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Dirección</label>
                        <input v-model="form.direccion" class="mt-1 block w-full rounded-lg border p-2" />
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-slate-700">Latitud</label>
                            <input v-model="form.latitud" type="number" step="any" class="mt-1 block w-full rounded-lg border p-2" />
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-slate-700">Longitud</label>
                            <input v-model="form.longitud" type="number" step="any" class="mt-1 block w-full rounded-lg border p-2" />
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">Crear</button>
                        <a href="/propietario/centros" class="text-sm text-slate-600">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
