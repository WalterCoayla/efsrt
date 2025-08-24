<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles (usando Vite para Laravel) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Si usas Bootstrap CDN en lugar de Vite, asegúrate de tenerlo aquí -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="font-sans text-gray-900 antialiased">
        {{-- Eliminado las clases 'min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100' --}}
        {{-- Y ajustado el div para que use un contenedor más amplio o sin restricciones de ancho --}}
        <div class="container-fluid py-5"> {{-- Usamos container-fluid para ancho completo --}}
            {{ $slot }}
        </div>
        <!-- Scripts de Bootstrap (si usas CDN) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts') {{-- ¡Añadido aquí para cargar scripts del push! --}}
    </body>
</html>
