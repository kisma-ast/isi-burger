<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Commande;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('commande')->get();
        return view('paiements.index', compact('paiements'));
    }

    public function show($id)
    {
        $paiement = Paiement::with('commande')->findOrFail($id);
        return view('paiements.show', compact('paiement'));
    }

    public function create()
    {
        return view('paiements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'montant' => 'required|numeric',
            'methode' => 'required|string',
        ]);

        $commande = Commande::findOrFail($request->commande_id);

        if ($commande->status === 'payée') {
            return redirect()->back()->with('error', 'Cette commande a déjà été payée.');
        }

        Paiement::create($request->all());
        $commande->update(['status' => 'payée']);

        return redirect()->route('paiements.index')->with('success', 'Paiement enregistré !');
    }

    public function edit($id)
    {
        $paiement = Paiement::findOrFail($id);
        return view('paiements.edit', compact('paiement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'montant' => 'required|numeric',
        ]);

        $paiement = Paiement::findOrFail($id);
        $paiement->update($request->all());

        return redirect()->route('paiements.index')->with('success', 'Paiement mis à jour !');
    }

    public function destroy($id)
    {
        Paiement::destroy($id);
        return redirect()->route('paiements.index')->with('success', 'Paiement supprimé !');
    }
}
