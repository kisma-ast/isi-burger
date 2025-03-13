<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Burger;
use Illuminate\Support\Facades\DB;



class CommandeController extends Controller
{
    /**
     * Affiche la liste des commandes.
     */
    public function index()
    {
        $commandes = Commande::all();
        return view('commandes.index', compact('commandes'));
    }

    /**
     * Affiche le formulaire de création d'une commande.
     */
    public function create()
    {
        $users = User::all(); // Récupération des utilisateurs
        $burgers = Burger::all(); // Récupération des burgers

        return view('commandes.create', compact('users', 'burgers'));
    }

    /**
     * Stocke une nouvelle commande en base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'burgers' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            $user = auth()->user();

            // Création de la commande
            $commande = Commande::create([
                'user_id' => $user->id,
                'status' => 'en attente',
                'total' => 0,
            ]);

            $total = 0;

            foreach ($request->burgers as $burgerId => $burgerData) {
                $burger = Burger::findOrFail($burgerId);
                $quantite = $burgerData['quantite'];
                $price = $burger->price; // Utilisation de price directement

                if ($burger->stock < $quantite) {
                    throw new \Exception("Stock insuffisant pour {$burger->name}");
                }

                // Déduire du stock
                $burger->stock -= $quantite;
                $burger->save();

                // Associer le produit à la commande
                $commande->burgers()->attach($burger->id, [
                    'quantite' => $quantite,
                    'price' => $price, // Utilisation de price
                ]);

                // Calcul du total
                $total += $price * $quantite;
            }

            // Mettre à jour le total de la commande
            $commande->total = $total;
            $commande->save();
        });

        return redirect()->route('commandes.index')->with('success', 'Commande créée avec succès');
    }


    public function clientIndex()
    {
        $burgers = Burger::all(); // Récupérer tous les burgers depuis la base de données
        return view('commandes.client', compact('burgers')); // Envoyer à la vue
    }

    /**
     * Affiche une commande spécifique.
     */
    public function show($id)
    {
        $commande = Commande::with('burgers')->findOrFail($id);
        return view('commandes.show', compact('commande'));
    }




    /**
     * Affiche le formulaire d'édition d'une commande.
     */
    public function edit(Commande $commande)
    {
        $users = User::all(); // Récupération des utilisateurs
        $burgers = Burger::all(); // Récupération de tous les burgers disponibles
        $commande->load('burgers'); // Charger les burgers associés à la commande

        return view('commandes.edit', compact('commande', 'users', 'burgers'));
    }


    /**
     * Met à jour une commande spécifique.
     */
    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'status' => 'required|in:en attente,en préparation,prête,payée',
            'burgers' => 'nullable|array',
            'burgers.*.quantite' => 'nullable|integer|min:0'
        ]);

        DB::transaction(function () use ($request, $commande) {
            // Mise à jour du statut
            $commande->update([
                'status' => $request->status,
            ]);

            // Mise à jour des produits commandés uniquement s'ils sont envoyés
            if ($request->has('burgers')) {
                $burgersData = [];

                foreach ($request->burgers as $burgerId => $data) {
                    if (!empty($data['quantite']) && $data['quantite'] > 0) {
                        $burgersData[$burgerId] = [
                            'quantite' => $data['quantite'],
                            'price' => $data['price'] ?? 0, // Assurer un prix valide
                        ];
                    }
                }

                // Mise à jour des relations Many-to-Many
                $commande->burgers()->sync($burgersData);
            }
        });

        return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès.');
    }



    /**
     * Supprime une commande.
     */
    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès');
    }
}
