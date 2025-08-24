<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            {{-- Usamos col-md-10 para el contenedor principal de todo el login para dar espacio, y luego 2 columnas internas --}}
            <div class="col-md-10">
                <div class="card shadow-lg border-0 login-card-with-bg"> {{-- Añadimos una clase personalizada aquí --}}
                    <div class="row g-0 h-100"> {{-- Aseguramos que la fila ocupe el 100% de la altura de la tarjeta --}}
                        <!-- La imagen de fondo ahora se aplica a todo el '.login-card-with-bg' -->
                        <!-- Columna del Formulario de Login -->
                        <div class="col-md-6 offset-md-6 p-5 login-form-column"> {{-- Offset para empujar a la derecha --}}
                            <div class="text-center mb-4">
                                <h4 class="text-primary fw-bold">Bienvenido al Módulo EFSRT</h4>
                                <p class="text-dark">Inicia sesión para acceder a tu cuenta</p> {{-- Cambiado a text-dark --}}
                            </div>

                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label for="email" class="form-label text-dark">Email</label> {{-- Cambiado a text-dark --}}
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label text-dark">Contraseña</label> {{-- Cambiado a text-dark --}}
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="mb-3 form-check">
                                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                    <label class="form-check-label text-dark" for="remember_me">Recuérdame</label> {{-- Cambiado a text-dark --}}
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="text-dark text-decoration-none" href="{{ route('password.request') }}"> {{-- Cambiado a text-dark --}}
                                            ¿Olvidaste tu contraseña?
                                        </a>
                                    @endif

                                    <button type="submit" class="btn btn-primary">
                                        Iniciar Sesión
                                    </button>
                                </div>

                                {{-- Enlace al registro si lo tienes activado --}}
                                @if (Route::has('register'))
                                    <div class="text-center mt-3">
                                        <p class="text-dark">¿No tienes cuenta? <a href="{{ route('register') }}" class="text-decoration-none text-primary">Regístrate aquí</a></p> {{-- Cambiado a text-dark y enlace a text-primary --}}
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Estilos CSS personalizados para el fondo y posicionamiento --}}
    <style>
        .login-card-with-bg {
            min-height: 490px; /* Altura mínima para que la imagen de fondo sea visible */
            background-image: url('{{ asset('images/fondoLogin.png') }}'); /* Ruta a tu imagen */
            background-size: cover; /* Ajusta la imagen para cubrir todo el elemento */
            background-position: center; /* Centra la imagen de fondo */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            position: relative; /* Importante para posicionar elementos hijos */
            overflow: hidden; /* Asegura que la imagen no se desborde */
        }

        .login-form-column {
            /* Fondo blanco más semitransparente para el formulario */
            background-color: rgba(255, 255, 255, 0.7); /* Antes 0.9, ahora 0.7 */
            border-radius: 0 6px 6px 0; /* Bordes redondeados solo a la derecha */
            /* Si el offset-md-6 no funciona perfectamente, puedes usar un ancho fijo y margin-left auto */
            /* width: 50%; margin-left: auto; */
        }

        /* En pantallas pequeñas, oculta la imagen de fondo y el formulario ocupa todo el ancho */
        @media (max-width: 767.98px) {
            .login-card-with-bg {
                background-image: none !important; /* Oculta la imagen de fondo */
                min-height: auto; /* Altura automática en pantallas pequeñas */
            }
            .login-form-column {
                width: 100%; /* Ocupa todo el ancho */
                margin-left: 0 !important; /* Quita el offset */
                border-radius: 6px; /* Vuelve a redondear todas las esquinas */
                background-color: #fff; /* Fondo blanco sólido */
            }
        }
    </style>
</x-guest-layout>
