<script setup lang="ts">
import MaterialIcon from '@/components/MaterialIcon.vue';
// 👉 AQUÍ VA EL SCRIPT (el que te di antes)
import { ref, onMounted } from "vue";
import api from "@/services/api";

const centros = ref<any[]>([]);
const loading = ref(false);
const error = ref<string | null>(null);

const obtenerCentros = async () => {
  loading.value = true;
  error.value = null;

  try {
    const response = await api.get("/centros");
    centros.value = response.data;
  } catch (err) {
    console.error(err);
    error.value = "Error al cargar centros";
  } finally {
    loading.value = false;
  }
};

onMounted(obtenerCentros);
</script>

<template>
<!DOCTYPE html>

<html lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-container-low": "#f6f8f6",
                    "background": "#f6f8f6",
                    "surface-dim": "#d2ddcd",
                    "tertiary-container": "#ffc091",
                    "tertiary-fixed-dim": "#f8ba8b",
                    "on-tertiary-fixed-variant": "#673d18",
                    "on-primary": "#102216",
                    "surface-container": "#e6f1e1",
                    "tertiary-fixed": "#ffdcc4",
                    "error-container": "#ffdad6",
                    "outline": "#cbd5e1",
                    "on-background": "#0f172a",
                    "primary-fixed": "#6cff81",
                    "primary-fixed-dim": "#00e556",
                    "on-surface-variant": "#475569",
                    "surface-container-highest": "#dbe6d6",
                    "tertiary": "#83542d",
                    "surface-container-high": "#e0ebdb",
                    "inverse-primary": "#00e556",
                    "on-tertiary-fixed": "#2f1400",
                    "outline-variant": "#e2e8f0",
                    "on-primary-fixed-variant": "#00531a",
                    "on-error-container": "#93000a",
                    "secondary-container": "#9af89d",
                    "on-secondary": "#ffffff",
                    "on-error": "#ffffff",
                    "inverse-surface": "#102216",
                    "surface-variant": "#dbe6d6",
                    "primary": "#13ec5b",
                    "on-primary-fixed": "#002106",
                    "secondary": "#026e25",
                    "surface-bright": "#ffffff",
                    "on-tertiary-container": "#7a4c27",
                    "on-primary-container": "#002106",
                    "surface-tint": "#006e25",
                    "on-tertiary": "#ffffff",
                    "secondary-fixed": "#9af89d",
                    "secondary-fixed-dim": "#7fdb84",
                    "surface-container-lowest": "#ffffff",
                    "surface": "#f6f8f6",
                    "on-secondary-container": "#10742b",
                    "on-secondary-fixed-variant": "#00531a",
                    "inverse-on-surface": "#f2fdec",
                    "primary-container": "#13ec5b",
                    "error": "#ba1a1a",
                    "on-surface": "#0f172a",
                    "on-secondary-fixed": "#002106"
            },
            "borderRadius": {
                    "DEFAULT": "0.5rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "2xl": "1rem",
                    "3xl": "1.5rem",
                    "full": "9999px"
            },
            "fontFamily": {
                    "headline": ["Lexend"],
                    "body": ["Lexend"],
                    "label": ["Lexend"],
                    "lexend": ["Lexend"]
            }
          },
        },
      }
    </script>
<style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .hero-gradient {
            background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.75)), url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=2000');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-background font-body text-on-background antialiased pb-20 md:pb-0">
