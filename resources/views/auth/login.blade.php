@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white shadow-lg rounded-lg">
        <div class="flex justify-center">
            <img src="{{ asset('images/logo_uns.png') }}" alt="Logo UNS" class="w-24 h-24">
        </div>
        <h2 class="text-2xl font-bold text-center text-gray-700">Control Patrimonial UNS</h2>
        
        @if (session('error'))
            <div class="p-3 text-sm text-red-600 bg-red-100 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300">
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded">
                    <span class="ml-2 text-sm text-gray-600">Recuérdame</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit"
                class="w-full px-4 py-2 font-bold text-white bg-red-600 rounded-lg hover:bg-red-700">Iniciar Sesión</button>
        </form>
    </div>
</div>
@endsection
