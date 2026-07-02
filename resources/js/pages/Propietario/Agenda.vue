<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
const props = defineProps<{
    reservas: Array<{
        id: number;
        fecha: string;
        estado: string;
        cancha?: { nombre?: string; centro_deportivo?: { nombre?: string } };
        user?: { name?: string };
    }>;
}>();
</script>

<template>
    <Head title="Agenda del Propietario" />

    <div class="min-h-screen bg-surface px-4 py-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-8 shadow-sm">
                <h1 class="text-3xl font-bold">Agenda</h1>
                <p class="mt-3 text-base text-slate-600">
                    Revisa y gestiona tus citas y eventos deportivos.
                </p>
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm col-span-2">
                    <h2 class="text-xl font-semibold">Reservas próximas</h2>
                    <p class="mt-2 text-sm text-slate-600">Verifica el calendario de tus reservas y asignaciones.</p>

                    <div class="mt-6">
                        <ul class="space-y-3">
                            <li v-for="res in props.reservas" :key="res.id" class="rounded-lg border p-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-semibold">{{ res.cancha?.centro_deportivo?.nombre ?? '—' }} — {{ res.cancha?.nombre ?? 'Cancha' }}</div>
                                        <div class="text-sm text-slate-600">{{ res.fecha }} — {{ res.user?.name ?? 'Cliente' }}</div>
                                    </div>
                                    <div class="text-sm font-medium capitalize">{{ res.estado }}</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