<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 flex justify-between items-center px-4 md:px-8 h-16 bg-white dark:bg-zinc-950 shadow-sm border-b border-zinc-200 dark:border-zinc-800 font-lexend">
<div class="flex items-center gap-10">
<span class="text-xl font-black text-zinc-900 dark:text-white tracking-tighter">SportReserve</span>
<div class="hidden lg:flex items-center gap-8">
<a class="text-sm font-bold text-primary border-b-2 border-primary py-5" href="#">Inicio</a>
<a class="text-sm font-semibold text-zinc-600 dark:text-zinc-400 hover:text-primary transition-colors" href="#">Reservar</a>
<a class="text-sm font-semibold text-zinc-600 dark:text-zinc-400 hover:text-primary transition-colors" href="#">Cómo funciona</a>
<a class="text-sm font-semibold text-zinc-600 dark:text-zinc-400 hover:text-primary transition-colors" href="#">Contacto</a>
</div>
</div>
<div class="flex items-center gap-4">
<div class="hidden xl:flex items-center bg-surface-container-low rounded-full px-4 py-2 border border-outline-variant w-64">
<MaterialIcon name="search" class="text-zinc-500 text-lg mr-2" data-icon="search" />
<input class="bg-transparent border-none focus:ring-0 text-sm w-full placeholder:text-zinc-500" placeholder="Buscar complejo..." type="text"/>
</div>
<button class="p-2 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors rounded-full relative active:scale-95">
<MaterialIcon name="history" class="" data-icon="history" />
</button>
<button class="p-2 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors rounded-full relative active:scale-95">
<MaterialIcon name="notifications" class="" data-icon="notifications" />
<span class="absolute top-2 right-2 w-2 h-2 bg-primary rounded-full"></span>
</button>
<div class="flex items-center gap-2 pl-2 border-l border-zinc-200 dark:border-zinc-800">
<img alt="Avatar de usuario" class="w-8 h-8 rounded-full border-2 border-primary" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCO5E9szCGCZUREngQwyMzspJl7SwzHKjbNWjKlMZnHyDAu-LUKxauaO9eliZedtSkqyFJl4iUXCl9BUbAw02k1hKhk0grx8GhPVs1hcpEk4kJ0CpsffLVFNBDse4oVqjlwZtjibDFfQRHu4OEz0DGQZeo-XxioJtRS5-ARwI6Ihg5yyzDgjan6u8ff0fYWAWafGLprO0MOWHzsGT-F4vizyIU2WWDj_I5Z1wkh6D-TB5T86DvY4dsd3mHcgMeqDC-BssO2vMCSTs9g"/>
</div>
</div>
</nav>
<main>
<!-- Hero Section with Integrated Search -->
<section class="hero-gradient min-h-[500px] flex flex-col items-center justify-center text-center px-4 pt-24 pb-12">
<div class="max-w-4xl w-full mb-10">
<h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tight">Tu próxima victoria comienza aquí</h1>
<p class="text-lg md:text-xl text-zinc-200 max-w-2xl mx-auto">Reserva las mejores canchas de Buenos Aires en segundos. Sin llamadas, sin vueltas.</p>
</div>
<!-- Integrated Hero Search Bar -->
<div class="w-full max-w-3xl px-4">
<div class="bg-white/95 backdrop-blur-md rounded-3xl md:rounded-full p-2 shadow-2xl flex flex-col md:flex-row items-stretch gap-2">
<!-- Sport Select -->
<div class="flex-1 flex items-center px-6 py-3 md:py-0 border-b md:border-b-0 md:border-r border-zinc-100 group transition-all">
<MaterialIcon name="sports_soccer" class="text-primary mr-3" data-icon="sports_soccer" />
<div class="text-left w-full">
<label class="block text-[10px] font-black text-zinc-400 uppercase tracking-wider">Disciplina</label>
<select class="w-full bg-transparent border-none focus:ring-0 p-0 text-sm font-bold text-zinc-800 cursor-pointer">
<option>Fútbol</option>
<option>Vóley</option>
<option>Tenis</option>
<option>Básquet</option>
<option>Pádel</option>
</select>
</div>
</div>
<!-- Location -->
<div class="flex-[1.5] flex items-center px-6 py-3 md:py-0 group transition-all">
<MaterialIcon name="location_on" class="text-primary mr-3" data-icon="location_on" />
<div class="text-left w-full">
<label class="block text-[10px] font-black text-zinc-400 uppercase tracking-wider">Lugar</label>
<input class="w-full bg-transparent border-none focus:ring-0 p-0 text-sm font-bold text-zinc-800 placeholder:text-zinc-400" placeholder="Barrio o zona..." type="text"/>
</div>
</div>
<!-- Search Button -->
<button class="bg-primary text-on-primary md:px-10 py-4 rounded-2xl md:rounded-full font-black text-sm uppercase tracking-widest flex items-center justify-center gap-2 hover:brightness-105 active:scale-95 transition-all shadow-lg shadow-primary/30">
<MaterialIcon name="search" class="" data-icon="search" />
<span>Buscar</span>
</button>
</div>
</div>
</section>
<!-- Main Content Area with Sidebar -->
<div class="max-w-[1400px] mx-auto px-4 py-12 flex flex-col lg:flex-row gap-8">
<!-- Sidebar Filters -->
<aside class="w-full lg:w-72 shrink-0">
<div class="sticky top-24 space-y-8 bg-white p-6 rounded-3xl border border-outline-variant shadow-sm">
<div class="flex items-center justify-between mb-2">
<h3 class="font-black text-sm uppercase tracking-widest text-zinc-900">Filtros</h3>
<button class="text-[10px] font-bold text-primary hover:underline">Limpiar</button>
</div>
<!-- Disciplinas Vertical -->
<div>
<span class="text-[10px] font-black text-zinc-400 uppercase tracking-wider mb-4 block">Deportes</span>
<div class="flex flex-col gap-2">
<button class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-primary text-on-primary text-xs font-bold transition-all shadow-sm w-full text-left">
<MaterialIcon name="sports_soccer" class="text-lg" data-icon="sports_soccer" /> Fútbol
                            </button>
