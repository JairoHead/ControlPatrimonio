@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">Panel de Administración</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="{{ route('admin.users.index') }}" class="block p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                <h3 class="text-lg font-semibold mb-2">Gestión de Usuarios</h3>
                <p class="text-gray-600">Registra, edita y gestiona los usuarios del sistema.</p>
            </a>

            <a href="{{ route('areas.index') }}" class="block p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                <h3 class="text-lg font-semibold mb-2">Gestión de Áreas</h3>
                <p class="text-gray-600">Administra las áreas del sistema.</p>
            </a>

            <a href="{{ route('oficinas.index') }}" class="block p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                <h3 class="text-lg font-semibold mb-2">Gestión de Oficinas</h3>
                <p class="text-gray-600">Administra las oficinas del sistema.</p>
            </a>

            <a href="{{ route('reportes.index') }}" class="block p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                <h3 class="text-lg font-semibold mb-2">Reportes</h3>
                <p class="text-gray-600">Genera y visualiza reportes del sistema.</p>
            </a>
        </div>
    </div>
</div>
@endsection