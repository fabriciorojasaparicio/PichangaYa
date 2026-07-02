<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/vue3';
const props = defineProps<{
    centros: Array<{
        id: number;
        nombre: string;
        direccion: string;
        canchas_count?: number;
    }>;
}>();

function deleteCentro(id: number) {
    if (!confirm('¿Eliminar este centro?')) return;
    Inertia.delete(route('propietario.centros.destroy', id));
}
</script>

<template>
    <Head title="Mis Centros" />

    <div class="min-h-screen bg-surface px-4 py-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-8 shadow-sm">
                <h1 class="text-3xl font-bold">Mis Centros</h1>
                <p class="mt-3 text-base text-slate-600">
                    Administra los centros deportivos que pertenecen a tu propiedad.
                </p>
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                <div class="flex items-center justify-between col-span-2">
                    <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm w-full">
                        <h2 class="text-xl font-semibold">Listado de centros</h2>
                        <p class="mt-2 text-sm text-slate-600">Agrega, edita o elimina centros deportivos.</p>
                    </div>
                    <div class="ml-4">
                        <a href="/propietario/centros/create" class="inline-block bg-primary text-white px-4 py-2 rounded-lg">Crear Centro</a>
                    </div>
                </div>

                <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm col-span-2">
                    <h2 class="text-xl font-semibold">Listado de centros</h2>
                    <p class="mt-2 text-sm text-slate-600">Agrega, edita o elimina centros deportivos.</p>

                    <div class="mt-6 overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-700">
                            <thead class="border-b border-slate-200 text-slate-900">
                                <tr>
                                    <th class="py-3 pr-4">Nombre</th>
                                    <th class="py-3 pr-4">Dirección</th>
                                    <th class="py-3 pr-4">Canchas</th>
                                    <th class="py-3 pr-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="centro in props.centros" :key="centro.id" class="border-b border-slate-100 hover:bg-slate-50">
                                    <td class="py-3 pr-4">{{ centro.nombre }}</td>
                                    <td class="py-3 pr-4">{{ centro.direccion }}</td>
                                    <td class="py-3 pr-4">{{ centro.canchas_count ?? '-' }}</td>
                                    <td class="py-3 pr-4">
                                        <a :href="`/propietario/centros/${centro.id}/edit`" class="text-sm text-primary mr-3">Editar</a>
                                        <button @click.prevent="deleteCentro(centro.id)" class="text-sm text-red-600">Eliminar</button>
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

