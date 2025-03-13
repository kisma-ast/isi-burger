@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">🍔 Nos Burgers</h1>
            <div class="flex space-x-4">
                <a href="{{ route('burgers.create') }}"
                   class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-500 transition-transform transform hover:scale-105">
                    + Ajouter un Burger
                </a>
                <a href="{{ route('burgers.index') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-500 transition-transform transform hover:scale-105">
                    📋 Voir la liste des Burgers
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-600 text-white p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($burgers->isEmpty())
            <p class="text-gray-500 dark:text-gray-400 text-center mt-6">Aucun burger disponible pour l'instant. 🍔❌</p>
        @else
            <div class="bg-navy-800 p-4 shadow-xl rounded-lg overflow-x-auto" style="background-color: #1a2942;">
                <table class="w-full text-left border-collapse text-white">
                    <thead>
                    <tr class="bg-navy-700 text-gray-200" style="background-color: #162236;">
                        <th class="py-3 px-4">Image</th>
                        <th class="py-3 px-4">Nom</th>
                        <th class="py-3 px-4 text-center">Prix</th>
                        <th class="py-3 px-4 text-center">Stock</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($burgers as $burger)
                        <tr class="border-t border-navy-600 hover:bg-navy-700" style="border-color: #2d4363;">
                            <td class="py-3 px-4">
                                @if($burger->image)
                                    <div class="w-20 h-20 overflow-hidden rounded-lg shadow-md">
                                        <img src="{{ asset('storage/' . $burger->image) }}"
                                             alt="Image de {{ $burger->nom }}"
                                             class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-20 h-20 bg-navy-600 rounded-lg flex items-center justify-center shadow-md" style="background-color: #2d4363;">
                                        <span class="text-2xl">🍔</span>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 px-4 font-semibold text-red-400">{{ $burger->nom ?? $burger->name }}</td>
                            <td class="py-3 px-4 text-center">{{ number_format($burger->prix ?? $burger->price, 0, ',', ' ') }} XOF</td>
                            <td class="py-3 px-4 text-center">
                                <div class="relative w-32 h-4 bg-navy-600 rounded-lg" style="background-color: #2d4363;">
                                    <div class="absolute top-0 left-0 h-4 rounded-lg"
                                         style="width: {{ max(5, (($burger->stock ?? 0) / 50) * 100) }}%; background-color: {{ ($burger->stock ?? 0) > 10 ? '#22C55E' : '#EF4444' }};">
                                    </div>
                                </div>
                                <span class="text-sm font-semibold {{ ($burger->stock ?? 0) > 10 ? 'text-green-400' : 'text-red-400' }}">
                                    {{ ($burger->stock ?? 0) > 0 ? ($burger->stock ?? 0) . ' en stock' : 'Rupture' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 flex space-x-2">
                                <a href="{{ route('burgers.show', $burger->id ?? $burger) }}"
                                   class="px-3 py-1 text-white bg-blue-500 rounded-lg shadow-lg hover:bg-blue-400 transition-all duration-200">
                                    🔍 Voir
                                </a>
                                <a href="{{ route('burgers.edit', $burger->id ?? $burger) }}"
                                   class="px-3 py-1 text-white bg-yellow-500 rounded-lg shadow-lg hover:bg-yellow-400 transition-all duration-200">
                                    ✏️ Modifier
                                </a>
                                <form action="{{ route('burgers.destroy', $burger->id ?? $burger) }}" method="POST"
                                      onsubmit="return confirm('Supprimer ce burger ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 text-white bg-red-500 rounded-lg shadow-lg hover:bg-red-400 transition-all duration-200">
                                        🗑 Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
