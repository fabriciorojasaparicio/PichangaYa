<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
const props = defineProps<{
    totalReservas: number;
    totalIngresos: number;
    estadoResumen: Array<{ estado: string; total: number }>;
    ingresosPorCentro: Array<{ centro: string; ingresos: number }>;
}>();
</script>

<template>
    <Head title="Reportes" />

    <div class="min-h-screen bg-surface px-4 py-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-8 shadow-sm">
                <h1 class="text-3xl font-bold">Reportes y Finanzas</h1>
                <p class="mt-3 text-base text-slate-600">
                    Visualiza los ingresos, reservas y métricas de tus centros deportivos.
                </p>
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold">Métricas clave</h2>
                    <p class="mt-2 text-sm text-slate-600">Analiza el desempeño de tus canchas y promociones.</p>

                    <div class="mt-4 grid grid-cols-3 gap-4">
                        <div class="rounded-lg bg-surface p-4">
                            <div class="text-sm text-slate-600">Reservas</div>
                            <div class="text-2xl font-bold">{{ props.totalReservas }}</div>
                        </div>
                        <div class="rounded-lg bg-surface p-4">
                            <div class="text-sm text-slate-600">Ingresos</div>
                            <div class="text-2xl font-bold">S/ {{ Number(props.totalIngresos).toFixed(2) }}</div>
                        </div>
                        <div class="rounded-lg bg-surface p-4">
                            <div class="text-sm text-slate-600">Estados</div>
                            <div class="text-2xl font-bold">{{ props.estadoResumen.length }}</div>
                        </div>
                    </div>
                </div>
                <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold">Ingresos por Centro</h2>
                    <p class="mt-2 text-sm text-slate-600">Consulta ingresos por periodo y centros.</p>

                    <div class="mt-6 overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-700">
                            <thead class="border-b border-slate-200 text-slate-900">
                                <tr>
                                    <th class="py-3 pr-4">Centro</th>
                                    <th class="py-3 pr-4">Ingresos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="row in props.ingresosPorCentro" :key="row.centro" class="border-b border-slate-100 hover:bg-slate-50">
                                    <td class="py-3 pr-4">{{ row.centro }}</td>
                                    <td class="py-3 pr-4">S/ {{ Number(row.ingresos).toFixed(2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
