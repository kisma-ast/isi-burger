<?php

namespace App\Http\Controllers;

use App\Models\CommandeItem;
use Illuminate\Http\Request;

class CommandeItemController extends Controller
{
    public function index()
    {
        $items = CommandeItem::all();
        return view('commande_items.index', compact('items'));
    }

    public function create()
    {
        return view('commande_items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'burger_id' => 'required|exists:burgers,id',
            'quantite' => 'required|integer|min:1',
        ]);

        CommandeItem::create($request->all());

        return redirect()->route('commande_items.index')->with('success', 'Article ajouté à la commande !');
    }

    public function show($id)
    {
        $item = CommandeItem::findOrFail($id);
        return view('commande_items.show', compact('item'));
    }

    public function edit($id)
    {
        $item = CommandeItem::findOrFail($id);
        return view('commande_items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $item = CommandeItem::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('commande_items.index')->with('success', 'Article mis à jour !');
    }

    public function destroy($id)
    {
        CommandeItem::destroy($id);
        return redirect()->route('commande_items.index')->with('success', 'Article supprimé !');
    }
}
