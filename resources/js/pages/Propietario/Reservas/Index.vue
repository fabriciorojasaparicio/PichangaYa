<script setup lang="ts">
import { Head, Inertia } from '@inertiajs/vue3';
const props = defineProps<{
    reservas: Array<{
        id: number;
        fecha: string;
        total: number;
        estado: string;
        cancha?: { nombre?: string; centro_deportivo?: { nombre?: string; id?: number } };
        user?: { name?: string };
    }>;
    centros?: Array<{ id: number; nombre: string }>;
    filters?: { fecha_desde?: string; fecha_hasta?: string; centro_id?: number | null; estado?: string | null };
}>();

function confirmReserva(id: number) {
    if (!confirm('Confirmar reserva?')) return;
    Inertia.post(route('propietario.reservas.confirm', id));
}

function cancelReserva(id: number) {
    if (!confirm('Cancelar reserva?')) return;
    Inertia.post(route('propietario.reservas.cancel', id));
}

function applyFilters(e: Event) {
    e.preventDefault();
    const form = e.target as HTMLFormElement;
    const params = new URLSearchParams(new FormData(form) as any).toString();
    window.location.search = params;
}
</script>

<template>
    <Head title="Reservas" />

    <div class="min-h-screen bg-surface px-4 py-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-8 shadow-sm">
                <h1 class="text-3xl font-bold">Reservas</h1>
                <p class="mt-3 text-base text-slate-600">
                    Gestiona las reservas de tus canchas y ve los próximos eventos.
                </p>
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm col-span-2">
                    <h2 class="text-xl font-semibold">Reservas</h2>
                    <p class="mt-2 text-sm text-slate-600">Filtra por fecha, centro o estado y gestiona reservas.</p>

                    <form @submit.prevent="applyFilters" class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-3">
                        <input name="fecha_desde" type="date" :value="props.filters?.fecha_desde ?? ''" class="rounded-lg border p-2" />
                        <input name="fecha_hasta" type="date" :value="props.filters?.fecha_hasta ?? ''" class="rounded-lg border p-2" />
                        <select name="centro_id" class="rounded-lg border p-2">
                            <option value="">Todos los centros</option>
                            <option v-for="c in props.centros ?? []" :value="c.id" :key="c.id" :selected="String(c.id) === String(props.filters?.centro_id)">{{ c.nombre }}</option>
                        </select>
                        <select name="estado" class="rounded-lg border p-2">
                            <option value="">Todos los estados</option>
                            <option value="pendiente" :selected="props.filters?.estado === 'pendiente'">Pendiente</option>
                            <option value="confirmada" :selected="props.filters?.estado === 'confirmada'">Confirmada</option>
                            <option value="cancelada" :selected="props.filters?.estado === 'cancelada'">Cancelada</option>
                        </select>
                        <div class="md:col-span-4">
                            <button type="submit" class="mt-2 bg-primary text-white px-4 py-2 rounded-lg">Aplicar filtros</button>
                        </div>
                    </form>

                    <div class="mt-6 overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-700">
                            <thead class="border-b border-slate-200 text-slate-900">
                                <tr>
                                    <th class="py-3 pr-4">Fecha</th>
                                    <th class="py-3 pr-4">Centro</th>
                                    <th class="py-3 pr-4">Cancha</th>
                                    <th class="py-3 pr-4">Usuario</th>
                                    <th class="py-3 pr-4">Total</th>
                                    <th class="py-3 pr-4">Estado</th>
                                    <th class="py-3 pr-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="reserva in props.reservas" :key="reserva.id" class="border-b border-slate-100 hover:bg-slate-50">
                                    <td class="py-3 pr-4">{{ reserva.fecha }}</td>
                                    <td class="py-3 pr-4">{{ reserva.cancha?.centro_deportivo?.nombre ?? '—' }}</td>
                                    <td class="py-3 pr-4">{{ reserva.cancha?.nombre ?? '—' }}</td>
                                    <td class="py-3 pr-4">{{ reserva.user?.name ?? 'Cliente' }}</td>
                                    <td class="py-3 pr-4">S/ {{ Number(reserva.total).toFixed(2) }}</td>
                                    <td class="py-3 pr-4 capitalize">{{ reserva.estado }}</td>
                                    <td class="py-3 pr-4">
                                        <template v-if="reserva.estado === 'pendiente'">
                                            <button @click.prevent="confirmReserva(reserva.id)" class="text-sm text-green-600 mr-3">Confirmar</button>
                                            <button @click.prevent="cancelReserva(reserva.id)" class="text-sm text-red-600">Cancelar</button>
                                        </template>
                                        <template v-else>
                                            <span class="text-sm text-slate-600">Sin acciones</span>
                                        </template>
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
