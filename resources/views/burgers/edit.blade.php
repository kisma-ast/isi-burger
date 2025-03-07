@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Modifier le Burger ✏️</h1>

        <form action="{{ route('burgers.update', $burger) }}" method="POST" class="mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Nom du burger</label>
                <input type="text" name="nom" value="{{ $burger->nom }}" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Prix</label>
                <input type="number" name="prix" value="{{ $burger->prix }}" required class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700">
            </div>

            <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-500">
                Modifier ✔️
            </button>
        </form>
    </div>
@endsection
