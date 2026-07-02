<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
const props = defineProps<{
    metrics: {
        centros: number;
        canchas: number;
        reservas: number;
        ingresos: number;
    };
    recentReservas: Array<{
        id: number;
        fecha: string;
        estado: string;
        cancha?: {
            nombre?: string;
            centro_deportivo?: {
                nombre?: string;
            };
        };
        user?: {
            name?: string;
        };
    }>;
}>();
</script>

<template>
    <Head title="Propietario Dashboard" />

    <div class="min-h-screen bg-surface px-4 py-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-8 shadow-sm">
                <h1 class="text-3xl font-bold">Dashboard del Propietario</h1>
                <p class="mt-3 text-base text-slate-600">
                    Bienvenido a tu panel de control. Aquí podrás acceder a la agenda, administrar tus centros y revisar reportes.
                </p>
            </div>

            <div class="grid gap-4 lg:grid-cols-3">
                <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold">Agenda</h2>
                    <p class="mt-2 text-sm text-slate-600">Controla tus próximos eventos y las reservas activas.</p>
                    <p class="mt-4 text-4xl font-bold text-slate-900">{{ props.metrics.reservas }}</p>
                </div>
                <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold">Centros</h2>
                    <p class="mt-2 text-sm text-slate-600">Administra tus centros deportivos y sus canchas.</p>
                    <p class="mt-4 text-4xl font-bold text-slate-900">{{ props.metrics.centros }}</p>
                </div>
                <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold">Reportes</h2>
                    <p class="mt-2 text-sm text-slate-600">Revisa el rendimiento y los ingresos de tus instalaciones.</p>
                    <p class="mt-4 text-4xl font-bold text-slate-900">S/ {{ props.metrics.ingresos.toFixed(2) }}</p>
                </div>
            </div>

            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-8 shadow-sm">
                <h2 class="text-2xl font-semibold">Reservas recientes</h2>
                <div v-if="props.recentReservas.length" class="mt-6 overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-700">
                        <thead class="border-b border-slate-200 text-slate-900">
                            <tr>
                                <th class="py-3 pr-4">Fecha</th>
                                <th class="py-3 pr-4">Centro</th>
                                <th class="py-3 pr-4">Cancha</th>
                                <th class="py-3 pr-4">Usuario</th>
                                <th class="py-3 pr-4">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="reserva in props.recentReservas" :key="reserva.id" class="border-b border-slate-100 hover:bg-slate-50">
                                <td class="py-3 pr-4">{{ reserva.fecha }}</td>
                                <td class="py-3 pr-4">{{ reserva.cancha?.centro_deportivo?.nombre ?? '—' }}</td>
                                <td class="py-3 pr-4">{{ reserva.cancha?.nombre ?? '—' }}</td>
                                <td class="py-3 pr-4">{{ reserva.user?.name ?? 'Cliente' }}</td>
                                <td class="py-3 pr-4 capitalize">{{ reserva.estado }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else class="mt-6 text-sm text-slate-600">No hay reservas recientes registradas.</div>
            </div>
        </div>
    </div>
</template>
