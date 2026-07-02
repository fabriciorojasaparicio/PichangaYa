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
<body class="bg-background font-body text-on-background antialiased">
<!-- TopNavBar -->
        }

        .filter-tag {
            background: #f1f5f9;
            color: #475569;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-tag:hover,
        .filter-tag.active {
            background: #1e40af;
            color: white;
        }

        .filter-options {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .filter-option {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 14px;
        }

        .filter-option input[type="checkbox"] {
            width: 16px;
            height: 16px;
        }

        /* Featured Centers */
        .featured-section {
            padding: 80px 20px;
            background: white;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 60px;
        }

        .centers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .center-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .center-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .center-image {
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .center-content {
            padding: 24px;
        }

        .center-name {
            font-size: 20px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .center-location {
            color: #64748b;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .center-features {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
        }

        .center-feature {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #64748b;
            font-size: 14px;
        }

        .center-price {
            font-size: 18px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 20px;
        }

        .btn-book {
            width: 100%;
            background: #1e40af;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-book:hover {
            background: #1d4ed8;
        }

        /* Features Section */
        .features-section {
            padding: 80px 20px;
            background: #f8fafc;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .feature-item {
            text-align: center;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            margin: 0 auto 20px;
        }

        .feature-title {
            font-size: 20px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .feature-description {
            color: #64748b;
            line-height: 1.6;
        }

        /* CTA Section */
        .cta-section {
            padding: 80px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
        }

        .cta-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .cta-description {
            font-size: 18px;
            margin-bottom: 40px;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-cta {
            background: white;
            color: #1e40af;
            padding: 16px 32px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.3s;
        }

        .btn-cta:hover {
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            background: #1e293b;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
        }

        .footer-links a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #334155;
            padding-top: 20px;
            color: #64748b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav {
                padding: 0 15px;
                height: 60px;
            }

            .nav-links {
                gap: 15px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero p {
                font-size: 16px;
            }

            .search-form {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .centers-grid {
                grid-template-columns: 1fr;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .footer-links {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <div class="logo">
                <i class="fas fa-futbol"></i> Pichangaya
            </div>
            <div class="nav-links">
                <a href="#home">Inicio</a>
                <a href="#centros">Centros</a>
                <a href="#como-funciona">Cómo Funciona</a>
                @auth
                    <a href="{{ route('centros.index') }}">Mis Reservas</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-nav btn-login">Cerrar Sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-nav btn-login">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="btn-nav btn-register">Registrarse</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Reserva tu Cancha Deportiva en Segundos</h1>
            <p>Encuentra y reserva canchas de fútbol, vóley, básquet y más en los mejores centros deportivos de tu ciudad.</p>
        </div>
    </section>

    <!-- Search Section -->
    <section class="search-section">
        <form class="search-form" id="searchForm">
            <div class="form-group">
                <label for="busqueda">¿Qué buscas?</label>
                <input type="text" id="busqueda" placeholder="Ej: Canchas de fútbol en Lima" required>
            </div>
            <div class="form-group">
                <label for="deporte">Deporte</label>
                <select id="deporte">
                    <option value="">Todos los deportes</option>
                    <option value="futbol">Fútbol</option>
                    <option value="voley">Vóley</option>
                    <option value="basket">Básquet</option>
                    <option value="tenis">Tenis</option>
                    <option value="padel">Pádel</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" min="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="hora">Hora</label>
                <select id="hora">
                    <option value="">Cualquier hora</option>
                    <option value="08:00">08:00 - 10:00</option>
                    <option value="10:00">10:00 - 12:00</option>
                    <option value="14:00">14:00 - 16:00</option>
                    <option value="16:00">16:00 - 18:00</option>
                    <option value="18:00">18:00 - 20:00</option>
                    <option value="20:00">20:00 - 22:00</option>
                </select>
            </div>
            <button type="submit" class="btn-search">
                <i class="fas fa-search"></i>Buscar
            </button>
        </form>

        <div class="filters">
            <div class="filter-tags">
                <span class="filter-tag active" data-filter="todos">Todos</span>
                <span class="filter-tag" data-filter="cerca">Cerca de mí</span>
                <span class="filter-tag" data-filter="barato">Precio bajo</span>
                <span class="filter-tag" data-filter="premium">Premium</span>
                <span class="filter-tag" data-filter="nuevo">Nuevos</span>
            </div>

            <div class="filter-options">
                <label class="filter-option">
                    <input type="checkbox" id="techado"> Techado
                </label>
                <label class="filter-option">
                    <input type="checkbox" id="iluminacion"> Con iluminación
                </label>
                <label class="filter-option">
                    <input type="checkbox" id="estacionamiento"> Estacionamiento
                </label>
                <label class="filter-option">
                    <input type="checkbox" id="duchas"> Duchas
                </label>
            </div>
        </div>
    </section>

    <!-- Featured Centers -->
    <section class="featured-section" id="centros">
        <div class="container">
            <h2 class="section-title">Centros Destacados</h2>
            <div class="centers-grid" id="centersGrid">
                <!-- Centers will be loaded dynamically -->
                <div class="center-card">
                    <div class="center-image">
                        <i class="fas fa-futbol"></i>
                    </div>
                    <div class="center-content">
                        <h3 class="center-name">Complejo Deportivo Los Olivos</h3>
                        <div class="center-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Los Olivos, Lima
                        </div>
                        <div class="center-features">
                            <span class="center-feature">
                                <i class="fas fa-users"></i> Fútbol 5/7
                            </span>
                            <span class="center-feature">
                                <i class="fas fa-clock"></i> 24/7
                            </span>
                        </div>
                        <div class="center-price">Desde S/ 50/hora</div>
                        <a href="{{ route('centros.index') }}" class="btn-book">Ver Disponibilidad</a>
                    </div>
                </div>

                <div class="center-card">
                    <div class="center-image">
                        <i class="fas fa-volleyball-ball"></i>
                    </div>
                    <div class="center-content">
                        <h3 class="center-name">Centro Vóley San Miguel</h3>
                        <div class="center-location">
                            <i class="fas fa-map-marker-alt"></i>
                            San Miguel, Lima
                        </div>
                        <div class="center-features">
                            <span class="center-feature">
                                <i class="fas fa-users"></i> Vóley
                            </span>
                            <span class="center-feature">
                                <i class="fas fa-shower"></i> Duchas
                            </span>
                        </div>
                        <div class="center-price">Desde S/ 40/hora</div>
                        <a href="{{ route('centros.index') }}" class="btn-book">Ver Disponibilidad</a>
                    </div>
                </div>

                <div class="center-card">
                    <div class="center-image">
                        <i class="fas fa-basketball-ball"></i>
                    </div>
                    <div class="center-content">
                        <h3 class="center-name">Polideportivo Miraflores</h3>
                        <div class="center-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Miraflores, Lima
                        </div>
                        <div class="center-features">
                            <span class="center-feature">
                                <i class="fas fa-users"></i> Básquet
                            </span>
                            <span class="center-feature">
                                <i class="fas fa-car"></i> Parking
                            </span>
                        </div>
                        <div class="center-price">Desde S/ 60/hora</div>
                        <a href="{{ route('centros.index') }}" class="btn-book">Ver Disponibilidad</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="como-funciona">
        <div class="container">
            <h2 class="section-title">¿Cómo Funciona?</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="feature-title">1. Busca tu Cancha</h3>
                    <p class="feature-description">
                        Utiliza nuestro buscador avanzado para encontrar canchas disponibles
                        por deporte, ubicación, fecha y hora.
                    </p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="feature-title">2. Reserva Online</h3>
                    <p class="feature-description">
                        Selecciona los slots de tiempo que necesitas y reserva al instante
                        con pago seguro online.
                    </p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <h3 class="feature-title">3. Disfruta tu Partido</h3>
                    <p class="feature-description">
                        Presenta tu código QR en el centro deportivo y disfruta
                        de tu actividad deportiva sin complicaciones.
                    </p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="feature-title">4. Califica y Repite</h3>
                    <p class="feature-description">
                        Después de tu reserva, califica el centro y las instalaciones
                        para ayudar a otros usuarios.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">¿Listo para Reservar tu Próxima Cancha?</h2>
            <p class="cta-description">
                Únete a miles de deportistas que ya confían en Pichangaya para sus reservas deportivas.
                ¡Es rápido, seguro y conveniente!
            </p>
            @auth
                <a href="{{ route('centros.index') }}" class="btn-cta">Ver Centros Disponibles</a>
            @else
                <a href="{{ route('register') }}" class="btn-cta">Crear Cuenta Gratis</a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <i class="fas fa-futbol"></i> Pichangaya
                </div>
                <div class="footer-links">
                    <a href="#home">Inicio</a>
                    <a href="#centros">Centros</a>
                    <a href="#como-funciona">Cómo Funciona</a>
                    <a href="{{ route('register') }}">Registrarse</a>
                    <a href="{{ route('login') }}">Iniciar Sesión</a>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2026 Pichangaya. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // JavaScript para la funcionalidad de búsqueda y filtros
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchForm');
            const filterTags = document.querySelectorAll('.filter-tag');

            // Manejar envío del formulario de búsqueda
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(searchForm);
                const searchParams = new URLSearchParams();

                for (let [key, value] of formData.entries()) {
                    if (value.trim() !== '') {
                        searchParams.append(key, value);
                    }
                }

                // Redirigir a la página de centros con parámetros de búsqueda
                const searchUrl = '{{ route("centros.index") }}?' + searchParams.toString();
                window.location.href = searchUrl;
            });

            // Manejar filtros por tags
            filterTags.forEach(tag => {
                tag.addEventListener('click', function() {
                    // Remover clase active de todos los tags
                    filterTags.forEach(t => t.classList.remove('active'));
                    // Agregar clase active al tag clickeado
                    this.classList.add('active');

                    // Aquí se podría implementar filtrado dinámico
                    console.log('Filtro seleccionado:', this.dataset.filter);
                });
            });

            // Animación de fade-in para las cards
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Aplicar animación a las cards de centros
            document.querySelectorAll('.center-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Smooth scroll para navegación
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
