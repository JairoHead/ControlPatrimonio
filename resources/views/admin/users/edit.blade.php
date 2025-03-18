@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">Editar Usuario</h2>

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombres y Apellidos</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                <select name="role" id="role" class="mt-1 p-2 border rounded-md w-full">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="trabajador_uns" {{ $user->role === 'trabajador_uns' ? 'selected' : '' }}>Trabajador UNS</option>
                    <option value="usuario" {{ $user->role === 'usuario' ? 'selected' : '' }}>Usuario</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Nueva Contraseña (Opcional)</label>
                <input type="password" name="password" id="password" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Nueva Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Actualizar Usuario</button>
        </form>
    </div>
</div>
@endsection