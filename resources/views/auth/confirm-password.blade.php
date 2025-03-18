@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Confirmar contraseña</h2>
        
        <p class="text-gray-600 text-center mb-6">Por favor, confirma tu contraseña antes de continuar.</p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" required 
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg text-lg font-semibold hover:bg-red-700 transition">
                Confirmar
            </button>
        </form>
    </div>
</div>
@endsection