<button class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-outline-variant bg-white text-zinc-600 text-xs font-bold hover:border-primary transition-all w-full text-left">
<MaterialIcon name="sports_volleyball" class="text-lg" data-icon="sports_volleyball" /> Vóley
                            </button>
<button class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-outline-variant bg-white text-zinc-600 text-xs font-bold hover:border-primary transition-all w-full text-left">
<MaterialIcon name="sports_basketball" class="text-lg" data-icon="sports_basketball" /> Básquet
                            </button>
<button class="flex items-center gap-3 px-4 py-2.5 rounded-xl border border-outline-variant bg-white text-zinc-600 text-xs font-bold hover:border-primary transition-all w-full text-left">
<MaterialIcon name="sports_tennis" class="text-lg" data-icon="sports_tennis" /> Tenis
                            </button>
</div>
</div>
<!-- Servicios Vertical -->
<div>
<span class="text-[10px] font-black text-zinc-400 uppercase tracking-wider mb-4 block">Servicios</span>
<div class="flex flex-col gap-2">
<label class="flex items-center gap-3 cursor-pointer group">
<div class="w-5 h-5 border-2 border-outline-variant rounded flex items-center justify-center group-hover:border-primary transition-colors">
<MaterialIcon name="check" class="text-sm text-primary opacity-0" data-icon="check" />
</div>
<span class="flex items-center gap-2 text-xs font-bold text-zinc-600">
<MaterialIcon name="wifi" class="text-lg" data-icon="wifi" /> WiFi
                                </span>
</label>
<label class="flex items-center gap-3 cursor-pointer group">
<div class="w-5 h-5 border-2 border-outline-variant rounded flex items-center justify-center group-hover:border-primary transition-colors">
<MaterialIcon name="check" class="text-sm text-primary opacity-0" data-icon="check" />
</div>
<span class="flex items-center gap-2 text-xs font-bold text-zinc-600">
<MaterialIcon name="coffee" class="text-lg" data-icon="coffee" /> Cafetería
                                </span>
</label>
<label class="flex items-center gap-3 cursor-pointer group">
<div class="w-5 h-5 border-2 border-outline-variant rounded flex items-center justify-center group-hover:border-primary transition-colors">
<MaterialIcon name="check" class="text-sm text-primary opacity-0" data-icon="check" />
</div>
<span class="flex items-center gap-2 text-xs font-bold text-zinc-600">
<MaterialIcon name="outdoor_grill" class="text-lg" data-icon="outdoor_grill" /> Parrilla
                                </span>
