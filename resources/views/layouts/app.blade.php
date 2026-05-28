<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Buganlink') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #f0f2f5;
            --surface: #fff;
            --surface2: #f8f9fb;
            --border: #e2e6ea;
            --primary: #1a56db;
            --primary-light: #e8f0fe;
            --primary-dark: #1240b0;
            --text: #1a202c;
            --text-muted: #6b7280;
            --text-light: #9ca3af;
            --danger: #dc3545;
            --shadow-sm: 0 1px 3px rgba(0,0,0,.08);
            --shadow-lg: 0 8px 32px rgba(0,0,0,.13);
            --radius: 12px;
            --radius-sm: 8px;
            --sidebar-w: 260px;
            --topbar-h: 60px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── OVERLAY MOBILE ── */
        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 199;
        }
        #sidebar-overlay.show { display: block; }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            /*background: #0f172a;*/
            background: #ffffff;
border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 200;
            transition: transform .28s cubic-bezier(.4,0,.2,1);
        }

      

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }
        .sidebar-logo .logo-icon {
            width: 36px; height: 36px;
            background: var(--primary);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 700; color: white;
            flex-shrink: 0;
        }
        .sidebar-logo .logo-text {
            font-size: 16px; font-weight: 700;
            color: white; letter-spacing: -.2px;
        }
        .sidebar-logo .logo-sub {
            font-size: 11px; color: rgba(255,255,255,.4);
            margin-top: 1px;
        }

        /* NAV */
        .sidebar-nav {
            flex: 1;
            padding: 14px 12px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .nav-label {
            font-size: 10px;
            font-weight: 700;
            color: rgba(255,255,255,.25);
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 10px 8px 6px;
            margin-top: 6px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 9px;
            color: rgba(255,255,255,.6);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all .15s;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }
        .nav-item:hover {
            background: rgba(255,255,255,.07);
            color: white;
        }
        .nav-item.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(26,86,219,.35);
        }
        .nav-item .nav-icon {
            width: 20px; height: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; flex-shrink: 0;
        }
        .nav-item .nav-badge {
            margin-left: auto;
            background: rgba(255,255,255,.15);
            color: rgba(255,255,255,.8);
            font-size: 10px; font-weight: 700;
            padding: 2px 7px; border-radius: 999px;
        }
        .nav-item.active .nav-badge {
            background: rgba(255,255,255,.25);
        }

        /* SIDEBAR BOTTOM */
        .sidebar-bottom {
            padding: 12px;
            border-top: 1px solid rgba(255,255,255,.07);
        }
        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 9px;
            cursor: pointer;
            transition: background .15s;
        }
        .user-card:hover { background: rgba(255,255,255,.07); }
        .user-avatar {
            width: 34px; height: 34px;
            background: var(--primary);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700; color: white;
            flex-shrink: 0;
        }
        .user-info { flex: 1; overflow: hidden; }
        .user-name {
            font-size: 13px; font-weight: 600; color: white;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .user-role {
            font-size: 11px; color: rgba(255,255,255,.4);
            margin-top: 1px;
        }
        .user-chevron { color: rgba(255,255,255,.3); font-size: 12px; }

        /* LOGOUT */
        .nav-item.logout {
            color: rgba(220,53,69,.7);
            margin-top: 4px;
        }
        .nav-item.logout:hover {
            background: rgba(220,53,69,.12);
            color: #dc3545;
        }

        /* ── TOPBAR ── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 100;
            box-shadow: var(--shadow-sm);
        }
        .topbar-left {
            display: flex; align-items: center; gap: 12px;
        }
        #menu-toggle {
            display: none;
            background: none; border: none;
            font-size: 20px; cursor: pointer;
            color: var(--text-muted); padding: 4px;
        }
        .topbar-title {
            font-size: 15px; font-weight: 600; color: var(--text);
        }
        .topbar-right {
            display: flex; align-items: center; gap: 8px;
        }
        .topbar-btn {
            display: flex; align-items: center; gap: 6px;
            padding: 7px 14px;
            border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 500;
            border: 1.5px solid var(--border);
            background: transparent;
            color: var(--text-muted);
            cursor: pointer;
            text-decoration: none;
            transition: all .15s;
        }
        .topbar-btn:hover {
            background: var(--bg);
            color: var(--text);
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            margin-left: var(--sidebar-w);
            margin-top: var(--topbar-h);
            padding: 28px 28px 60px;
            min-height: calc(100vh - var(--topbar-h));
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(calc(-1 * var(--sidebar-w)));
            }
            .sidebar.open {
                transform: translateX(0);
                box-shadow: var(--shadow-lg);
            }
            .topbar {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
            #menu-toggle {
                display: flex;
            }
        }


          /** */
          .sidebar-logo .logo-text { color: var(--text); }
.sidebar-logo .logo-sub { color: var(--text-muted); }
.nav-label { color: var(--text-light); }
.nav-item { color: var(--text-muted); }
.nav-item:hover { background: var(--bg); color: var(--text); }
.user-name { color: var(--text); }
.user-role { color: var(--text-muted); }


        /** */

    </style>
</head>
<body>

{{-- OVERLAY MOBILE --}}
<div id="sidebar-overlay" onclick="closeSidebar()"></div>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">

    <div class="sidebar-logo">
        <div class="logo-icon">B</div>
        <div>
            <div class="logo-text">Buganlink</div>
            <div class="logo-sub">Portal de Proveedores</div>
        </div>
    </div>

    <nav class="sidebar-nav">

        <div class="nav-label">Principal</div>

        <a href="{{ route('dashboard') }}"
           class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="nav-icon">🏠</span>
            Dashboard
        </a>
        <a href="#"
        class="nav-item">
        
        
        <a href="{{ route('facturas.index') }}"
           class="nav-item {{ request()->routeIs('facturas.*') ? 'active' : '' }}">
            <span class="nav-icon">🧾</span>
            Facturas
        </a>

        <div class="nav-label">Cuenta</div>

        <a href="#"
           class="nav-item">
            <span class="nav-icon">👤</span>
            Mi Perfil
        </a>

        <a href="#acerca"
           class="nav-item">
            <span class="nav-icon">ℹ️</span>
            Acerca de
        </a>

        <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">
            @csrf
            <button type="submit" class="nav-item logout">
                <span class="nav-icon">🚪</span>
                Cerrar sesión
            </button>
        </form>

    </nav>

    <div class="sidebar-bottom">
        <div class="user-card">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name ?? 'Usuario' }}</div>
                <div class="user-role">Proveedor</div>
            </div>
            <span class="user-chevron">›</span>
        </div>
    </div>

</aside>

{{-- TOPBAR --}}
<header class="topbar">
    <div class="topbar-left">
        <button id="menu-toggle" onclick="toggleSidebar()">☰</button>
        <span class="topbar-title">
            @isset($header)
                {{ $header }}
            @else
                Portal de Proveedores
            @endisset
        </span>
    </div>
    <div class="topbar-right">
        <span style="font-size:13px;color:var(--text-muted);">
            {{ Auth::user()->name ?? '' }}
        </span>
    </div>
</header>

{{-- CONTENIDO PRINCIPAL --}}
<main class="main-content">
    {{ $slot }}
</main>

<script>
    function toggleSidebar() {
        const sidebar  = document.getElementById('sidebar');
        const overlay  = document.getElementById('sidebar-overlay');
        const isOpen   = sidebar.classList.contains('open');
        sidebar.classList.toggle('open', !isOpen);
        overlay.classList.toggle('show', !isOpen);
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebar-overlay').classList.remove('show');
    }
</script>

</body>
</html>