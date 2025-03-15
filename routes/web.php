<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BurgerController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommandeItemController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BurgerCommandeController; // Ajout du contrôleur

/**
 * 🔹 Route d'accueil
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

/**
 * 🔹 Routes accessibles uniquement aux utilisateurs connectés et vérifiés
 */
Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });


    Route::resource('users', UserController::class)->except(['create', 'store']);


    Route::resource('burgers', BurgerController::class);


    Route::prefix('commandes')->name('commandes.')->group(function () {
        Route::get('/client', [CommandeController::class, 'clientIndex'])->name('client.index');
        Route::post('/store', [CommandeController::class, 'store'])->name('store'); // ✅ Correction ici
    });

    Route::resource('commandes', CommandeController::class)->except(['create']);


    Route::resource('commande_items', CommandeItemController::class)->only(['index', 'show', 'destroy']);


    Route::resource('paiements', PaiementController::class)->only(['index', 'store']);
    Route::get('/paiements/create', [PaiementController::class, 'create'])->name('paiements.create');
    Route::get('/paiements/index', [PaiementController::class, 'index'])->name('paiements.index');


    Route::resource('burger-commandes', BurgerCommandeController::class)->only(['index', 'store', 'destroy']);
});

/**
 * 🔹 Importation des routes d'authentification
 */
require __DIR__ . '/auth.php';
