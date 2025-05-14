<?php
use App\Http\Controllers\BienController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\DevolucionController;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Ruta para crear un préstamo
    Route::get('prestamos/{bien_id}/create', [PrestamoController::class, 'create'])->name('prestamos.create');
    Route::post('prestamos/{bien_id}', [PrestamoController::class, 'store'])->name('prestamos.store');

    // Ruta para ver los detalles del préstamo y registrar la devolución
    Route::get('prestamos/{prestamo}/show', [PrestamoController::class, 'show'])->name('prestamos.show');

    // Ruta para registrar una devolución
    Route::post('prestamos/{prestamo}/devolucion', [DevolucionController::class, 'store'])->name('devoluciones.store');
});

Route::resource('bienes', BienController::class);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
