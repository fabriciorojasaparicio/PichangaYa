<script setup lang="ts">
import { Head, Inertia } from '@inertiajs/vue3';
const props = defineProps<{
    cliente: any;
    reservas: any[];
}>();

function block() {
    if (!confirm('Bloquear cliente?')) return;
    Inertia.post(route('propietario.clientes.block', props.cliente.id));
}

function unblock() {
    if (!confirm('Desbloquear cliente?')) return;
    Inertia.post(route('propietario.clientes.unblock', props.cliente.id));
}
</script>

<template>
    <Head :title="`Cliente - ${props.cliente.name}`" />

    <div class="min-h-screen bg-surface px-4 py-8">
        <div class="mx-auto max-w-4xl space-y-6">
            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-8 shadow-sm">
                <h1 class="text-2xl font-bold">{{ props.cliente.name }}</h1>
                <p class="text-sm text-slate-600">{{ props.cliente.email }}</p>
                <div class="mt-4">
                    <button v-if="props.cliente.status !== 'inactive'" @click.prevent="block" class="bg-red-600 text-white px-3 py-2 rounded">Bloquear</button>
                    <button v-else @click.prevent="unblock" class="bg-green-600 text-white px-3 py-2 rounded">Desbloquear</button>
                </div>
            </div>

            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold">Reservas</h2>
                <div class="mt-4">
                    <ul class="space-y-2">
                        <li v-for="r in props.reservas" :key="r.id" class="border p-3 rounded">
                            <div class="font-medium">{{ r.fecha }} - {{ r.cancha?.centro_deportivo?.nombre ?? '' }} / {{ r.cancha?.nombre }}</div>
                            <div class="text-sm text-slate-600">Estado: {{ r.estado }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
