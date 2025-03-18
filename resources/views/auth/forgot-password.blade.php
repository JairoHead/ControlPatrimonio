@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Recuperar contraseña</h2>

        <p class="text-gray-600 text-center mb-6">Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>

        @if (session('status'))
            <div class="mb-4 p-3 text-green-700 bg-green-100 border border-green-400 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input type="email" name="email" required 
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg text-lg font-semibold hover:bg-red-700 transition">
                Enviar enlace
            </button>
        </form>
    </div>
</div>
@endsection
