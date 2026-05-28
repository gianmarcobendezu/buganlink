<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal de Proveedores</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #0a0510;
        }

        /* LADO IZQUIERDO - WALLPAPER */
        .wallpaper-section {
            width: 50%;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wallpaper-bg {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #1a0a1f 0%, #0f0514 100%);
            /* TU WALLPAPER: Descomenta y agrega tu imagen */
            /* background-image: url('/img/tu-wallpaper.jpg'); */
            background-size: cover;
            background-position: center;
        }

        .wallpaper-overlay {
            position: absolute;
            inset: 0;
            background: rgba(10, 5, 16, 0.4);
        }

        .wallpaper-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            padding: 40px;
        }

        .wallpaper-content h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3rem;
            font-weight: 300;
            letter-spacing: 8px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .wallpaper-content p {
            font-size: 0.85rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            opacity: 0.6;
        }

        /* LADO DERECHO - LOGIN */
        .login-section {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px;
            background: #0a0510;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
        }

        /* LOGO */
        .logo {
            text-align: center;
            margin-bottom: 50px;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #8b2c78 0%, #5a1a4d 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 40px rgba(139, 44, 120, 0.3);
        }

        .logo-circle span {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            color: white;
            font-weight: 300;
        }

        .logo-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            color: white;
            font-weight: 300;
            letter-spacing: 3px;
        }

        .logo-name em {
            color: #8b2c78;
            font-style: normal;
            font-weight: 600;
        }

        .logo-subtitle {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.4);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 5px;
        }

        /* TITULOS */
        .login-title {
            font-size: 1.5rem;
            color: white;
            font-weight: 300;
            margin-bottom: 8px;
            text-align: center;
        }

        .login-subtitle {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.5);
            text-align: center;
            margin-bottom: 40px;
        }

        /* FORMULARIO */
        .form-group {
            margin-bottom: 28px;
        }

        .form-group label {
            display: block;
            font-size: 0.7rem;
            font-weight: 500;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            color: white;
            font-size: 0.95rem;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
        }

        .form-group input::placeholder {
            color: rgba(255,255,255,0.3);
        }

        .form-group input:focus {
            outline: none;
            border-color: #8b2c78;
            background: rgba(139, 44, 120, 0.05);
            box-shadow: 0 0 0 3px rgba(139, 44, 120, 0.1);
        }

        /* OPCIONES */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.6);
            cursor: pointer;
        }

        .remember input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #8b2c78;
            cursor: pointer;
        }

        .forgot-link {
            font-size: 0.85rem;
            color: #8b2c78;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .forgot-link:hover {
            opacity: 0.7;
        }

        /* BOTON */
        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #8b2c78 0%, #6b235f 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(139, 44, 120, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(139, 44, 120, 0.4);
        }

        /* ERROR */
        .error-message {
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.3);
            color: #fca5a5;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 28px;
        }

        /* FOOTER */
        .login-footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.75rem;
            color: rgba(255,255,255,0.3);
        }

        /* RESPONSIVE */
        @media (max-width: 968px) {
            .wallpaper-section { display: none; }
            .login-section { width: 100%; padding: 40px 30px; }
        }
    </style>
</head>
<body>

    <!-- WALLPAPER SECTION -->
    <div class="wallpaper-section">
        <div class="wallpaper-bg"></div>
        <div class="wallpaper-overlay"></div>
        <div class="wallpaper-content">
            <h2>Proveedores</h2>
            <p>Buganvilla Tours</p>
        </div>
    </div>

    <!-- LOGIN SECTION -->
    <div class="login-section">
        <div class="login-container">
            
            <!-- LOGO -->
            <div class="logo">
                <div class="logo-circle">
                    <span>b</span>
                </div>
                <div class="logo-name">Bugan<em>link</em></div>
                <div class="logo-subtitle">Portal de Proveedores</div>
            </div>

            <!-- TITULOS -->
            <h1 class="login-title">Bienvenido</h1>
            <p class="login-subtitle">Ingresa tus credenciales para continuar</p>

            <!-- ERRORES -->
            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- FORMULARIO -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" 
                           value="{{ old('email') }}" 
                           placeholder="nombre@empresa.com"
                           required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" 
                           placeholder="••••••••"
                           required>
                </div>

                <div class="form-options">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        <span>Recordarme</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-login">
                    Ingresar al Portal
                </button>
            </form>

            <!-- FOOTER -->
            <div class="login-footer">
                Buganvilla Tours
            </div>

        </div>
    </div>

</body>
</html>