@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">🍔 Ajouter un Burger</h1>
            <a href="{{ route('burgers.index') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-500 transition-transform transform hover:scale-105">
                📋 Voir la liste des Burgers
            </a>
        </div>

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="bg-green-600 text-white p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulaire d'ajout --}}
        <form action="{{ route('burgers.store') }}" method="POST" enctype="multipart/form-data"
              class="mt-6 bg-gray-900 p-6 shadow-xl rounded-xl text-white">
            @csrf {{-- Token CSRF pour la sécurité --}}

            {{-- Nom du Burger --}}
            <div class="mb-4">
                <label class="block text-gray-300">Nom du burger</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2 border rounded-lg bg-gray-800 @error('name') border-red-500 @enderror">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Prix --}}
            <div class="mb-4">
                <label class="block text-gray-300">Prix (XOF)</label>
                <input type="number" name="price" value="{{ old('price') }}" required min="100"
                       class="w-full px-4 py-2 border rounded-lg bg-gray-800 @error('price') border-red-500 @enderror">
                @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block text-gray-300">Description</label>
                <textarea name="description" rows="3" required
                          class="w-full px-4 py-2 border rounded-lg bg-gray-800 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Stock --}}
            <div class="mb-4">
                <label class="block text-gray-300">Stock disponible</label>
                <input type="number" name="stock" value="{{ old('stock', 1) }}" required min="0"
                       class="w-full px-4 py-2 border rounded-lg bg-gray-800 @error('stock') border-red-500 @enderror">
                @error('stock')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div class="mb-4">
                <label class="block text-gray-300">Image du Burger</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full px-4 py-2 border rounded-lg bg-gray-800 @error('image') border-red-500 @enderror">
                @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bouton Ajouter --}}
            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-500 transition-transform transform hover:scale-105">
                ✅ Ajouter le Burger
            </button>
        </form>
    </div>
@endsection
