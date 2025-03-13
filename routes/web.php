<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BurgerController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommandeItemController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
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

    // 📌 Tableau de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 📌 Gestion du profil utilisateur
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // 📌 Gestion des utilisateurs (admin uniquement si besoin)
    Route::resource('users', UserController::class)->except(['create', 'store']);

    // 📌 Gestion des burgers (CRUD)
    Route::resource('burgers', BurgerController::class);

    // 📌 Gestion des commandes
    Route::prefix('commandes')->name('commandes.')->group(function () {
        Route::get('/client', [CommandeController::class, 'clientIndex'])->name('client.index');
        Route::resource('/', CommandeController::class)->parameters(['' => 'commande']);
    });

    // 📌 Gestion des éléments de commande (ex: détails d'une commande)
    Route::resource('commande_items', CommandeItemController::class)->only(['index', 'show', 'destroy']);

    // 📌 Gestion des paiements
    Route::resource('paiements', PaiementController::class)->only(['index', 'store']);

    // 📌 Gestion des relations entre burgers et commandes
    Route::resource('burger-commandes', BurgerCommandeController::class)->only(['index', 'store', 'destroy']);

    Route::get('/paiements/create', [PaiementController::class, 'create'])->name('paiements.create');

    Route::get('/paiements/index', [PaiementController::class, 'index'])->name('paiements.index');


});

/**
 * 🔹 Importation des routes d'authentification
 */
require __DIR__ . '/auth.php';
