<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts (opcional, moderno) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #fff !important;
            min-height: 100vh;
            font-family: 'Montserrat', Arial, sans-serif;
        }
        .ego-card {
            background: #fff;
            border-radius: 24px;
            /* Sombra difuminada y notoria en todo el contorno */
            box-shadow: 1px 16px 48px 0 rgba(0, 0, 0, 0.22), 1px 2px 32px 0 rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: box-shadow 0.3s;
        }
        .ego-side {
            background: #c9bcff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 470px;
        }
        .ego-side img {
            width: 120px;
            margin-bottom: 24px;
        }
        .ego-title {
            color: #6358DC;
            font-weight: 700;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        .ego-subtitle {
            color: #444;
            font-size: 1.5rem;
            margin-top: 8px;
            margin-bottom: 0;
            font-weight: 500;
        }
        .ego-btn-group {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
        }
        .ego-btn-radio {
            flex: 1;
            border-radius: 999px !important;
            background: #ede7fe;
            color: #6358DC;
            border: none;
            font-weight: 600;
            box-shadow: none;
            padding: 8px 0;
            transition: background .2s;
        }
        .ego-btn-radio.active {
            background: #6358DC;
            color: #fff;
        }
        .ego-form-input {
            border-radius: 10px;
            background: #f5f5f8;
            border: none;
            box-shadow: 0 2px 8px rgba(99,88,220,0.08);
            margin-bottom: 18px;
            padding: 12px 14px;
        }
        .ego-form-input:focus {
            border: 1.5px solid #6358DC;
            outline: none;
            background: #f9f7fd;
        }
        .ego-btn-main {
            border-radius: 999px;
            background: linear-gradient(90deg, #6358DC 40%, #8b7cff 100%);
            color: #fff;
            font-weight: 700;
            box-shadow: 0 4px 12px 0 rgba(99,88,220,0.09);
            margin-top: 18px;
            margin-bottom: 8px;
            border: none;
        }
        .ego-btn-main:hover {
            background: linear-gradient(90deg, #4e3ea1 0%, #6358DC 100%);
            color: #fff;
        }
        .ego-btn-facebook {
            border-radius: 999px;
            background: #1877f2;
            color: #fff;
            font-weight: 700;
            margin-bottom: 8px;
            border: none;
        }
        .ego-btn-facebook:hover {
            background: #1456b7;
            color: #fff;
        }
        .ego-form-link {
            color: #6358DC;
            text-decoration: none;
            font-weight: 600;
        }
        .ego-form-link:hover {
            text-decoration: underline;
        }
        @media (max-width: 991.98px) {
            .ego-card {
                flex-direction: column !important;
                min-width: 320px;
            }
            .ego-side {
                border-radius: 22px 22px 0 0;
                min-height: 200px;
                padding: 32px 0 !important;
            }
        }
    </style>
</head>
<body>
    <main>
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
