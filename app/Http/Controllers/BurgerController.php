<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BurgerController extends Controller
{
    // Liste tous les burgers
    public function index()
    {
        $burgers = Burger::latest()->get();
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $data = $request->only(['name', 'description', 'price', 'stock']);

                if ($request->hasFile('image')) {
                    $imageName = time() . '.' . $request->file('image')->extension();
                    $imagePath = $request->file('image')->storeAs('burgers', $imageName, 'public');
                    $data['image'] = $imagePath;
                }

                Burger::create($data);
            });

            return redirect()->route('burgers.index')->with('success', 'Burger ajouté avec succès !');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'ajout du burger : ' . $e->getMessage());
        }
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $burger = Burger::findOrFail($id);
                $data = $request->only(['name', 'description', 'price', 'stock']);

                // Gestion de l'image
                if ($request->hasFile('image')) {
                    // Supprimer l'ancienne image si elle existe
                    if ($burger->image) {
                        Storage::disk('public')->delete($burger->image);
                    }

                    // Sauvegarde de la nouvelle image
                    $imageName = time() . '.' . $request->file('image')->extension();
                    $imagePath = $request->file('image')->storeAs('burgers', $imageName, 'public');
                    $data['image'] = $imagePath;
                }

                $burger->update($data);
            });

            return redirect()->route('burgers.index')->with('success', 'Burger mis à jour avec succès !');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    // Supprime un burger
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $burger = Burger::findOrFail($id);

                // Supprimer l'image associée si elle existe
                if ($burger->image) {
                    Storage::disk('public')->delete($burger->image);
                }

                $burger->delete();
            });

            return redirect()->route('burgers.index')->with('success', 'Burger supprimé avec succès !');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
}
