<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AdminController;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    $userId = Illuminate\Support\Facades\Auth::id();
    $recientes = Solicitud::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

    return view('dashboard', compact('recientes'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tramites', [SolicitudController::class, 'index'])->name('solicitudes.index');
    Route::get('/solicitudes/nueva', [SolicitudController::class, 'create'])->name('solicitudes.create');
    Route::post('/solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store');
    Route::get('/solicitudes/{id}', [SolicitudController::class, 'show'])->name('solicitudes.show');
    Route::put('/solicitudes/{id}', [SolicitudController::class, 'update'])->name('solicitudes.update');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::patch('/users/{id}/toggle', [AdminController::class, 'toggleStatus'])->name('users.toggle');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
    Route::get('/solicitudes', [AdminController::class, 'indexSolicitudes'])->name('solicitudes.index');
    Route::patch('/solicitudes/{id}/evaluar', [AdminController::class, 'evaluarSolicitud'])->name('solicitudes.evaluar');
});

require __DIR__.'/auth.php';

Route::get('/ver-columnas', function () {
    return Schema::getColumnListing('solicitud_archivos');
});
