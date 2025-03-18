<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inventario') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100">

    <header class="bg-red-800 text-white py-4 px-6 flex justify-between items-center">
        <div class="flex items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo_uns.png') }}" alt="Logo UNS" class="h-7 mr-2 drop-shadow-lg">
            </a>
            <h1 class="text-xl font">Control Patrimonial UNS</h1>
        </div>

        <nav class="flex items-center">
            <a href="{{ route('consultas.index') }}" class="px-4">Consultas</a>
            <a href="{{ route('empleados.index') }}" class="px-4">Trabajadores</a>
            <a href="{{ route('oficinas.index') }}" class="px-4">Oficinas</a>
            <a href="{{ route('areas.index') }}" class="px-4">Áreas</a>
            <a href="{{ route('operaciones.index') }}" class="px-4">Operaciones</a>
            <a href="{{ route('reportes.index') }}" class="px-4">Reportes</a>

            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="px-4 bg-blue-600 hover:bg-blue-700 rounded text-white">
                        Panel Admin
                    </a>
                @endif
            @endauth

            <div x-data="{ open: false }" class="relative ml-4">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <img src="{{ asset('images/user_avatar.png') }}" alt="Usuario" class="h-8 w-8 rounded-full border">
                </button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white text-black shadow-lg rounded-lg z-50">
                    <div class="p-4 border-b text-center">
                        <img src="{{ asset('images/user_avatar.png') }}" alt="Usuario" class="h-12 w-12 rounded-full mx-auto">
                        @if(auth()->check())
                            <p class="font-semibold">{{ auth()->user()->name }}</p>
                            <p class="font-semibold">{{ auth()->user()->email }}</p>
                            <p class="font-semibold">{{ auth()->user()->tipo_usuario }}</p>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="p-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-200">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="w-full bg-white shadow-md rounded-lg p-6">
        @yield('content')
    </div>

</body>
</html>