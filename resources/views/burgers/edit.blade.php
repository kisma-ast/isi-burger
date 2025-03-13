@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Modifier le Burger ✏️</h1>

        {{-- Message de succès ou d'erreur --}}
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Formulaire de modification --}}
        <form action="{{ route('burgers.update', $burger) }}" method="POST" enctype="multipart/form-data"
              class="mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            @csrf
            @method('PUT')

            {{-- Nom du Burger --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Nom du burger</label>
                <input type="text" name="name" value="{{ old('name', $burger->name) }}" required
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 @error('name') border-red-500 @enderror">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Prix --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Prix (XOF)</label>
                <input type="number" name="price" value="{{ old('price', $burger->price) }}" required min="100"
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 @error('price') border-red-500 @enderror">
                @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Description</label>
                <textarea name="description" rows="3" required
                          class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 @error('description') border-red-500 @enderror">{{ old('description', $burger->description) }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Stock --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Stock disponible</label>
                <input type="number" name="stock" value="{{ old('stock', $burger->stock) }}" required min="0"
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 @error('stock') border-red-500 @enderror">
                @error('stock')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image actuelle --}}
            @if($burger->image)
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300">Image actuelle</label>
                    <img src="{{ asset('storage/' . $burger->image) }}" alt="{{ $burger->name }}" class="w-48 h-48 object-cover rounded-lg mt-2">
                </div>
            @endif

            {{-- Nouvelle Image --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Changer l'image du Burger</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 @error('image') border-red-500 @enderror">
                @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bouton Modifier --}}
            <button type="submit"
                    class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-500 transition">
                Modifier ✔️
            </button>
        </form>
    </div>
@endsection
