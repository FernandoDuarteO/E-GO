<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-GO Landing Page</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
    <!-- Font Awesome CDN para ICONOS -->
    <script src="https://kit.fontawesome.com/6e0c7d7e3b.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="landing-main">

        <!-- HERO HEADER -->
        <section class="hero">
            <div class="hero-content">
                <div class="hero-left">
                    <div class="logo">
                        <img src="/assets/images/E-GO_LOGO.png" alt="E-GO Logo" class="logo-icon">
                    </div>
                    <div class="hero-title">Te ayudamos</div>
                    <div class="hero-subtitle">
                        a hacer crecer<br>
                        <span class="highlight">tu negocio</span>
                    </div>
                    <a href="{{ route('register') }}" class="hero-btn">COMENZAR AHORA</a>
                </div>
                <div class="hero-right">
                    <div class="hero-img-bg"></div>
                    <div class="hero-img-wrap">
                        <img src="/assets/images/5.png" alt="Imagen negocio">
                    </div>
                </div>
            </div>
        </section>

        <!-- WHAT WE DO -->
        <section class="section-what">
            <div class="top-shape"></div>
            <div class="what-inner">
                <div class="what-title">Lo que hacemos</div>
                <div class="what-subtitle">Por su <span class="highlight">negocio</span></div>
                <div class="what-cards">
                    <div class="what-card">
                        <div class="icon"><i class="fas fa-globe-americas"></i></div>
                        <div class="what-card-title">VENTAS NACIONALES</div>
                        <div class="what-card-desc">
                            Tu tienda no tendrá fronteras. Le damos visión a tus productos a clientes en cualquier lugar del país.
                        </div>
                    </div>
                    <div class="what-card">
                        <div class="icon"><i class="fas fa-store"></i></div>
                        <div class="what-card-title">CREA TU TIENDA ONLINE</div>
                        <div class="what-card-desc">
                            Creamos tu tienda virtual desde cero. Lista para vender. Solo sube tus productos y comienza a generar ingresos.
                        </div>
                    </div>
                    <div class="what-card">
                        <div class="icon"><i class="fas fa-tools"></i></div>
                        <div class="what-card-title">SOPORTE Y GESTIÓN</div>
                        <div class="what-card-desc">
                            Mantenemos tu tienda funcionando sin problemas. Te facilitamos la gestión de inventario y atención al cliente.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- IMPROVE ENTREPRENEURSHIP (CIRCULAR BG AND IMG INSIDE WHITE BAND) -->
        <section class="section-improve">
            <div class="improve-inner">
                <div class="improve-img-cont">
                    <div class="improve-img-bg"></div>
                    <div class="improve-img-wrap">
                        <img src="/assets/images/1.png" alt="Imagen emprendedores">
                    </div>
                </div>
                <div class="improve-content">
                    <div class="improve-title">
                        Mejora <span class="highlight">Tu</span><br>
                        manera de emprender
                    </div>
                    <div class="improve-desc">
                        Brindamos un espacio digital compartido donde pequeños y medianos negocios pueden mostrar y vender sus productos. Permitiendo mayor visibilidad, acceso a clientes fuera de su zona local y fomentar la colaboración entre emprendedores, impulsa la innovación y facilita el crecimiento gracias al uso de herramientas digitales que optimizan el proceso.
                    </div>
                </div>
            </div>
        </section>

        <!-- FEATURES (NO SCROLL, SOLO 3 TARJETAS, MÁRGENES CUIDADOS) -->
        <section class="section-features">
            <div class="features-inner">
                <div class="features-row">
                    <div class="feature-card">
                        <img class="feature-img" src="/assets/images/2.png" alt="Funcionalidad 1">
                        <div class="feature-title">Cursos para ti</div>
                        <div class="feature-desc">Capacítate y mejora tus habilidades emprendedoras con nuestros cursos exclusivos.</div>
                    </div>
                    <div class="feature-card">
                        <img class="feature-img" src="/assets/images/3.png" alt="Funcionalidad 2">
                        <div class="feature-title">Chats y soporte</div>
                        <div class="feature-desc">Atiende a tus clientes en tiempo real y gestiona tus pedidos de forma sencilla.</div>
                    </div>
                    <div class="feature-card">
                        <img class="feature-img" src="/assets/images/4.png" alt="Funcionalidad 3">
                        <div class="feature-title">Emprendimientos destacados de E-GO</div>
                        <div class="feature-desc">Descubre historias de éxito y cómo otros han crecido con nuestra plataforma.</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TESTIMONIALS -->
        <section class="section-testimonials">
            <div class="testimonials-inner">
                <div class="testimonials-title">Nuestros testimonios</div>
                <div class="testimonials-subtitle">
                    Lo que dicen nuestros <span class="highlight">clientes</span>
                </div>
                <div class="testimonials-cards">
                    <div class="testimonial-card">
                        <div class="testimonial-quote"><i class="fas fa-quote-left"></i></div>
                        <div class="testimonial-text">
                            Gracias a esta app, ahora puedo llevar el control de mis pedidos sin estrés. <br>
                            ¡Me ha simplificado la vida!
                        </div>
                        <div class="testimonial-author">— Ana’s Cakes</div>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-quote"><i class="fas fa-quote-left"></i></div>
                        <div class="testimonial-text">
                            Antes usaba una libreta, pero ahora todo lo tengo en mi teléfono. Me llegan notificaciones y es genial. ¡Me encanta!
                        </div>
                        <div class="testimonial-author">— K-Boutique</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
