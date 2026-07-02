<script setup lang="ts">
import MaterialIcon from '@/components/MaterialIcon.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { login, register } from '@/routes';
import * as propietarioRoutes from '@/routes/propietario';
import * as adminRoutes from '@/routes/admin';
import { dashboard } from '@/routes';
import HeroSection from '@/components/Sections/HeroSection.vue';
import TrustBarSection from '@/components/Sections/TrustBarSection.vue';
import ProblemSolutionSection from '@/components/Sections/ProblemSolutionSection.vue';
import BenefitsSection from '@/components/Sections/BenefitsSection.vue';
import HowItWorksImprovedSection from '@/components/Sections/HowItWorksImprovedSection.vue';
import FeaturesSection from '@/components/Sections/FeaturesSection.vue';
import FeaturedCentersSection from '@/components/Sections/FeaturedCentersSection.vue';
import TestimonialsSection from '@/components/Sections/TestimonialsSection.vue';
import FAQSection from '@/components/Sections/FAQSection.vue';
import CTAFinalSection from '@/components/Sections/CTAFinalSection.vue';
import CentroDetailsModal from '@/components/CentroDetailsModal.vue';

const props = defineProps<{
    centros: any[];
    deportes: any[];
    servicios: any[];
    infraestructuras: any[];
}>();

const page = usePage();
const user = computed(() => page.props.auth?.user);
const userRole = computed(() => page.props.auth?.user?.role?.nombre ?? undefined);

const dashboardUrl = computed(() => {
    if (userRole.value === 'propietario') {
        return propietarioRoutes.dashboard().url;
    }

    if (userRole.value === 'admin') {
        return adminRoutes.dashboard().url;
    }

    return dashboard().url;
});

const getMinPrice = (centro: any) => {
    if (!centro.canchas || centro.canchas.length === 0) return 0;
    
    let minPrice = Infinity;
    centro.canchas.forEach((cancha: any) => {
        if (cancha.deportes && cancha.deportes.length > 0) {
            cancha.deportes.forEach((deporte: any) => {
                let price = parseFloat(deporte.pivot?.precio_hora || 0);
                if (price === 0) {
                    price = parseFloat(cancha.precio_por_bloque || 0) * 2;
                }
                if (price > 0 && price < minPrice) {
                    minPrice = price;
                }
            });
        } else {
            const price = parseFloat(cancha.precio_por_bloque || 0) * 2;
            if (price > 0 && price < minPrice) {
                minPrice = price;
            }
        }
    });
    
    return minPrice === Infinity ? 0 : minPrice;
};

// Filter state
const selectedDeporte = ref<number | null>(null);
const showMobileFilters = ref(false);

// Modal state
const showCentroModal = ref(false);
const selectedCentroId = ref<string | number | null>(null);

function openCentroModal(id: string | number) {
    selectedCentroId.value = id;
    showCentroModal.value = true;
}
</script>

