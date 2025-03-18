<?php

use App\Http\Controllers\{
    AreaController,
    ProfileController,
    UsuarioController,
    ConsultasController,
    OficinaController,
    OperacionesController,
    ReportesController,
    AdminUserController,
    Auth\AuthenticatedSessionController,
    EmpleadoUnsController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Página principal con el menú de navegación
Route::get('/', function () {
    return view('home');
})->name('home');

// ✅ Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// ✅ Rutas protegidas para usuarios autenticados y verificados
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ✅ Perfil del usuario (Rol: usuario)
    Route::prefix('profile')->middleware('role:usuario')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // ✅ Gestión de usuarios por administrador (Rol: admin)
    Route::prefix('admin/users')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/store', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::get('/edit/{user}', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::patch('/update/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/destroy/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::patch('/toggleStatus/{user}', [AdminUserController::class, 'toggleStatus'])->name('admin.users.toggleStatus'); // Ruta para cambiar el estado
    });

    // ✅ Secciones del sistema (Acceso para todos los usuarios autenticados y verificados)
    Route::get('/consultas', [ConsultasController::class, 'index'])->name('consultas.index');
    Route::get('/usuarios', [EmpleadoUnsController::class, 'index'])->name('empleados.index');
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
    Route::get('/oficinas', [OficinaController::class, 'index'])->name('oficinas.index');

    // ✅ Operaciones (Acceso para todos los usuarios autenticados y verificados)
    Route::prefix('operaciones')->group(function () {
        Route::get('/', [OperacionesController::class, 'index'])->name('operaciones.index');
        Route::post('/generar-reporte/{id}', [OperacionesController::class, 'generarReporte'])
            ->name('operaciones.generarReporte');
        Route::patch('/{id}', [OperacionesController::class, 'update'])->name('operaciones.update');
    });

    // ✅ Reportes (Acceso para todos los usuarios autenticados y verificados)
    Route::prefix('reportes')->group(function () {
        Route::get('/', [ReportesController::class, 'index'])->name('reportes.index');
        Route::get('/pdf-resumen', [ReportesController::class, 'pdfSoloResumen'])
            ->name('reportes.pdfSoloResumen');
        Route::get('/pdf-historial', [ReportesController::class, 'pdfSoloHistorial'])
            ->name('reportes.pdfSoloHistorial');
    });

    // ✅ PDFs de bienes (Acceso para todos los usuarios autenticados y verificados)
    Route::prefix('pdf')->group(function () {
        Route::get('/empleados/{codigo}', [EmpleadoUnsController::class, 'pdfBienesEmpleado'])
            ->name('empleados.pdfBienesEmpleado');
        Route::get('/areas/{codigo}', [AreaController::class, 'pdfBienesArea'])
            ->name('areas.pdfBienesArea');
        Route::get('/oficinas/{codigo}', [OficinaController::class, 'pdfBienesOficina'])
            ->name('oficinas.pdfBienesOficina');
    });
});

// ✅ Rutas de administrador
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard'); // Carga la vista admin/dashboard.blade.php
    })->name('admin.dashboard');
});

// ✅ Incluir autenticación adicional
require __DIR__ . '/auth.php';