</label>
<label class="flex items-center gap-3 cursor-pointer group">
<div class="w-5 h-5 border-2 border-outline-variant rounded flex items-center justify-center group-hover:border-primary transition-colors">
<MaterialIcon name="check" class="text-sm text-primary opacity-0" data-icon="check" />
</div>
<span class="flex items-center gap-2 text-xs font-bold text-zinc-600">
<MaterialIcon name="checkroom" class="text-lg" data-icon="checkroom" /> Vestuarios
                                </span>
</label>
</div>
</div>
<!-- Infraestructura Vertical -->
<div>
<span class="text-[10px] font-black text-zinc-400 uppercase tracking-wider mb-4 block">Infraestructura</span>
<div class="flex flex-col gap-2">
<label class="flex items-center gap-3 cursor-pointer group">
<div class="w-5 h-5 border-2 border-outline-variant rounded flex items-center justify-center group-hover:border-primary transition-colors">
<MaterialIcon name="check" class="text-sm text-primary opacity-0" data-icon="check" />
</div>
<span class="flex items-center gap-2 text-xs font-bold text-zinc-600">
<MaterialIcon name="local_parking" class="text-lg" data-icon="local_parking" /> Parking
                                </span>
</label>
<label class="flex items-center gap-3 cursor-pointer group">
<div class="w-5 h-5 border-2 border-outline-variant rounded flex items-center justify-center group-hover:border-primary transition-colors">
<MaterialIcon name="check" class="text-sm text-primary opacity-0" data-icon="check" />
</div>
<span class="flex items-center gap-2 text-xs font-bold text-zinc-600">
<MaterialIcon name="shower" class="text-lg" data-icon="shower" /> Duchas
                                </span>
</label>
<label class="flex items-center gap-3 cursor-pointer group">
<div class="w-5 h-5 border-2 border-outline-variant rounded flex items-center justify-center group-hover:border-primary transition-colors">
<MaterialIcon name="check" class="text-sm text-primary opacity-0" data-icon="check" />
</div>
<span class="flex items-center gap-2 text-xs font-bold text-zinc-600">
<MaterialIcon name="stadium" class="text-lg" data-icon="stadium" /> Gradas
                                </span>
</label>
</div>
</div>
<button class="w-full bg-primary text-on-primary py-3 rounded-2xl font-black text-xs uppercase tracking-widest shadow-md hover:brightness-105 active:scale-95 transition-all">
                        Aplicar Filtros
                    </button>
</div>
</aside>
<!-- Featured Complexes Section -->
<section class="flex-1">
<div class="flex justify-between items-end mb-8">
<div>
<h2 class="text-3xl font-black text-on-background">Complejos Destacados</h2>
<p class="text-on-surface-variant mt-2">Los favoritos de la comunidad esta semana en Buenos Aires.</p>
</div>
<a class="text-primary font-bold flex items-center gap-1 hover:underline" href="#">
                        Ver todos
                        <MaterialIcon name="arrow_forward" class="" data-icon="arrow_forward" />
</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<!-- Complex Card 1 -->
<div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-outline-variant group flex flex-col h-full">
<div class="relative h-64 overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBa22jnBVmlTEg2luStHRneuPPkw73AiagdEyGxL0gavirv3Xv3DHLHlkDRBSFZLWZDtcDHn8HG2JfFLilHKrb17eM2d_z4e6fpWFxLXhF9rJGcxu64lsPUaxIEaTyTxLN_wyhkDKV3ysM6Yfpz5oa5cI3GxA0DLs40r6pdYGIhJoAu0Zg0tDmeCNF4EDp1N_4kHmfRpsZsfD0HffcLqiu3NhrgONuRxUhzjTL_Njbbs86hfQiUwJnxd0Ipo2HuSD6hlBuq0BjikKz1"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<span class="absolute top-4 left-4 bg-secondary text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider">Destacado</span>
<button class="absolute top-4 right-4 p-2 bg-white/20 backdrop-blur-md rounded-full text-white hover:bg-white hover:text-red-500 transition-all">
<MaterialIcon name="favorite" class="" data-icon="favorite" />
</button>
</div>
<div class="p-6 flex flex-col flex-grow">
<div class="flex justify-between items-start mb-3">
<div>
<h3 class="text-xl font-black text-zinc-900 leading-tight">Club Atlético Central</h3>
<div class="flex items-center gap-1 text-on-surface-variant text-sm mt-1">
<MaterialIcon name="location_on" class="text-lg" data-icon="location_on" />
                                        Palermo, CABA
                                    </div>
