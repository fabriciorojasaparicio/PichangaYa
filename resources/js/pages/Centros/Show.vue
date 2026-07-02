<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps<{
    centroId: string | number;
}>();

const centro = ref<any>(null);
const loading = ref(true);
const error = ref<string | null>(null);
const canchaSeleccionada = ref<any>(null);
const deporteSeleccionado = ref<any>(null);
const currentImage = ref(0);

const imagenes = computed(() => {
    if (!centro.value) return [];
    // Use placeholder images; in production, replace with actual image URLs from DB
    return [
        `https://lh3.googleusercontent.com/aida-public/AB6AXuCBSGWSDEt4fiKALcbvNTV2bb4YszaSGSIee7k8jfAn7vxL8Me5bY4ZsMMQxeAqwXomwrz4beHVEGfkNMkMhsrY5hvgmoftQKVqC8kYx8V5GbID1pxYe8NpEiC6OnBXaLFvww2kAyhduJgYtsDmekNWxK_yfiS3M8oWoPijsLCjHHY9Q7YFsqcpnpOjsRnPnUTE5AtYGV2--gdTkGuBz9XCD5IoxnnzsVd9ZcIin34Mhk1ltqQPsJDRRVGs7gMVJNA1AT-q-ib9qilx`,
        `https://lh3.googleusercontent.com/aida-public/AB6AXuBh6mr8Np61dZ88kxCqvDOafVoluXRVTiUIEV370trXnkYSiz-TU0r6O0zUzcKk_m-f8x4504jETX0Z0pr7EAQtWxnebre7E3tCxwBmhRD0UKmnEii86GGRmlTVGxbA3vvi5tSncdJuzv84r25X-DxH8BvXg4dVE0Y80baLpJntWoMTezMzA9cNUPUAMqSNdekwolql9ZbXk6Zw6bTmtqXRIEuKi_08bocjyIQYVwbz1dvYvfVC7WJ4DQbsPCQwJx4oNPdCaPRrCkM3`,
    ];
});

const deportesDelCentro = computed(() => {
    if (!centro.value?.canchas) return [];
    const deportesMap = new Map();
    centro.value.canchas.forEach((cancha: any) => {
        (cancha.deportes || []).forEach((deporte: any) => {
            if (!deportesMap.has(deporte.id)) {
                deportesMap.set(deporte.id, deporte);
            }
        });
    });
    return Array.from(deportesMap.values());
});

const canchasFiltradas = computed(() => {
    if (!centro.value?.canchas) return [];
    if (!deporteSeleccionado.value) return centro.value.canchas;
    return centro.value.canchas.filter((c: any) =>
        c.deportes?.some((d: any) => d.id === deporteSeleccionado.value.id)
    );
});

const precioCancha = computed(() => {
    if (!canchaSeleccionada.value) return null;
    if (deporteSeleccionado.value) {
        const pivot = canchaSeleccionada.value.deportes?.find(
            (d: any) => d.id === deporteSeleccionado.value.id
        )?.pivot;
        if (pivot?.precio_hora) return pivot.precio_hora;
    }
    return canchaSeleccionada.value.precio_por_bloque
        ? (canchaSeleccionada.value.precio_por_bloque * 2).toFixed(2)
        : null;
});

const ubicacion = computed(() => {
    if (!centro.value) return '';
    const partes = [];
    if (centro.value.direccion) partes.push(centro.value.direccion);
    if (centro.value.distrito?.nombre) partes.push(centro.value.distrito.nombre);
    if (centro.value.ciudad?.nombre) partes.push(centro.value.ciudad.nombre);
    return partes.join(', ');
});

function seleccionarCancha(cancha: any) {
    canchaSeleccionada.value = cancha;
}

function seleccionarDeporte(deporte: any) {
    deporteSeleccionado.value = deporte;
    canchaSeleccionada.value = null;
}

function getIconoCaracteristica(nombre: string): string {
    const iconos: Record<string, string> = {
        'WiFi': 'wifi',
        'Estacionamiento': 'local_parking',
        'Vestuarios': 'wc',
        'Duchas': 'shower',
        'Buffet / Bar': 'restaurant',
        'Alquiler de pelotas': 'sports_soccer',
        'Cancha Techada': 'roofing',
        'Césped Sintético': 'grass',
        'Piso de Goma': 'layers',
        'Iluminación LED': 'lightbulb',
        'Tribunas': 'stadium',
    };
    return iconos[nombre] || 'check_circle';
}

onMounted(async () => {
    try {
        const { data } = await axios.get(`/api/centros/${props.centroId}`);
        centro.value = data;
        if (data.canchas?.length > 0) {
            canchaSeleccionada.value = data.canchas[0];
        }
        if (deportesDelCentro.value.length > 0) {
            deporteSeleccionado.value = deportesDelCentro.value[0];
        }
    } catch (e) {
        error.value = 'No se pudo cargar el centro deportivo.';
    } finally {
        loading.value = false;
    }
});
</script>

