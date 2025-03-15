<?php

namespace App\Http\Controllers;

use App\Models\BurgerCommande;
use App\Models\Burger;
use Illuminate\Http\Request;

class BurgerCommandeController extends Controller
{
    // Liste toutes les commandes avec les burgers associés
    public function index()
    {
        $commandes = BurgerCommande::with('burger')->get();
        return response()->json($commandes);
    }

    // Enregistrer une nouvelle commande
    public function store(Request $request)
    {
        $request->validate([
            'burger_id' => 'required|exists:burgers,id',
            'commande_id' => 'required|integer',
            'quantite' => 'required|integer|min:1',
        ]);

        // Récupérer le burger
        $burger = Burger::findOrFail($request->burger_id);

        // Calcul du prix total
        $totalPrice = $burger->price * $request->quantite;

        // Enregistrement de la commande
        $burgerCommande = BurgerCommande::create([
            'burger_id' => $request->burger_id,
            'commande_id' => $request->commande_id,
            'quantite' => $request->quantite,
            'total_price' => $totalPrice, // Stocker le prix total
        ]);

        return response()->json([
            'message' => 'Commande ajoutée avec succès',
            'data' => $burgerCommande
        ], 201);
    }

    // Supprimer une commande spécifique
    public function destroy($id)
    {
        $commande = BurgerCommande::findOrFail($id);
        $commande->delete();

        return response()->json(['message' => 'Commande supprimée avec succès']);
    }
}