</div>
<div class="flex items-center bg-surface-container-high px-2 py-1 rounded-xl">
<MaterialIcon name="star" class="text-yellow-500 text-sm" data-icon="star" style="font-variation-settings: 'FILL' 1;" />
<span class="ml-1 text-sm font-black">4.8</span>
</div>
</div>
<div class="flex flex-wrap gap-2 my-4">
<div class="flex items-center gap-1.5 px-3 py-1.5 bg-surface-container text-on-surface-variant rounded-lg text-xs font-semibold">
<MaterialIcon name="local_parking" class="text-lg" data-icon="local_parking" /> Párking
                                </div>
<div class="flex items-center gap-1.5 px-3 py-1.5 bg-surface-container text-on-surface-variant rounded-lg text-xs font-semibold">
<MaterialIcon name="shower" class="text-lg" data-icon="shower" /> Duchas
                                </div>
</div>
<div class="mt-auto pt-4 border-t border-outline-variant flex items-center justify-between">
<div>
<span class="text-xs text-on-surface-variant font-medium">Desde</span>
<p class="text-xl font-black text-secondary">$12.500<span class="text-xs font-normal text-on-surface-variant">/hr</span></p>
</div>
<button class="bg-primary text-on-primary px-6 py-3 rounded-2xl font-black text-sm flex items-center gap-2 hover:brightness-105 active:scale-95 transition-all shadow-md">
                                    Reservar
                                </button>
</div>
</div>
</div>
<!-- Card 2 -->
<div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-outline-variant group flex flex-col h-full">
<div class="relative h-64 overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBK_VPMk6p4VStX-HhdrzRIkGKg0LeAqEAOEEA2ieCdcxHwNlwx6hiGV1STW_KwEAyNo2KGi-x8Pa7Ygb8yKlJyR387WGQJ6ZvTChzR-M9taQo_HulegjJ_QTkUuCOZkfOtQhfl2by5qBWC4Qr4V-UJK_uVr1AhEiBOZlo_18-HW2P_OHSIMA2b2B63DQwdrkByZXPHhDW0VVvDbdN_7PbclLrh4nbaowEtCoffNlB2IbSKXIGmkxOg6nwLrFoMyDVN_m6dB9pWG8M1"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<button class="absolute top-4 right-4 p-2 bg-white/20 backdrop-blur-md rounded-full text-white hover:bg-white hover:text-red-500 transition-all">
<MaterialIcon name="favorite" class="" data-icon="favorite" />
</button>
</div>
<div class="p-6 flex flex-col flex-grow">
<div class="flex justify-between items-start mb-3">
<div>
<h3 class="text-xl font-black text-zinc-900 leading-tight">Arena Belgrano</h3>
<div class="flex items-center gap-1 text-on-surface-variant text-sm mt-1">
<MaterialIcon name="location_on" class="text-lg" data-icon="location_on" />
                                        Belgrano, CABA
                                    </div>
</div>
<div class="flex items-center bg-surface-container-high px-2 py-1 rounded-xl">
<MaterialIcon name="star" class="text-yellow-500 text-sm" data-icon="star" style="font-variation-settings: 'FILL' 1;" />
<span class="ml-1 text-sm font-black">4.5</span>
</div>
</div>
<div class="flex flex-wrap gap-2 my-4">
<div class="flex items-center gap-1.5 px-3 py-1.5 bg-surface-container text-on-surface-variant rounded-lg text-xs font-semibold">
<MaterialIcon name="shower" class="text-lg" data-icon="shower" /> Duchas
                                </div>