<template>
    <Head title="SportReserve - Inicio" />
    
    <div class="bg-surface font-inter text-on-surface min-h-screen flex flex-col">
        <!-- TopNavBar -->
        <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-outline-variant shadow-sm transition-all duration-300">
            <div class="max-w-[1400px] mx-auto px-4 md:px-6 h-20 flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-on-primary shadow-lg shadow-primary/30 transform rotate-3 hover:rotate-0 transition-transform">
                        <MaterialIcon name="sports_soccer" class="font-bold text-xl" data-icon="sports_soccer" />
                    </div>
                    <a href="/">
                        <span class="text-2xl font-black text-zinc-900 tracking-tighter">PichangasYa</span>
                    </a>
                </div>
                <!-- Nav Links (Desktop) -->
                <nav class="hidden md:flex items-center gap-8 font-medium">
                    <a href="#" class="text-primary font-bold relative after:absolute after:bottom-[-4px] after:left-0 after:w-full after:h-1 after:bg-primary after:rounded-full">Explorar</a>
                    <a href="#" class="text-on-surface-variant hover:text-primary transition-colors">Centros Deportivos</a>
                    <a href="#" class="text-on-surface-variant hover:text-primary transition-colors">Nosotros</a>
                    <a href="#" class="text-on-surface-variant hover:text-primary transition-colors">Contacto</a>
                </nav>
                <!-- Auth Actions -->
                <div class="flex items-center gap-3">
                    <template v-if="user">
                        <Link :href="dashboardUrl" class="bg-primary text-on-primary px-5 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:brightness-105 active:scale-95 transition-all">
                            Mi Panel
                        </Link>
                    </template>
                    <template v-else>
                        <Link :href="login()" class="hidden md:block bg-surface-container hover:bg-surface-container-high px-4 py-2 rounded-xl text-sm font-semibold transition-colors text-on-surface">
                            Ingresar
                        </Link>
                        <Link :href="register()" class="bg-primary text-on-primary px-5 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:brightness-105 active:scale-95 transition-all flex items-center gap-2">
                            <span>Unirse</span>
                            <MaterialIcon name="arrow_forward" class="text-sm hidden sm:block" data-icon="arrow_forward" />
                        </Link>
                    </template>
                </div>
            </div>
        </header>

        <main class="flex-grow pb-24 md:pb-10">
            <!-- Hero Section (NUEVA - FASE 1) -->
            <HeroSection :searchRoute="'/centros'" />
            <!-- Main Content -->
            <div class="max-w-[1400px] mx-auto px-4 grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Filters Sidebar -->
                <aside :class="['lg:col-span-1 space-y-6', showMobileFilters ? 'block' : 'hidden lg:block']">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-outline-variant sticky top-28">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-black text-zinc-900 flex items-center gap-2">
                                <MaterialIcon name="tune" class="text-primary" data-icon="tune" /> Filtros
                            </h2>
                            <button class="text-sm font-semibold text-primary hover:text-secondary transition-colors underline-offset-4 hover:underline">Limpiar</button>
                        </div>

                        <!-- Deporte -->
                        <div class="mb-8">
                            <h3 class="text-sm font-bold text-zinc-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <MaterialIcon name="sports_soccer" class="text-on-surface-variant text-sm" data-icon="sports_soccer" /> Deporte
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                <button 
                                    v-for="deporte in deportes" 
                                    :key="deporte.id"
                                    @click="selectedDeporte = deporte.id === selectedDeporte ? null : deporte.id"
                                    :class="[
                                        'px-4 py-2 rounded-xl text-sm font-bold border transition-all flex items-center gap-1.5',
                                        selectedDeporte === deporte.id 
                                            ? 'border-primary bg-primary/10 text-primary shadow-sm' 
                                            : 'border-outline hover:border-primary hover:text-primary bg-surface text-on-surface'
                                    ]"
                                >
                                    <MaterialIcon :name="deporte.icono || 'sports'" class="text-base" :data-icon="deporte.icono || 'sports'" />
                                    {{ deporte.nombre }}
                                </button>
                            </div>
                        </div>

                        <hr class="border-outline-variant mb-6"/>

                        <!-- Servicios -->
                        <div class="mb-8" v-if="servicios && servicios.length > 0">
                            <h3 class="text-sm font-bold text-zinc-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <MaterialIcon name="room_service" class="text-on-surface-variant text-sm" data-icon="room_service" /> Servicios Extra
                            </h3>
                            <div class="space-y-3">
                                <label v-for="servicio in servicios" :key="servicio.id" class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative flex items-center justify-center w-5 h-5 rounded border-2 border-outline group-hover:border-primary transition-colors overflow-hidden">
                                        <input type="checkbox" class="absolute opacity-0 cursor-pointer w-full h-full peer"/>
                                        <div class="w-full h-full bg-primary opacity-0 peer-checked:opacity-100 flex items-center justify-center transition-opacity">
                                            <MaterialIcon name="check" class="text-white text-[14px] font-bold" data-icon="check" />
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-zinc-700 group-hover:text-zinc-900 transition-colors flex items-center gap-2">
                                        <MaterialIcon :name="servicio.icono || 'local_offer'" class="text-on-surface-variant text-lg" :data-icon="servicio.icono || 'local_offer'" />
                                        {{ servicio.nombre }}
                                    </span>
                                </label>
                            </div>
                        </div>

                        <hr class="border-outline-variant mb-6" v-if="servicios && servicios.length > 0"/>

                        <!-- Infraestructura -->
                        <div class="mb-8" v-if="infraestructuras && infraestructuras.length > 0">
                            <h3 class="text-sm font-bold text-zinc-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <MaterialIcon name="foundation" class="text-on-surface-variant text-sm" data-icon="foundation" /> Infraestructura
                            </h3>
                            <div class="space-y-3">
                                <label v-for="infraestructura in infraestructuras" :key="infraestructura.id" class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative flex items-center justify-center w-5 h-5 rounded border-2 border-outline group-hover:border-primary transition-colors overflow-hidden">
                                        <input type="checkbox" class="absolute opacity-0 cursor-pointer w-full h-full peer"/>
                                        <div class="w-full h-full bg-primary opacity-0 peer-checked:opacity-100 flex items-center justify-center transition-opacity">
                                            <MaterialIcon name="check" class="text-white text-[14px] font-bold" data-icon="check" />
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-zinc-700 group-hover:text-zinc-900 transition-colors flex items-center gap-2">
                                        <MaterialIcon :name="infraestructura.icono || 'domain'" class="text-on-surface-variant text-lg" :data-icon="infraestructura.icono || 'domain'" />
                                        {{ infraestructura.nombre }}
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Search Results -->
                <section class="lg:col-span-3">
                    <div class="flex justify-between items-end mb-6">
                        <div>
                            <h2 class="text-2xl font-black text-zinc-900">Resultados Cercanos</h2>
                            <p class="text-on-surface-variant font-medium mt-1">{{ centros.length }} complejos encontrados</p>
                        </div>
                        <div class="hidden md:flex items-center gap-2 bg-white px-3 py-1.5 rounded-xl border border-outline-variant shadow-sm">
                            <span class="text-sm font-medium text-on-surface-variant">Ordenar por:</span>
                            <select class="bg-transparent text-sm font-bold border-none outline-none focus:ring-0 cursor-pointer">
                                <option>Recomendados</option>
                                <option>Menor Precio</option>
                                <option>Mejor Valorados</option>
                            </select>
                        </div>
                    </div>

                    <!-- Grid of Centers -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" v-if="centros.length > 0">
                        <div v-for="centro in centros" :key="centro.id" class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-outline-variant group flex flex-col h-full">
                            <div class="relative h-64 overflow-hidden">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" :src="centro.imagen_url || 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=600&auto=format&fit=crop'" :alt="centro.nombre"/>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                                <div class="absolute bottom-4 left-4 flex gap-2">
                                    <!-- Optional badgets like "Reserva Inmediata" -->
                                </div>
                                <button class="absolute top-4 right-4 p-2 bg-white/20 backdrop-blur-md rounded-full text-white hover:bg-white hover:text-red-500 transition-all">
                                    <MaterialIcon name="favorite" class="" data-icon="favorite" />
                                </button>
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="text-xl font-black text-zinc-900 leading-tight">{{ centro.nombre }}</h3>
                                        <div class="flex items-center gap-1 text-on-surface-variant text-sm mt-1">
                                            <MaterialIcon name="location_on" class="text-lg" data-icon="location_on" />
                                            {{ centro.distrito?.nombre || 'Distrito' }}, {{ centro.ciudad?.nombre || 'Ciudad' }}
                                        </div>
                                    </div>
                                    <div class="flex items-center bg-surface-container-high px-2 py-1 rounded-xl">
                                        <MaterialIcon name="star" class="text-yellow-500 text-sm" data-icon="star" style="font-variation-settings: 'FILL' 1;" />
                                        <span class="ml-1 text-sm font-black">4.8</span> <!-- Static rating for now -->
                                    </div>
                                </div>
                                
                                <div class="flex flex-wrap gap-2 my-4">
                                    <!-- Show max 3 characteristics -->
                                    <div v-for="caract in (centro.caracteristicas?.slice(0, 3) || [])" :key="caract.id" class="flex items-center gap-1.5 px-3 py-1.5 bg-surface-container text-on-surface-variant rounded-lg text-xs font-semibold">
                                        <MaterialIcon :name="caract.icono || 'check'" class="text-lg" :data-icon="caract.icono || 'check'" /> {{ caract.nombre }}
                                    </div>
                                </div>
                                
                                <div class="mt-auto pt-4 border-t border-outline-variant flex items-center justify-between">
                                    <div>
                                        <span class="text-xs text-on-surface-variant font-medium">Desde</span>
                                        <p class="text-xl font-black text-secondary">${{ getMinPrice(centro) }}<span class="text-xs font-normal text-on-surface-variant">/hr</span></p>
                                    </div>
                                    <button @click="openCentroModal(centro.id)" class="bg-primary text-on-primary px-6 py-3 rounded-2xl font-black text-sm flex items-center gap-2 hover:brightness-105 active:scale-95 transition-all shadow-md">
                                        Reservar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="text-center py-20 bg-white rounded-3xl border border-outline-variant shadow-sm">
                        <MaterialIcon name="search_off" class="text-6xl text-on-surface-variant mb-4" data-icon="search_off" />
                        <h3 class="text-xl font-bold text-zinc-900 mb-2">No se encontraron complejos</h3>
                        <p class="text-on-surface-variant">Prueba ajustando tus filtros de búsqueda.</p>
                    </div>
                </section>
            </div>

            <!-- Trust Bar Section (NUEVA - FASE 2) -->
            <TrustBarSection />

            <!-- Problem Solution Section (NUEVA - FASE 3) -->
            <ProblemSolutionSection />

            <!-- Benefits Section (NUEVA - FASE 4) -->
            <BenefitsSection />

            <!-- How It Works Improved (NUEVA - FASE 5) -->
            <HowItWorksImprovedSection />

            <!-- Features Section (NUEVA - FASE 6) -->
            <FeaturesSection />

            <!-- Testimonials Section (NUEVA - FASE 8) -->
            <TestimonialsSection />

            <!-- FAQ Section (NUEVA - FASE 9) -->
            <FAQSection />

            <!-- Final CTA Section (NUEVA - FASE 10) -->
            <CTAFinalSection />

            <!-- Mobile Filters Toggle -->
            <div class="max-w-[1400px] mx-auto px-4 mb-4 lg:hidden">
                <button @click="showMobileFilters = !showMobileFilters" class="w-full flex items-center justify-between bg-white px-5 py-3 rounded-2xl border border-outline-variant shadow-sm text-sm font-bold text-zinc-900 active:scale-[0.98] transition-transform">
                    <span class="flex items-center gap-2"><MaterialIcon name="tune" class="text-primary" data-icon="tune" /> Filtros de Búsqueda</span>
                    <MaterialIcon name="expand_more" class="text-on-surface-variant transition-transform" :class="{ 'rotate-180': showMobileFilters }" data-icon="expand_more" />
                </button>
            </div>

        </main>

        <!-- Footer -->
        <footer class="bg-zinc-900 text-zinc-400 py-16 px-4">
            <div class="max-w-[1400px] mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1">
                    <span class="text-2xl font-black text-white tracking-tighter mb-6 block">SportReserve</span>
                    <p class="text-sm leading-relaxed mb-6">Simplificando la forma de jugar deporte. Encontrá, reservá y jugá.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-zinc-800 rounded-full flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all">
                            <MaterialIcon name="share" class="text-xl" data-icon="share" />
                        </a>
                        <a href="#" class="w-10 h-10 bg-zinc-800 rounded-full flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all">
                            <MaterialIcon name="alternate_email" class="text-xl" data-icon="alternate_email" />
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Explorar</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        <li v-for="deporte in deportes.slice(0, 4)" :key="deporte.id">
                            <a href="#" class="hover:text-primary transition-colors">{{ deporte.nombre }}</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Soporte</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        <li><a href="#" class="hover:text-primary transition-colors">Centro de ayuda</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Publicá tu complejo</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Términos y condiciones</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Política de privacidad</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Newsletter</h4>
                    <p class="text-sm mb-4">Recibí ofertas exclusivas de complejos cercanos.</p>
                    <div class="flex flex-col gap-2">
                        <input type="email" placeholder="Tu email" class="bg-zinc-800 border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary w-full text-white"/>
                        <button class="bg-primary text-on-primary py-3 rounded-xl font-bold text-sm hover:brightness-105 active:scale-95 transition-all">Suscribirme</button>
                    </div>
                </div>
            </div>
            <div class="max-w-[1400px] mx-auto mt-16 pt-8 border-t border-zinc-800 text-center text-xs">
                <p>© 2026 SportReserve. Todos los derechos reservados.</p>
            </div>
        </footer>

        <!-- BottomNavBar (Mobile Only) -->
        <nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-2 py-3 bg-white/80 dark:bg-zinc-950/80 backdrop-blur-md border-t border-zinc-200 dark:border-zinc-800 shadow-[0_-2px_10px_rgba(0,0,0,0.05)] text-[10px] font-medium">
            <div class="flex flex-col items-center justify-center text-primary bg-primary/10 rounded-xl px-3 py-1 active:scale-90 transition-transform">
                <MaterialIcon name="search" class="" data-icon="search" style="font-variation-settings: 'FILL' 1;" />
                <span>Explorar</span>
            </div>
            <div class="flex flex-col items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-primary active:scale-90 transition-transform">
                <MaterialIcon name="event_available" class="" data-icon="event_available" />
                <span>Mis Reservas</span>
            </div>
            <div class="flex flex-col items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-primary active:scale-90 transition-transform">
                <MaterialIcon name="favorite" class="" data-icon="favorite" />
                <span>Favoritos</span>
            </div>
            <div class="flex flex-col items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-primary active:scale-90 transition-transform">
                <MaterialIcon name="person" class="" data-icon="person" />
                <span>Perfil</span>
            </div>
        </nav>

        <!-- FAB -->
        <button class="fixed bottom-24 right-6 md:bottom-10 md:right-10 w-16 h-16 bg-primary text-on-primary rounded-full shadow-2xl flex items-center justify-center active:scale-95 transition-transform z-40 group">
            <MaterialIcon name="add" class="text-3xl group-hover:rotate-12 transition-transform" data-icon="add" />
        </button>

        <!-- Centro Details Modal -->
        <CentroDetailsModal
            :show="showCentroModal"
            :centro-id="selectedCentroId"
            @close="showCentroModal = false"
        />
    </div>
</template>
