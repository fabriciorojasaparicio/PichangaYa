<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/vue3';
const props = defineProps<{
    canchas: Array<{
        id: number;
        nombre: string;
        precio_por_bloque: number;
        activo: boolean;
        centro_deportivo?: { nombre?: string };
    }>;
}>();

function deleteCancha(id: number) {
    if (!confirm('¿Eliminar esta cancha?')) return;
    Inertia.delete(route('propietario.canchas.destroy', id));
}
</script>

<template>
    <Head title="Centro Canchas" />

    <div class="min-h-screen bg-surface px-4 py-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-8 shadow-sm">
                <h1 class="text-3xl font-bold">Centro Canchas</h1>
                <p class="mt-3 text-base text-slate-600">
                    Controla el inventario y la disponibilidad de tus canchas.
                </p>
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                <div class="flex items-center justify-between col-span-2">
                    <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm w-full">
                        <h2 class="text-xl font-semibold">Lista de canchas</h2>
                        <p class="mt-2 text-sm text-slate-600">Administra precios, horarios y estado para cada cancha.</p>
                    </div>
                    <div class="ml-4">
                        <a href="/propietario/canchas/create" class="inline-block bg-primary text-white px-4 py-2 rounded-lg">Crear Cancha</a>
                    </div>
                </div>

                <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm col-span-2">
                    <div class="mt-6 overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-700">
                            <thead class="border-b border-slate-200 text-slate-900">
                                <tr>
                                    <th class="py-3 pr-4">Cancha</th>
                                    <th class="py-3 pr-4">Centro</th>
                                    <th class="py-3 pr-4">Precio por bloque</th>
                                    <th class="py-3 pr-4">Estado</th>
                                    <th class="py-3 pr-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cancha in props.canchas" :key="cancha.id" class="border-b border-slate-100 hover:bg-slate-50">
                                    <td class="py-3 pr-4">{{ cancha.nombre }}</td>
                                    <td class="py-3 pr-4">{{ cancha.centro_deportivo?.nombre ?? '—' }}</td>
                                    <td class="py-3 pr-4">S/ {{ Number(cancha.precio_por_bloque).toFixed(2) }}</td>
                                    <td class="py-3 pr-4">{{ cancha.activo ? 'Activo' : 'Inactivo' }}</td>
                                    <td class="py-3 pr-4">
                                        <a :href="`/propietario/canchas/${cancha.id}/edit`" class="text-sm text-primary mr-3">Editar</a>
                                        <button @click.prevent="deleteCancha(cancha.id)" class="text-sm text-red-600">Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
