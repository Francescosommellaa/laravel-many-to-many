<?php

use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\ProjectController;

// Rotta per la homepage per gli ospiti
Route::get('/', [PageController::class, 'index'])->name('guest.index');

// Gruppo di rotte per gli utenti autenticati
Route::middleware('auth')->group(function () {
    // Mostra la pagina del profilo
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Aggiorna il profilo
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Cancella il profilo
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotte per l'area amministrativa, accessibili solo agli utenti autenticati e verificati
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Mostra la dashboard dell'amministratore
        Route::get('/', [dashboardController::class, 'index'])->name('home');
        Route::resource('projects', ProjectController::class);
    });
// Include le rotte di autenticazione
require __DIR__ . '/auth.php';
