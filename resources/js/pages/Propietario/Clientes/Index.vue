<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps<{
    clientes: Array<any>;
}>();
</script>

<template>
    <Head title="Clientes" />

    <div class="min-h-screen bg-surface px-4 py-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-8 shadow-sm">
                <h1 class="text-3xl font-bold">Clientes</h1>
                <p class="mt-3 text-base text-slate-600">Lista de clientes que han reservado en tus centros.</p>
            </div>

            <div class="rounded-3xl border border-sidebar-border/70 bg-white p-6 shadow-sm">
                <table class="w-full text-left text-sm text-slate-700">
                    <thead class="border-b border-slate-200 text-slate-900">
                        <tr>
                            <th class="py-3 pr-4">Nombre</th>
                            <th class="py-3 pr-4">Email</th>
                            <th class="py-3 pr-4">Reservas</th>
                            <th class="py-3 pr-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="c in props.clientes" :key="c.id" class="border-b border-slate-100 hover:bg-slate-50">
                            <td class="py-3 pr-4">{{ c.name }}</td>
                            <td class="py-3 pr-4">{{ c.email }}</td>
                            <td class="py-3 pr-4">{{ c.reservas?.length ?? 0 }}</td>
                            <td class="py-3 pr-4">
                                <Link :href="`/propietario/clientes/${c.id}`" class="text-primary mr-3">Ver</Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
