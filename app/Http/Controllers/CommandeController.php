<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with('user')->get();
        return view('commandes.index', compact('commandes'));
    }

    public function show($id)
    {
        $commande = Commande::with(['user', 'items.burger'])->findOrFail($id);
        return view('commandes.show', compact('commande'));
    }

    public function create()
    {
        return view('commandes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'in:en attente,en préparation,prête,payée',
        ]);

        Commande::create($request->all());

        return redirect()->route('commandes.index')->with('success', 'Commande créée !');
    }

    public function edit($id)
    {
        $commande = Commande::findOrFail($id);
        return view('commandes.edit', compact('commande'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'in:en attente,en préparation,prête,payée',
        ]);

        $commande = Commande::findOrFail($id);
        $commande->update($request->all());

        return redirect()->route('commandes.index')->with('success', 'Commande mise à jour !');
    }

    public function destroy($id)
    {
        Commande::destroy($id);
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée !');
    }
}