<footer class="footer">
    <div class="footer-left">
        © 2025 Todos los derechos reservados
    </div>
    <div class="footer-right">
        <!-- Instagram -->
        <a href="https://www.instagram.com/e_go_of" target="_blank" rel="noopener noreferrer" title="Instagram" aria-label="Instagram">
            <svg width="28" height="28" viewBox="0 0 48 48" fill="none">
                <rect x="9" y="9" width="30" height="30" rx="9" stroke="#fff" stroke-width="3"/>
                <circle cx="24" cy="24" r="7" stroke="#fff" stroke-width="3"/>
                <circle cx="32.5" cy="15.5" r="2.5" fill="#fff"/>
            </svg>
        </a>
        <!-- GitHub -->
        <a href="https://github.com/FernandoDuarteO/E-GO" target="_blank" rel="noopener noreferrer" title="GitHub" aria-label="GitHub">
            <svg width="28" height="28" viewBox="0 0 1024 1024" fill="none">
                <path fill="#fff" d="M511.6 76.3C266.5 76.3 64 278.9 64 524c0 197.7 128 365.5 305.4 424.8 22.3 4.2 30.5-9.7 30.5-21.5 0-10.6-.4-45.6-.6-82.7-124.3 27-150.6-60-150.6-60-20.2-51.3-49.3-65-49.3-65-40.3-27.6 3-27.1 3-27.1 44.6 3.1 68 45.8 68 45.8 39.7 68 104.2 48.4 129.6 37 .8-28.8 15.5-48.5 28.2-59.7-99.3-11.3-203.7-49.7-203.7-221.3 0-48.9 17.5-88.9 46.1-120.3-4.6-11.3-20-56.9 4.4-118.7 0 0 37.6-12 123.2 45.9 35.7-9.9 74-14.9 112.1-15.1 38 .2 76.4 5.2 112.1 15.1 85.5-57.9 123-45.9 123-45.9 24.5 61.8 9.1 107.4 4.4 118.7 28.6 31.4 46 71.4 46 120.3 0 171.9-104.6 209.9-204.1 221.1 15.9 13.6 30 40.5 30 81.7 0 59-.5 106.7-.5 121.3 0 11.9 8 25.9 30.7 21.5C832 889.3 960 721.6 960 524 960 278.9 757.5 76.3 511.6 76.3z"/>
            </svg>
        </a>
        <!-- Facebook -->
        <a href="https://www.facebook.com/profile.php?id=61579312211339&locale=es_LA" target="_blank" rel="noopener noreferrer" title="Facebook" aria-label="Facebook">
            <svg width="28" height="28" viewBox="0 0 50 50" fill="none">
                <rect width="50" height="50" rx="10" fill="none"/>
                <path d="M32 25h-4v12h-5V25h-3v-4h3v-2.8C23 16.1 25.2 14 28.4 14 29.9 14 31.1 14.1 31.5 14.2v4.2h-2.2c-1.4 0-1.8.7-1.8 1.7V21h4.2l-.5 4z" fill="#fff"/>
            </svg>
        </a>
    </div>
</footer>
    </div>
</body>
</html>
