<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-GO Landing Page</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --main-purple: #7764e4;
            --main-yellow: #ffd935;
            --main-bg: #f4f3fd;
            --soft-purple: #e4e0fa;
            --section-bg: #edeaff;
            --grey: #f8f8f8;
            --text-dark: #423e72;
            --text-light: #938fc2;
        }
        html, body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', Arial, sans-serif;
            background: var(--main-bg);
            color: var(--text-dark);
        }
        body {
            overflow-x: hidden;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        .landing-main {
            width: 100vw;
            min-height: 100vh;
        }

        /* --- HEADER HERO --- */
        .hero {
            background: linear-gradient(145deg, #fff 70%, var(--soft-purple) 100%);
            position: relative;
            overflow: hidden;
            padding: 0;
            min-height: 520px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-content {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px 0 0 0;
        }
        .hero-left {
            flex: 1 1 45%;
            padding-left: 60px;
            z-index: 2;
        }
        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 36px;
        }
        .logo-icon {
            width: 54px;
            margin-right: 12px;
        }
        .logo-text {
            font-size: 2.1rem;
            color: var(--main-purple);
            font-weight: 700;
            letter-spacing: 1px;
        }
        .hero-title {
            font-size: 2.7rem;
            font-weight: 700;
            color: var(--main-purple);
            margin-bottom: 8px;
        }
        .hero-subtitle {
            font-size: 2.1rem;
            font-weight: 400;
            color: var(--text-light);
            margin-bottom: 8px;
        }
        .hero-subtitle .highlight {
            color: var(--main-purple);
            font-weight: 700;
            border-bottom: 5px solid var(--main-yellow);
            padding-bottom: 2px;
        }
        .hero-btn {
            background: var(--main-purple);
            color: #fff;
            font-weight: 700;
            font-size: 1.08rem;
            padding: 16px 36px;
            border: none;
            border-radius: 7px;
            box-shadow: 0 2px 14px #7764e455;
            margin-top: 32px;
            transition: background 0.2s;
            cursor: pointer;
            letter-spacing: 1px;
            display: inline-block;
        }
        .hero-btn:hover {
            background: #5e4cbb;
        }
        .hero-right {
            flex: 1 1 55%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            height: 420px;
        }
        .hero-img-bg {
            position: absolute;
            top: 25px;
            right: 12%;
            width: 370px;
            height: 370px;
            background: var(--main-purple);
            border-radius: 45% 55% 65% 35% / 60% 40% 60% 40%;
            z-index: 1;
            opacity: 0.28;
        }
        .hero-img-wrap {
            position: relative;
            z-index: 2;
            width: 340px;
            height: 340px;
            border-radius: 48% 52% 60% 40% / 60% 40% 50% 50%;
            overflow: hidden;
            border: 3px dashed var(--main-purple);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-img-wrap img {
            width: 110%;
            height: 100%;
            object-fit: cover;
        }
        .socials {
            position: absolute;
            top: 32px;
            right: 48px;
            display: flex;
            gap: 20px;
            z-index: 9;
        }
        .socials a {
            color: var(--main-purple);
            font-size: 1.44rem;
            opacity: 0.74;
            transition: opacity .2s;
        }
        .socials a:hover {
            opacity: 1;
        }

        /* --- SECTION: WHAT WE DO --- */
        .section-what {
            width: 100%;
            background: var(--soft-purple);
            padding: 0 0 70px 0;
            position: relative;
            margin-top: -30px;
        }
        .section-what .top-shape {
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: 110px;
            background: #fff;
            border-bottom-left-radius: 120px;
            border-bottom-right-radius: 90px;
        }
        .what-inner {
            max-width: 1080px;
            margin: 0 auto;
            padding: 70px 40px 0 40px;
        }
        .what-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--main-purple);
            margin-bottom: 8px;
        }
        .what-subtitle {
            font-size: 1.28rem;
            color: var(--text-light);
            margin-bottom: 36px;
        }
        .what-subtitle .highlight {
            color: var(--main-yellow);
            font-weight: 700;
        }
        .what-cards {
            display: flex;
            gap: 24px;
            margin-bottom: 24px;
        }
        .what-card {
            flex: 1 1 0;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 12px #7764e41c;
            padding: 30px 24px 26px 24px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            min-width: 210px;
            min-height: 120px;
        }
        .what-card .icon {
            font-size: 2rem;
            color: var(--main-purple);
            margin-bottom: 12px;
        }
        .what-card-title {
            font-weight: 700;
            margin-bottom: 7px;
            color: var(--main-purple);
            font-size: 1.07rem;
        }
        .what-card-desc {
            font-size: 1rem;
            color: var(--text-light);
        }
        .slider-controls {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }
        .slider-btn {
            width: 30px;
            height: 30px;
            background: #fff;
            border: 2px solid var(--main-purple);
            border-radius: 50%;
            color: var(--main-purple);
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: .62;
            transition: opacity .2s;
        }
        .slider-btn:hover {
            opacity: 1;
        }

        /* --- SECTION: IMPROVE ENTREPRENEURSHIP --- */
        .section-improve {
            background: #fff;
            padding: 110px 0 0 0;
            position: relative;
        }
        .improve-inner {
            max-width: 1080px;
            margin: 0 auto;
            display: flex;
            gap: 50px;
            align-items: center;
            padding: 0 40px;
        }
        .improve-img-bg {
            position: relative;
            width: 370px;
            height: 370px;
            background: var(--main-purple);
            border-radius: 58% 42% 50% 50% / 60% 40% 50% 50%;
            opacity: 0.29;
            top: 36px;
            left: 28px;
            z-index: 1;
        }
        .improve-img-wrap {
            position: absolute;
            top: 0;
            left: 0;
            width: 340px;
            height: 340px;
            border-radius: 51% 49% 53% 47% / 48% 52% 52% 48%;
            overflow: hidden;
            border: 3px dashed var(--main-purple);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }
        .improve-img-wrap img {
            width: 110%;
            height: 100%;
            object-fit: cover;
        }
        .improve-img-cont {
            position: relative;
            width: 370px;
            height: 370px;
            min-width: 370px;
        }
        .improve-content {
            flex: 1 1 0;
            padding-left: 38px;
            padding-top: 38px;
        }
        .improve-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--main-purple);
            margin-bottom: 8px;
        }
        .improve-title .highlight {
            color: var(--main-yellow);
            border-bottom: 4px solid var(--main-yellow);
            font-weight: 700;
            padding-bottom: 2px;
        }
        .improve-desc {
            font-size: 1.07rem;
            color: var(--text-light);
            margin-top: 10px;
            line-height: 1.6;
            max-width: 480px;
        }

        /* --- SECTION: FEATURES (NO SCROLL, 3 CARDS) --- */
        .section-features {
            background: var(--soft-purple);
            padding: 80px 0 0 0;
            position: relative;
        }
        .features-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 36px;
        }
        .features-row {
            display: flex;
            gap: 32px;
            justify-content: center;
            align-items: stretch;
            margin-top: 18px;
        }
        .feature-card {
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 2px 14px #7764e422;
            padding: 18px 20px 18px 20px;
            width: 340px;
            min-width: 270px;
            max-width: 350px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .feature-img {
            width: 100%;
            height: 130px;
            object-fit: cover;
            background: #eee;
            border-radius: 12px;
            margin-bottom: 16px;
        }
        .feature-title {
            font-size: 1.13rem;
            font-weight: 700;
            color: var(--main-purple);
            margin-bottom: 8px;
        }
        .feature-desc {
            color: var(--text-light);
            font-size: 1rem;
        }
        @media (max-width: 1150px) {
            .features-row {
                flex-direction: column;
                gap: 25px;
                align-items: center;
            }
            .feature-card {
                width: 95vw;
                max-width: 400px;
            }
        }

        /* --- SECTION: TESTIMONIALS --- */
        .section-testimonials {
            background: #fff;
            padding: 68px 0 0 0;
            min-height: 380px;
        }
        .testimonials-inner {
            max-width: 1080px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            flex-direction: column;
        }
        .testimonials-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--main-purple);
            margin-bottom: 8px;
        }
        .testimonials-subtitle {
            font-size: 1.28rem;
            color: var(--text-light);
            margin-bottom: 36px;
        }
        .testimonials-subtitle .highlight {
            color: var(--main-yellow);
            font-weight: 700;
            border-bottom: 4px solid var(--main-yellow);
            padding-bottom: 2px;
        }
        .testimonials-cards {
            display: flex;
            gap: 25px;
            justify-content: flex-start;
            align-items: stretch;
        }
        .testimonial-card {
            background: #fff;
            border: 1.5px solid #ece8fc;
            border-radius: 13px;
            padding: 34px 22px 34px 22px;
            box-shadow: 0 2px 14px #7764e41c;
            min-width: 260px;
            flex: 1 1 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .testimonial-quote {
            font-size: 2.7rem;
            color: var(--main-yellow);
            font-weight: 700;
            margin-bottom: 8px;
        }
        .testimonial-text {
            font-size: 1rem;
            color: var(--text-dark);
            margin-bottom: 18px;
        }
        .testimonial-author {
            font-size: 0.96rem;
            color: var(--main-purple);
            font-weight: 700;
        }
        /* --- FOOTER / BOTTOM --- */
        .footer {
            background: var(--soft-purple);
            min-height: 120px;
            margin-top: 90px;
        }

        /* --- Responsive --- */
        @media (max-width: 1050px) {
            .hero-content, .improve-inner, .testimonials-inner, .features-inner {
                flex-direction: column;
                padding: 0 18px;
            }
            .hero-right, .improve-img-cont {
                margin: 0 auto;
            }
            .hero-left, .improve-content {
                padding: 0;
                text-align: center;
            }
        }
        @media (max-width: 800px) {
            .what-cards, .testimonials-cards, .features-row {
                flex-direction: column;
                gap: 18px;
            }
            .hero-content {
                flex-direction: column-reverse;
            }
            .hero-right, .improve-img-cont {
                width: 95vw;
                height: 210px;
            }
            .hero-img-bg, .improve-img-bg {
                width: 210px;
                height: 210px;
            }
            .hero-img-wrap, .improve-img-wrap {
                width: 180px;
                height: 180px;
            }
        }
        @media (max-width: 600px) {
            .hero-title { font-size: 1.38rem; }
            .hero-subtitle { font-size: 1.1rem; }
            .what-title, .improve-title, .testimonials-title { font-size: 1.2rem; }
            .testimonials-subtitle, .what-subtitle { font-size: .99rem; }
            .improve-title { padding-top: 0; }
            .testimonials-cards, .what-cards, .features-row {
                flex-direction: column;
                gap: 20px;
            }
            .what-inner, .testimonials-inner, .features-inner {
                padding: 0 6px;
            }
        }
    </style>
    <!-- ICONS: FontAwesome CDN -->
    <script src="https://kit.fontawesome.com/6e0c7d7e3b.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="landing-main">

        <!-- HERO HEADER -->
        <section class="hero">
            <div class="socials">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="hero-content">
                <div class="hero-left">
                    <div class="logo">
                        <img src="/assets/images/E-GO_LOGO.png" alt="E-GO Logo" class="logo-icon">
                        <span class="logo-text">E-GO</span>
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
                <div class="slider-controls">
                    <button class="slider-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="slider-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

        <!-- IMPROVE ENTREPRENEURSHIP -->
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
                        Mejora <span class="highlight">Tu</span> <br>
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
        <div class="footer"></div>
    </div>
</body>
</html>
