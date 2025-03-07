<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use Illuminate\Http\Request;

class BurgerController extends Controller
{
    // Liste tous les burgers
    public function index()
    {
        $burgers = Burger::all();
        return view('burgers.index', compact('burgers'));
    }

    // Affiche un burger spécifique
    public function show($id)
    {
        $burger = Burger::findOrFail($id);
        return view('burgers.show', compact('burger'));
    }

    // Formulaire de création
    public function create()
    {
        return view('burgers.create');
    }

    // Stocke un nouveau burger
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
        ]);

        Burger::create($request->all());

        return redirect()->route('burgers.index')->with('success', 'Burger ajouté !');
    }

    // Formulaire d'édition
    public function edit($id)
    {
        $burger = Burger::findOrFail($id);
        return view('burgers.edit', compact('burger'));
    }

    // Met à jour un burger
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
        ]);

        $burger = Burger::findOrFail($id);
        $burger->update($request->all());

        return redirect()->route('burgers.index')->with('success', 'Burger mis à jour !');
    }

    // Supprime un burger
    public function destroy($id)
    {
        Burger::destroy($id);
        return redirect()->route('burgers.index')->with('success', 'Burger supprimé !');
    }
}