<template>
    <div class="min-h-screen bg-[#f6f8f6] font-[Lexend,sans-serif]">
        <!-- Loading state -->
        <div v-if="loading" class="flex items-center justify-center min-h-screen">
            <div class="flex flex-col items-center gap-4">
                <div class="w-12 h-12 border-4 border-[#13ec5b] border-t-transparent rounded-full animate-spin"></div>
                <p class="text-slate-500 font-medium">Cargando complejo...</p>
            </div>
        </div>

        <!-- Error state -->
        <div v-else-if="error" class="flex items-center justify-center min-h-screen">
            <div class="text-center">
                <span class="material-symbols-outlined text-6xl text-slate-300">sports_soccer</span>
                <p class="mt-4 text-slate-500">{{ error }}</p>
            </div>
        </div>

        <!-- Main content -->
        <div v-else-if="centro">
            <!-- TopNavBar -->
            <nav class="fixed top-0 w-full z-50 bg-white/90 backdrop-blur-md shadow-sm flex justify-between items-center px-6 h-16">
                <div class="flex items-center gap-3">
                    <button @click="$inertia.visit('/')" class="text-slate-500 hover:text-[#13ec5b] transition-colors">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </button>
                    <span class="text-lg font-black tracking-tighter text-slate-900 truncate max-w-[200px] sm:max-w-xs">
                        {{ centro.nombre }}
                    </span>
                </div>
                <div class="flex gap-3">
                    <button class="text-slate-400 hover:text-[#13ec5b] transition-colors active:scale-95">
                        <span class="material-symbols-outlined">share</span>
                    </button>
                    <button class="text-slate-400 hover:text-red-500 transition-colors active:scale-95">
                        <span class="material-symbols-outlined">favorite</span>
                    </button>
                </div>
            </nav>

            <main class="pt-16 pb-28 max-w-7xl mx-auto">
                <!-- Image Carousel -->
                <section class="relative w-full px-4 mt-4 mb-8">
                    <div class="flex overflow-x-auto snap-x snap-mandatory no-scrollbar gap-4 rounded-2xl" style="-ms-overflow-style:none;scrollbar-width:none;">
                        <div
                            v-for="(img, idx) in imagenes"
                            :key="idx"
                            class="snap-center shrink-0 w-full md:w-3/4 aspect-[16/9] md:aspect-[21/9] rounded-2xl overflow-hidden relative"
                        >
                            <img :src="img" :alt="centro.nombre" class="w-full h-full object-cover" />
                            <div v-if="idx === 0" class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-8">
                                <div>
                                    <span class="bg-[#13ec5b] text-[#102216] px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest mb-2 inline-block">
                                        {{ centro.ciudad?.nombre || 'Centro' }}
                                    </span>
                                    <h2 class="text-white text-3xl font-extrabold tracking-tight">{{ centro.nombre }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Dot indicators -->
                    <div class="flex justify-center gap-2 mt-4">
                        <div
                            v-for="(_, idx) in imagenes"
                            :key="idx"
                            :class="idx === 0 ? 'h-1.5 w-6 bg-[#13ec5b]' : 'h-1.5 w-2 bg-slate-300'"
                            class="rounded-full transition-all"
                        ></div>
                    </div>
                </section>

                <!-- Main Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 px-4">
                    <!-- Sidebar -->
                    <aside class="lg:col-span-3 space-y-6">
                        <!-- Servicios e Instalaciones -->
                        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                            <h3 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-6">Servicios e Instalaciones</h3>
                            <ul v-if="centro.caracteristicas?.length" class="space-y-4">
                                <li
                                    v-for="car in centro.caracteristicas"
                                    :key="car.id"
                                    class="flex items-center gap-4 text-slate-500"
                                >
                                    <div class="w-10 h-10 rounded-xl bg-[#f6f8f6] flex items-center justify-center text-[#13ec5b]">
                                        <span class="material-symbols-outlined text-[20px]">{{ car.icono || getIconoCaracteristica(car.nombre) }}</span>
                                    </div>
                                    <span class="text-sm font-medium text-slate-700">{{ car.nombre }}</span>
                                </li>
                            </ul>
                            <p v-else class="text-sm text-slate-400">Sin servicios registrados.</p>
                        </div>

                        <!-- Ubicación -->
                        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                            <h3 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4">Ubicación</h3>
                            <div class="rounded-2xl h-40 overflow-hidden bg-slate-100 mb-4">
                                <img
                                    class="w-full h-full object-cover grayscale opacity-80"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuD8lgEufmnyaoloK1CCqamQAfqjJe3MBEv3jSaSANc65m5u2R4KvEzXlkk8rkYS6tS0yG7OCkhhBN0fC-nTxjezJNCnVezsEiA1c5qUmG31r8reMzMBqVQXTcPikmHl24_7GZDpTjbYvWen5EuGwMA4N_SNz3p_XB0BXWZ12ZhXULkczK73b27FH4GTgrFYdxVTntjCEHr0icGy-a4CUs7fmhZy2IauM_aaBuk0J4BC7UcXSpxCNs1t_tH8PsIO84vpipRTHRx_ezOW"
                                    alt="Mapa"
                                />
                            </div>
                            <p class="text-sm text-slate-500">{{ ubicacion }}</p>
                        </div>
                    </aside>

                    <!-- Booking Area -->
                    <section class="lg:col-span-9 space-y-6">
                        <!-- Deporte & Cancha Selector -->
                        <div class="bg-white p-6 lg:p-8 rounded-3xl shadow-sm border border-slate-100">
                            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                                <h3 class="text-2xl font-bold tracking-tight">Seleccionar Cancha</h3>
                                <!-- Deporte Filter Tabs -->
                                <div v-if="deportesDelCentro.length" class="flex gap-2 p-1 bg-[#f6f8f6] rounded-2xl overflow-x-auto no-scrollbar" style="-ms-overflow-style:none;scrollbar-width:none;">
                                    <button
                                        v-for="deporte in deportesDelCentro"
                                        :key="deporte.id"
                                        @click="seleccionarDeporte(deporte)"
                                        :class="deporteSeleccionado?.id === deporte.id
                                            ? 'bg-[#13ec5b] text-[#102216] shadow-lg shadow-[#13ec5b]/20'
                                            : 'text-slate-500 hover:bg-slate-100'"
                                        class="flex items-center gap-2 px-4 py-2 rounded-xl font-bold transition-all text-sm whitespace-nowrap"
                                    >
                                        <span class="material-symbols-outlined text-lg">{{ deporte.icono || 'sports' }}</span>
                                        <span>{{ deporte.nombre }}</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Canchas Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div
                                    v-for="cancha in canchasFiltradas"
                                    :key="cancha.id"
                                    @click="seleccionarCancha(cancha)"
                                    :class="canchaSeleccionada?.id === cancha.id
                                        ? 'border-2 border-[#13ec5b] bg-[#13ec5b]/5'
                                        : 'border-2 border-transparent bg-[#f6f8f6] hover:bg-slate-100'"
                                    class="p-5 rounded-2xl flex items-center justify-between cursor-pointer transition-all"
                                >
                                    <div class="flex items-center gap-4">
                                        <div :class="canchaSeleccionada?.id === cancha.id ? 'bg-[#13ec5b] text-[#102216]' : 'bg-slate-200 text-slate-500'"
                                            class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg transition-all">
                                            C{{ cancha.id }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">{{ cancha.nombre }}</p>
                                            <p class="text-xs text-slate-400">{{ cancha.tipo_cancha?.nombre || 'Cancha estándar' }}</p>
                                        </div>
                                    </div>
                                    <span
                                        v-if="canchaSeleccionada?.id === cancha.id"
                                        class="material-symbols-outlined text-[#13ec5b]"
                                        style="font-variation-settings: 'FILL' 1"
                                    >check_circle</span>
                                </div>

                                <div v-if="!canchasFiltradas.length" class="col-span-2 text-center py-8 text-slate-400">
                                    <span class="material-symbols-outlined text-4xl">sports_soccer</span>
                                    <p class="mt-2">No hay canchas disponibles para este deporte.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Horario Placeholder (future implementation) -->
                        <div class="bg-white p-6 lg:p-8 rounded-3xl shadow-sm border border-slate-100">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h3 class="text-xl font-bold tracking-tight">Horarios Disponibles</h3>
                                    <p v-if="precioCancha" class="text-sm text-[#13ec5b] font-bold mt-1">
                                        Desde S/ {{ precioCancha }} / hora
                                    </p>
                                </div>
                                <span class="material-symbols-outlined text-slate-300">calendar_month</span>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                <button v-for="hora in ['08:00', '09:00', '10:00', '11:00', '14:00', '15:00', '16:00', '17:00']" :key="hora"
                                    class="p-4 rounded-2xl bg-[#f6f8f6] hover:bg-[#13ec5b]/10 hover:border-b-2 hover:border-[#13ec5b] border-b-2 border-transparent transition-all">
                                    <p class="text-sm font-bold text-slate-700">{{ hora }}</p>
                                </button>
                            </div>
                        </div>

                        <!-- Footer Booking CTA -->
                        <div class="bg-[#102216] text-white p-6 lg:p-8 rounded-3xl flex flex-col md:flex-row items-center justify-between gap-6">
                            <div>
                                <p class="text-slate-400 text-sm font-medium uppercase tracking-widest">Resumen de reserva</p>
                                <h4 class="text-xl font-bold mt-1">
                                    {{ canchaSeleccionada?.nombre || 'Selecciona una cancha' }}
                                    <span v-if="precioCancha"> • S/ {{ precioCancha }}/h</span>
                                </h4>
                            </div>
                            <button
                                :disabled="!canchaSeleccionada"
                                class="w-full md:w-auto h-14 px-10 bg-[#13ec5b] text-[#102216] rounded-2xl font-black text-base uppercase tracking-tight shadow-xl shadow-[#13ec5b]/30 active:scale-95 transition-transform disabled:opacity-40 disabled:cursor-not-allowed"
                            >
                                Confirmar Reserva
                            </button>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>
</template>
