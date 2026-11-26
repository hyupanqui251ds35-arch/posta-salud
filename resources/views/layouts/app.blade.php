<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Inicio') · {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.blue.min.css">
    <style>
        :root {
            --pico-font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            --pico-font-size: 95%;
            --pico-border-radius: 0.5rem;
            --pico-primary: #0369a1;
            --pico-primary-hover: #075985;
            --pico-primary-focus: rgba(3, 105, 161, 0.2);
            --pico-background-color: #f4f7fa;
            --pico-card-background-color: #ffffff;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f4f7fa;
        }

        /* Barra de navegación institucional */
        .topbar {
            background: linear-gradient(135deg, #0c4a6e 0%, #0369a1 100%);
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(12, 74, 110, 0.15);
            margin-bottom: 2rem;
        }

        .topbar nav {
            padding-block: 0.35rem;
        }

        .topbar strong {
            color: #ffffff;
            font-size: 1.1rem;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .topbar a {
            color: #e0f2fe;
            font-weight: 500;
            border-radius: 0.4rem;
            padding: 0.45rem 0.75rem;
            transition: background-color 0.2s, color 0.2s;
        }

        .topbar a:hover,
        .topbar a.activo {
            background-color: rgba(255, 255, 255, 0.16);
            color: #ffffff;
            text-decoration: none;
        }

        main.container {
            flex: 1;
        }

        /* Tarjetas y contenedores */
        article {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.04);
        }

        h1, h2 {
            color: #0f172a;
        }

        /* Tablas clínicas */
        table {
            background: #ffffff;
            border-radius: 0.5rem;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.04);
        }

        thead th {
            background-color: #e0f2fe;
            color: #0c4a6e;
            font-weight: 600;
            border-bottom: 2px solid #bae6fd;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Avisos y estados */
        .aviso-ok {
            background: #ecfdf5;
            border-left: 6px solid #15803d;
            color: #14532d;
        }

        .aviso-error {
            background: #fef2f2;
            border-left: 6px solid #b91c1c;
            color: #7f1d1d;
        }

        .estado-activo {
            background: #dcfce7;
            color: #166534;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .estado-inactivo {
            background: #fee2e2;
            color: #991b1b;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .acciones {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        footer.footer-institucional {
            margin-top: 3rem;
            padding-block: 1.25rem;
            border-top: 1px solid #cbd5e1;
            color: #475569;
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="container">
            <nav>
                <ul>
                    <li>
                        <strong>
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 2a2 2 0 0 0-2 2v5H4a2 2 0 0 0-2 2v2c0 1.1.9 2 2 2h5v5c0 1.1.9 2 2 2h2a2 2 0 0 0 2-2v-5h5a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2h-5V4a2 2 0 0 0-2-2h-2z"/>
                            </svg>
                            {{ config('app.name') }}
                        </strong>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="{{ route('inicio') }}"
                           class="{{ request()->routeIs('inicio') ? 'activo' : '' }}">Inicio</a>
                    </li>
                    <li>
                        <a href="{{ route('pacientes.index') }}"
                           class="{{ request()->routeIs('pacientes.*') ? 'activo' : '' }}">Pacientes</a>
                    </li>
                    <li>
                        <a href="{{ route('personal-medico.index') }}"
                           class="{{ request()->routeIs('personal-medico.*') ? 'activo' : '' }}">Personal médico</a>
                    </li>
                    <li><a href="#">Citas</a></li>
                    <li><a href="#">Atenciones</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        @if (session('ok'))
            <article class="aviso-ok">{{ session('ok') }}</article>
        @endif
        @if (session('error'))
            <article class="aviso-error">{{ session('error') }}</article>
        @endif

        @yield('contenido')
    </main>

    <footer class="footer-institucional">
        <div class="container">
            <small>Sistema Web de la Posta de Salud Comunitaria · DSI406 Tecnología Backend · IES Túpac Amaru</small>
        </div>
    </footer>
</body>
</html>