<div class="flex items-center gap-1.5 px-3 py-1.5 bg-surface-container text-on-surface-variant rounded-lg text-xs font-semibold">
<MaterialIcon name="wifi" class="text-lg" data-icon="wifi" /> WiFi
                                </div>
</div>
<div class="mt-auto pt-4 border-t border-outline-variant flex items-center justify-between">
<div>
<span class="text-xs text-on-surface-variant font-medium">Desde</span>
<p class="text-xl font-black text-secondary">$15.000<span class="text-xs font-normal text-on-surface-variant">/hr</span></p>
</div>
<button class="bg-primary text-on-primary px-6 py-3 rounded-2xl font-black text-sm flex items-center gap-2 hover:brightness-105 active:scale-95 transition-all shadow-md">
                                    Ver Sedes
                                </button>
</div>
</div>
</div>
<!-- Card 3 -->
<div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-outline-variant group flex flex-col h-full">
<div class="relative h-64 overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDkeDsRuHiMVPckbQT7HYtE4B2-20M6NwS-TRgLE2NM_lBAIsyfn-qn8yyuvEdJv4rku9Vgg7hrhSiKm3L06a-FaK6isfkYkbzGOuTE1jb2mG4MugWVY-pZu9GKOirWPD6C6g72Vil95OsopuVB7RXDQbzjOq9KhDT8JiYkyqTL0WJftWOu28fdxCdt7BkOT9MpoxuG73F3InDnFK2QDwg_2SOKZDXQ8fSF_cmCClfY2k0KKNYC150n8wMPfNQuICJcBOUgGf9LYQ6i"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<button class="absolute top-4 right-4 p-2 bg-white/20 backdrop-blur-md rounded-full text-white hover:bg-white hover:text-red-500 transition-all">
<MaterialIcon name="favorite" class="" data-icon="favorite" />
</button>
</div>
<div class="p-6 flex flex-col flex-grow">
<div class="flex justify-between items-start mb-3">
<div>
<h3 class="text-xl font-black text-zinc-900 leading-tight">La Quinta Sports</h3>
<div class="flex items-center gap-1 text-on-surface-variant text-sm mt-1">
<MaterialIcon name="location_on" class="text-lg" data-icon="location_on" />
                                        Núñez, CABA
                                    </div>
</div>
<div class="flex items-center bg-surface-container-high px-2 py-1 rounded-xl">
<MaterialIcon name="star" class="text-yellow-500 text-sm" data-icon="star" style="font-variation-settings: 'FILL' 1;" />
<span class="ml-1 text-sm font-black">4.2</span>
</div>
</div>
<div class="flex flex-wrap gap-2 my-4">
<div class="flex items-center gap-1.5 px-3 py-1.5 bg-surface-container text-on-surface-variant rounded-lg text-xs font-semibold">
<MaterialIcon name="local_parking" class="text-lg" data-icon="local_parking" /> Párking
                                </div>
<div class="flex items-center gap-1.5 px-3 py-1.5 bg-surface-container text-on-surface-variant rounded-lg text-xs font-semibold">
<MaterialIcon name="restaurant" class="text-lg" data-icon="restaurant" /> Buffet
                                </div>
</div>
<div class="mt-auto pt-4 border-t border-outline-variant flex items-center justify-between">
<div>
<span class="text-xs text-on-surface-variant font-medium">Desde</span>
<p class="text-xl font-black text-secondary">$10.000<span class="text-xs font-normal text-on-surface-variant">/hr</span></p>
</div>
<button class="bg-primary text-on-primary px-6 py-3 rounded-2xl font-black text-sm flex items-center gap-2 hover:brightness-105 active:scale-95 transition-all shadow-md">
                                    Reservar
                                </button>
