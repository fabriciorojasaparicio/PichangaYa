<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pichangaya - Reserva Canchas Deportivas Online</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "surface-container-low": "#f6f8f6",
                        "background": "#f6f8f6",
                        "surface-dim": "#d2ddcd",
                        "on-background": "#0f172a",
                        "on-surface-variant": "#475569",
                        "outline": "#cbd5e1",
                        "outline-variant": "#e2e8f0",
                        "on-surface": "#0f172a",
                        "surface": "#f6f8f6",
                        "surface-container": "#e6f1e1",
                        "surface-container-high": "#e0ebdb",
                        "primary": "#13ec5b",
                        "on-primary": "#102216",
                        "secondary": "#026e25",
                        "on-secondary": "#ffffff",
                    },
                    fontFamily: {
                        headline: ["Lexend"],
                        body: ["Lexend"],
                        lexend: ["Lexend"],
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
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
<nav class="fixed top-0 w-full z-50 flex justify-between items-center px-4 md:px-8 h-16 bg-white shadow-sm border-b border-zinc-200 font-lexend">
    <div class="flex items-center gap-10">
        <span class="text-xl font-black text-zinc-900 tracking-tighter">
            <span class="text-primary">Pichangaya</span>
        </span>
        <div class="hidden lg:flex items-center gap-8">
            <a class="text-sm font-bold text-primary border-b-2 border-primary py-5" href="#home">Inicio</a>
            <a class="text-sm font-semibold text-zinc-600 hover:text-primary transition-colors" href="#centros">Centros</a>
            <a class="text-sm font-semibold text-zinc-600 hover:text-primary transition-colors" href="#como-funciona">Cómo Funciona</a>
        </div>
    </div>
    <div class="flex items-center gap-4">
        @auth
            <a href="{{ route('centros.index') }}" class="text-sm font-semibold text-zinc-600 hover:text-primary transition-colors">Mis Reservas</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-2xl font-black text-sm hover:brightness-105 active:scale-95 transition-all">
                    Cerrar Sesión
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-sm font-semibold text-zinc-600 hover:text-primary transition-colors">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="bg-primary text-on-primary px-6 py-2 rounded-2xl font-black text-sm hover:brightness-105 active:scale-95 transition-all">
                Registrarse
            </a>
        @endauth
    </div>
</nav>

<main>
    <!-- Hero Section with Integrated Search -->
    <section class="hero-gradient min-h-[500px] flex flex-col items-center justify-center text-center px-4 pt-24 pb-12" id="home">
        <div class="max-w-4xl w-full mb-10">
            <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tight">Tu próxima victoria comienza aquí</h1>
            <p class="text-lg md:text-xl text-zinc-200 max-w-2xl mx-auto">Reserva las mejores canchas deportivas en tu ciudad en segundos. Sin llamadas, sin vueltas.</p>
        </div>
        <!-- Integrated Hero Search Bar -->
        <div class="w-full max-w-3xl px-4">
            <form class="bg-white/95 backdrop-blur-md rounded-3xl md:rounded-full p-2 shadow-2xl flex flex-col md:flex-row items-stretch gap-2" action="{{ route('centros.index') }}" method="GET">
                <!-- Sport Select -->
                <div class="flex-1 flex items-center px-6 py-3 md:py-0 border-b md:border-b-0 md:border-r border-zinc-100 group transition-all">
                    <span class="material-symbols-outlined text-primary mr-3">sports_soccer</span>
                    <div class="text-left w-full">
                        <label class="block text-[10px] font-black text-zinc-400 uppercase tracking-wider">Disciplina</label>
                        <select name="deporte" class="w-full bg-transparent border-none focus:ring-0 p-0 text-sm font-bold text-zinc-800 cursor-pointer">
                            <option value="">Todos los deportes</option>
                            <option value="futbol">Fútbol</option>
                            <option value="voley">Vóley</option>
                            <option value="basket">Básquet</option>
                            <option value="tenis">Tenis</option>
                            <option value="padel">Pádel</option>
                        </select>
                    </div>
                </div>
                <!-- Location -->
                <div class="flex-[1.5] flex items-center px-6 py-3 md:py-0 group transition-all">
                    <span class="material-symbols-outlined text-primary mr-3">location_on</span>
                    <div class="text-left w-full">
                        <label class="block text-[10px] font-black text-zinc-400 uppercase tracking-wider">Lugar</label>
                        <input name="busqueda" class="w-full bg-transparent border-none focus:ring-0 p-0 text-sm font-bold text-zinc-800 placeholder:text-zinc-400" placeholder="Barrio o zona..." type="text"/>
                    </div>
                </div>
                <!-- Search Button -->
                <button type="submit" class="bg-primary text-on-primary md:px-10 py-4 rounded-2xl md:rounded-full font-black text-sm uppercase tracking-widest flex items-center justify-center gap-2 hover:brightness-105 active:scale-95 transition-all shadow-lg shadow-primary/30">
                    <span class="material-symbols-outlined">search</span>
                    <span>Buscar</span>
                </button>
            </form>
        </div>
    </section>

    <!-- How it Works Section -->
    <section class="max-w-[1400px] mx-auto px-4 py-20 bg-white rounded-[3rem] p-10 md:p-16 border border-outline-variant shadow-sm my-20" id="como-funciona">
        <h2 class="text-3xl font-black text-center mb-16">¿Cómo funciona Pichangaya?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-primary/10 text-primary rounded-full flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-4xl">search</span>
                </div>
                <h3 class="text-xl font-bold mb-3">1. Buscá</h3>
                <p class="text-on-surface-variant">Filtrá por deporte, zona, horario y servicios del complejo.</p>
            </div>
            <div class="flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-primary/10 text-primary rounded-full flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-4xl">event_available</span>
                </div>
                <h3 class="text-xl font-bold mb-3">2. Reservá</h3>
                <p class="text-on-surface-variant">Elegí tu turno y pagá de forma segura desde la app.</p>
            </div>
            <div class="flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-primary/10 text-primary rounded-full flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-4xl">sports_soccer</span>
                </div>
                <h3 class="text-xl font-bold mb-3">3. Jugá</h3>
                <p class="text-on-surface-variant">Presentate en el complejo y disfrutá del partido con amigos.</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="max-w-[1400px] mx-auto px-4 mb-20 bg-surface-container rounded-[3rem] p-10 md:p-20 text-center border border-outline-variant relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-5xl font-black text-on-surface mb-6 tracking-tight">¡Únete a la comunidad de Pichangaya!</h2>
            <p class="text-lg text-on-surface-variant mb-12">Regístrate para gestionar tus reservas, ver tu historial y recibir beneficios exclusivos.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                @guest
                    <a href="{{ route('register') }}" class="w-full sm:w-auto min-w-[200px] bg-primary text-on-primary py-5 px-10 rounded-2xl font-black text-lg shadow-xl shadow-primary/20 hover:brightness-105 active:scale-95 transition-all text-center">
                        Registrarse
                    </a>
                    <a href="{{ route('login') }}" class="w-full sm:w-auto min-w-[200px] bg-white text-secondary py-5 px-10 rounded-2xl font-black text-lg border-2 border-secondary hover:bg-secondary hover:text-white active:scale-95 transition-all text-center">
                        Iniciar Sesión
                    </a>
                @else
                    <a href="{{ route('centros.index') }}" class="w-full sm:w-auto min-w-[200px] bg-primary text-on-primary py-5 px-10 rounded-2xl font-black text-lg shadow-xl shadow-primary/20 hover:brightness-105 active:scale-95 transition-all text-center">
                        Ver Canchas
                    </a>
                @endguest
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="bg-zinc-900 text-zinc-400 py-16 px-4">
    <div class="max-w-[1400px] mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
        <div class="col-span-1">
            <span class="text-2xl font-black text-white tracking-tighter mb-6 block">Pichangaya</span>
            <p class="text-sm leading-relaxed mb-6">Simplificando la forma de jugar deporte. Encontrá, reservá y jugá.</p>
            <div class="flex gap-4">
                <a class="w-10 h-10 bg-zinc-800 rounded-full flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all" href="#">
                    <span class="material-symbols-outlined text-xl">share</span>
                </a>
                <a class="w-10 h-10 bg-zinc-800 rounded-full flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all" href="#">
                    <span class="material-symbols-outlined text-xl">alternate_email</span>
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
        <p>© 2024 Pichangaya. Todos los derechos reservados.</p>
    </div>
</footer>

</body>
</html>
