@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">🍔 Nos Burgers</h1>

        <div class="flex space-x-4 mt-4">
            <a href="{{ route('burgers.create') }}"
               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500">
                + Ajouter un Burger
            </a>

            <a href="{{ route('burgers.index') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">
                📋 Voir la liste des Burgers
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            @foreach($burgers as $burger)
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-xl hover:shadow-2xl transition-transform transform hover:scale-105">
                    <h2 class="text-xl font-bold text-red-600 dark:text-red-400">{{ $burger->nom }}</h2>
                    <p class="text-gray-700 dark:text-gray-300">Prix : {{ $burger->prix }} XOF</p>

                    <div class="mt-2 flex space-x-2">
                        <a href="{{ route('burgers.show', $burger) }}" class="text-blue-500 hover:underline">
                            🔍 Voir Détails
                        </a>
                        <a href="{{ route('burgers.edit', $burger) }}" class="text-yellow-500 hover:underline">
                            ✏️ Modifier
                        </a>
                        <form action="{{ route('burgers.destroy', $burger) }}" method="POST"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce burger ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">🗑 Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