</div>
</div>
</div>
</div>
</section>
</div>
<div class="max-w-[1400px] mx-auto px-4">
<!-- How it Works Section -->
<section class="mb-20 bg-white rounded-[3rem] p-10 md:p-16 border border-outline-variant shadow-sm">
<h2 class="text-3xl font-black text-center mb-16">¿Cómo funciona SportReserve?</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-12">
<div class="flex flex-col items-center text-center">
<div class="w-20 h-20 bg-primary/10 text-primary rounded-full flex items-center justify-center mb-6">
<MaterialIcon name="search" class="text-4xl" data-icon="search" />
</div>
<h3 class="text-xl font-bold mb-3">1. Buscá</h3>
<p class="text-on-surface-variant">Filtrá por deporte, zona, horario y servicios del complejo.</p>
</div>
<div class="flex flex-col items-center text-center">
<div class="w-20 h-20 bg-primary/10 text-primary rounded-full flex items-center justify-center mb-6">
<MaterialIcon name="event_available" class="text-4xl" data-icon="event_available" />
</div>
<h3 class="text-xl font-bold mb-3">2. Reservá</h3>
<p class="text-on-surface-variant">Elegí tu turno y pagá de forma segura desde la app.</p>
</div>
<div class="flex flex-col items-center text-center">
<div class="w-20 h-20 bg-primary/10 text-primary rounded-full flex items-center justify-center mb-6">
<MaterialIcon name="sports_soccer" class="text-4xl" data-icon="sports_soccer" />
</div>
<h3 class="text-xl font-bold mb-3">3. Jugá</h3>
<p class="text-on-surface-variant">Presentate en el complejo y disfrutá del partido con amigos.</p>
</div>
</div>
</section>
<!-- Testimonials -->
<section class="mb-20 text-center">
<div class="flex flex-col items-center">
<div class="flex gap-1 mb-4">
<MaterialIcon name="star" class="text-yellow-500" style="font-variation-settings: 'FILL' 1;" />
<MaterialIcon name="star" class="text-yellow-500" style="font-variation-settings: 'FILL' 1;" />
<MaterialIcon name="star" class="text-yellow-500" style="font-variation-settings: 'FILL' 1;" />
<MaterialIcon name="star" class="text-yellow-500" style="font-variation-settings: 'FILL' 1;" />
<MaterialIcon name="star" class="text-yellow-500" style="font-variation-settings: 'FILL' 1;" />
</div>
<p class="text-xl font-medium text-zinc-800 italic max-w-2xl">"La mejor app para organizar partidos. Antes tardábamos horas llamando a complejos, ahora en 2 minutos ya tenemos la cancha lista."</p>
<div class="mt-6 flex items-center gap-3">
<img alt="Usuario" class="w-12 h-12 rounded-full border-2 border-white shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC0Zrsw5eJmX8aMd6uJPqgCRVt2xI8NiOXaw1SZrxxxA-upWbng84rVf8vhNqSv-JsqHWs3qJoYmdLX1nWA2rz9CUSrc5r7tAikB3X8npxOLwjOW7RYIOABOOxC5yMmt9Aoy2qD8vsYJPEquyREWpZa6cpRAHkRyj8CuSg9Ee3MwPPbxxoE-FbZPENGoDqp4Va45PJpaxV6zlDhmRTnczY06w-INi_UoP27kTtNEY3c3mvmKcR6wp2xYOM6HialnyR6p6q1aJEDeGJx"/>
<div class="text-left">
<p class="font-bold text-sm">Nicolás R.</p>
<p class="text-xs text-on-surface-variant">Usuario frecuente • +50 reservas</p>
</div>
</div>
</div>
</section>
<!-- Join Community CTA Section -->
<section class="mb-20 bg-surface-container rounded-[3rem] p-10 md:p-20 text-center border border-outline-variant relative overflow-hidden">
<div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
<div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 bg-secondary/5 rounded-full blur-3xl"></div>
<div class="relative z-10 max-w-3xl mx-auto">
<h2 class="text-3xl md:text-5xl font-black text-on-surface mb-6 tracking-tight">¡Únete a la comunidad de SportReserve!</h2>
<p class="text-lg text-on-surface-variant mb-12">Regístrate para gestionar tus reservas, ver tu historial y recibir beneficios exclusivos.</p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-6">
<button class="w-full sm:w-auto min-w-[200px] bg-primary text-on-primary py-5 px-10 rounded-2xl font-black text-lg shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all">
                            Registrarse
                        </button>
