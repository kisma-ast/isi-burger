@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            {{-- Image du burger --}}
            @if($burger->image)
                <img src="{{ asset('storage/' . $burger->image) }}" alt="{{ $burger->name }}"
                     class="w-full h-64 object-cover rounded-lg mb-4">
            @endif

            {{-- Nom et détails du burger --}}
            <h1 class="text-3xl font-bold text-red-600">{{ $burger->name }}</h1>
            <p class="text-gray-700 dark:text-gray-300 mt-2">💰 <strong>Prix :</strong> {{ number_format($burger->price, 0, ',', ' ') }} XOF</p>
            <p class="text-gray-700 dark:text-gray-300 mt-2">📦 <strong>Stock :</strong> {{ $burger->stock }}</p>
            <p class="text-gray-600 dark:text-gray-400 mt-2">📝 <strong>Description :</strong> {{ $burger->description }}</p>

            {{-- Boutons d'action --}}
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('burgers.index') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">
                    🔙 Retour à la liste
                </a>
                <a href="{{ route('burgers.edit', $burger) }}"
                   class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-400">
                    ✏️ Modifier
                </a>
                <form action="{{ route('burgers.destroy', $burger) }}" method="POST"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce burger ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-500">
                        🗑 Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
