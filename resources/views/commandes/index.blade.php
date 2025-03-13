@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100"></h1>
            <div class="flex space-x-4">

            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-600 text-white p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-navy-800 p-4 shadow-xl rounded-lg overflow-x-auto" style="background-color: #1a2942;">
            <div class="py-3 px-4 mb-4 bg-yellow-500 text-navy-800 font-bold rounded-lg" style="background-color: #0d0132; color: #1a2942;">
                Liste des Commandes
            </div>
            <table class="w-full text-left border-collapse text-white">
                <thead>
                <tr class="bg-navy-700 text-gray-200" style="background-color: #162236;">
                    <th class="py-3 px-4">ID</th>
                    <th class="py-3 px-4">Client</th>
                    <th class="py-3 px-4 text-center">Total</th>
                    <th class="py-3 px-4 text-center">Statut</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($commandes as $commande)
                    <tr class="border-t border-navy-600 hover:bg-navy-700" style="border-color: #2d4363;">
                        <td class="py-3 px-4">{{ $commande->id }}</td>
                        <td class="py-3 px-4">{{ $commande->user->name ?? 'Inconnu' }}</td>
                        <td class="py-3 px-4 text-center">{{ number_format($commande->total, 0, ',', ' ') }} XOF</td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium {{ $commande->status == 'en attente' ? 'bg-yellow-500 text-navy-800' : 'bg-green-500 text-white' }}"
                                  style="{{ $commande->status == 'en attente' ? 'background-color: #f59e0b; color: #1a2942;' : '' }}">
                                ● {{ ucfirst($commande->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="relative inline-block text-left">
                                <div>
                                    <button type="button" onclick="toggleDropdown({{ $commande->id }})" class="inline-flex justify-center w-full px-3 py-2 bg-navy-600 text-sm font-medium text-white rounded-md shadow-lg hover:bg-navy-500 focus:outline-none" style="background-color: #2d4363;">
                                        &#8942;
                                    </button>
                                </div>
                                <div id="dropdown-{{ $commande->id }}" class="hidden absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10">
                                    <div class="py-1">
                                        <a href="{{ route('commandes.show', $commande->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Voir</a>
                                        <a href="{{ route('commandes.edit', $commande->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifier</a>
                                        <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" onsubmit="return confirm('Supprimer cette commande ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(`dropdown-${id}`);
            const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');

            // Ferme tous les autres dropdowns
            allDropdowns.forEach(element => {
                if (element.id !== `dropdown-${id}`) {
                    element.classList.add('hidden');
                }
            });

            // Toggle le dropdown actuel
            dropdown.classList.toggle('hidden');
        }

        // Ferme les dropdowns quand on clique ailleurs sur la page
        window.addEventListener('click', function(e) {
            if (!e.target.closest('button') || !e.target.closest('button').getAttribute('onclick') || !e.target.closest('button').getAttribute('onclick').includes('toggleDropdown')) {
                const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');
                allDropdowns.forEach(element => {
                    element.classList.add('hidden');
                });
            }
        });
    </script>
@endsection