<button class="w-full sm:w-auto min-w-[200px] bg-white text-secondary py-5 px-10 rounded-2xl font-black text-lg border-2 border-secondary hover:bg-secondary hover:text-white active:scale-95 transition-all">
                            Iniciar Sesión
                        </button>
</div>
</div>
</section>
</div>
</main>
<!-- Footer -->
<footer class="bg-zinc-900 text-zinc-400 py-16 px-4">
<div class="max-w-[1400px] mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
<div class="col-span-1">
<span class="text-2xl font-black text-white tracking-tighter mb-6 block">SportReserve</span>
<p class="text-sm leading-relaxed mb-6">Simplificando la forma de jugar deporte en Argentina. Encontrá, reservá y jugá.</p>
<div class="flex gap-4">
<a class="w-10 h-10 bg-zinc-800 rounded-full flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all" href="#">
<MaterialIcon name="share" class="text-xl" data-icon="share" />
</a>
<a class="w-10 h-10 bg-zinc-800 rounded-full flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all" href="#">
<MaterialIcon name="alternate_email" class="text-xl" data-icon="alternate_email" />
</a>
</div>
</div>
<div>
<h4 class="text-white font-bold mb-6">Explorar</h4>
<ul class="space-y-4 text-sm font-medium">
<li><a class="hover:text-primary transition-colors" href="#">Fútbol</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Vóley</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Tenis</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Básquet</a></li>
</ul>
</div>
<div>
<h4 class="text-white font-bold mb-6">Soporte</h4>
<ul class="space-y-4 text-sm font-medium">
<li><a class="hover:text-primary transition-colors" href="#">Centro de ayuda</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Publicá tu complejo</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Términos y condiciones</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Política de privacidad</a></li>
</ul>
</div>
<div>
<h4 class="text-white font-bold mb-6">Newsletter</h4>
<p class="text-sm mb-4">Recibí ofertas exclusivas de complejos cercanos.</p>
<div class="flex flex-col gap-2">
<input class="bg-zinc-800 border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary w-full text-white" placeholder="Tu email" type="email"/>
<button class="bg-primary text-on-primary py-3 rounded-xl font-bold text-sm hover:brightness-105 active:scale-95 transition-all">Suscribirme</button>
</div>
</div>
</div>
<div class="max-w-[1400px] mx-auto mt-16 pt-8 border-t border-zinc-800 text-center text-xs">
<p>© 2024 SportReserve. Todos los derechos reservados.</p>
</div>
</footer>
<!-- BottomNavBar (Mobile Only) -->
<nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-2 py-3 bg-white/80 dark:bg-zinc-950/80 backdrop-blur-md border-t border-zinc-200 dark:border-zinc-800 shadow-[0_-2px_10px_rgba(0,0,0,0.05)] font-lexend text-[10px] font-medium">
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
</body></html>

  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">
      Centros Deportivos
    </h1>

    <div v-if="loading">
      Cargando...
    </div>

    <div v-if="error">
      {{ error }}
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div
        v-for="centro in centros"
        :key="centro.id"
        class="border p-4 rounded"
      >
        <h2 class="font-bold">
          {{ centro.nombre }}
        </h2>

        <p>{{ centro.direccion }}</p>

        <p>
          Canchas: {{ centro.canchas.length }}
        </p>
      </div>
    </div>
  </div>
</template>

<style>
/* 👉 OPCIONAL: estilos */
</style>