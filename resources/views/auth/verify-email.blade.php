@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Verifica tu correo</h2>

        <p class="text-gray-600 text-center mb-6">
            Antes de continuar, revisa tu bandeja de entrada para encontrar el enlace de verificación.
            Si no has recibido el correo, puedes solicitar un nuevo enlace.
        </p>

        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 border border-green-400 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">
                Reenviar enlace
            </button>
        </form>
    </div>
</div>
@endsection
