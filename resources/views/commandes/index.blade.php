@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">📦 Commandes</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach($commandes as $commande)
                <div
                    class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-xl border border-gray-200 dark:border-gray-700 transform transition-all duration-300 hover:scale-105 hover:shadow-2xl animate-fade-in-up"
                >
                    <h2 class="text-xl font-bold text-indigo-600 dark:text-indigo-400">Commande #{{ $commande->id }}</h2>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">
                        💰 <span class="font-semibold">{{ $commande->total }} XOF</span>
                    </p>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">
                        📌 Statut : <span class="font-medium">{{ ucfirst($commande->statut) }}</span>
                    </p>
                    <a
                        href="{{ route('commandes.show', $commande) }}"
                        class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-500 transition-transform transform hover:scale-105 active:scale-95"
                    >
                        Voir Détails 👀
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Ajout d'animations Tailwind -->
    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.7s ease-out forwards;
        }
    </style>
@endsection
