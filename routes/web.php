<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitudController;
use App\Models\Solicitud; // <--- IMPORTANTE: Agregamos el modelo para que funcione

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
});

require __DIR__.'/auth.php';
