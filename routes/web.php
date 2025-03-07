<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BurgerController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommandeItemController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (protégé par auth et email vérifié)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes d'authentification générées par Breeze
require __DIR__.'/auth.php';

// Routes protégées par l'authentification
Route::middleware('auth')->group(function () {

    // Gestion du profil utilisateur (déjà inclus par Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestion des utilisateurs
    Route::resource('users', UserController::class);

    // Gestion des Burgers
    Route::resource('burgers', BurgerController::class);

    // Gestion des Commandes
    Route::resource('commandes', CommandeController::class);

    // Gestion des Articles de Commande (Produits commandés)
    Route::resource('commande_items', CommandeItemController::class);

    // Gestion des Paiements
    Route::resource('paiements', PaiementController::class);
});
