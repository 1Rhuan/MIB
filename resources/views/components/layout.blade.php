<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MIB - Servidor Oficial' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Estilos adicionais por página --}}
    @stack('styles')
</head>

<body class="bg-black text-white antialiased">

    {{-- Conteúdo principal --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-footer />

    {{-- Scripts adicionais por página --}}
    @stack('scripts')
</body>

</html>
