<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>E-GO Landing Page</title>

    <!-- Fonts & icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6e0c7d7e3b.js" crossorigin="anonymous"></script>

    <!-- Main stylesheet -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="landing-main">

        <!-- HERO -->
        <section class="hero">
            <div class="hero-content">
                <div class="hero-left">
                    <div class="logo">
                        <img src="/assets/images/E-GO_LOGO.png" alt="E-GO Logo" class="logo-icon">
                    </div>

                    <div class="hero-title">Te ayudamos</div>

                    <div class="hero-subtitle">
                        a hacer crecer<br>
                        <span class="hero-underline">tu negocio</span>
                    </div>

                    <a href="{{ route('register') }}" class="hero-btn">COMENZAR AHORA</a>
                </div>

                <div class="hero-right">
                    <div class="hero-img-bg" aria-hidden="true"></div>
                    <div class="hero-img-wrap">
                        <img src="/assets/images/5.png" alt="Imagen negocio">
                    </div>
                </div>
            </div>
        </section>

        <!-- WHAT WE DO -->
        <section class="section-what">
            <div class="top-shape" aria-hidden="true"></div>

            <div class="what-inner">
                <div class="what-title">Lo que hacemos</div>

                <div class="what-subtitle">
                    Por su <span class="subtitle-underline">negocio</span>
                </div>

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

        <!-- IMPROVE -->
        <section class="section-improve">
            <div class="improve-inner">
                <div class="improve-img-cont">
                    <div class="improve-img-bg" aria-hidden="true"></div>
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

        <!-- FEATURES -->
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
                    Lo que dicen nuestros <span class="subtitle-underline">clientes</span>
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
        @include('partials.footer')
    </div>
</body>
</html>