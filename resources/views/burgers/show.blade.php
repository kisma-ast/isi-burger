@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            <h1 class="text-3xl font-bold text-red-600">{{ $burger->nom }}</h1>
            <p class="text-gray-700 dark:text-gray-300 mt-2">💰 Prix : {{ $burger->prix }} XOF</p>
            <a href="{{ route('burgers.index') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">
                Retour à la liste
            </a>
        </div>
    </div>
@endsection
