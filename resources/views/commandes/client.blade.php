@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 flex flex-col lg:flex-row gap-6">
        <!-- Message de bienvenue -->
        <aside class="bg-gray-900 text-white p-4 rounded-lg shadow-lg w-full lg:w-1/4 h-fit text-center">
            <h2 class="text-xl font-bold mb-4">Bienvenue chez ISI BURGER 🍔</h2>
            <p class="text-gray-400">Veuillez choisir vos burgers et passez votre commande en quelques clics !</p>
        </aside>

        <!-- Burgers Section -->
        <section class="w-full lg:w-3/4">
            <h1 class="text-center mb-6 text-white text-2xl font-extrabold">🍔 Nos Burgers</h1>

            <!-- Formulaire de commande -->
            <form action="{{ route('commandes.store') }}" method="POST" id="orderForm">
                @csrf
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach($burgers as $burger)
                        <div class="bg-gray-900 text-white rounded-lg overflow-hidden shadow-md transform transition-all duration-300 hover:scale-105 flex flex-col items-center p-3 border border-gray-700">
                            @if($burger->image)
                                <img src="{{ asset('storage/' . $burger->image) }}"
                                     class="w-24 h-24 object-cover rounded-lg transition-transform duration-300 hover:scale-110 hover:shadow-xl"
                                     alt="{{ $burger->name }}">
                            @endif

                            <h5 class="text-sm font-bold mt-2">{{ $burger->name }}</h5>
                            <p class="text-gray-400 text-xs text-center">{{ $burger->description }}</p>
                            <span class="text-yellow-500 font-bold mt-1">{{ number_format($burger->price, 0, ',', ' ') }} XOF</span>

                            <!-- Case à cocher cachée pour sélectionner -->
                            <input type="checkbox" id="burger_{{ $burger->id }}" name="burgers[{{ $burger->id }}][id]" value="{{ $burger->id }}" class="hidden">

                            <!-- Sélecteur de quantité -->
                            <input type="number" name="burgers[{{ $burger->id }}][quantite]" min="1" max="10" value="1"
                                   class="hidden w-16 text-center mt-2 border border-gray-600 rounded bg-gray-800 text-white">

                            <!-- Bouton Ajouter -->
                            <button type="button" onclick="toggleBurgerSelection(this)" class="mt-2 bg-yellow-500 text-black text-xs px-3 py-1 rounded-lg hover:bg-yellow-600">
                                Ajouter
                            </button>
                        </div>
                    @endforeach
                </div>

                <!-- Bouton Commander maintenant -->
                <button type="submit" class="mt-6 w-full bg-yellow-500 text-black font-bold py-2 rounded-lg shadow-lg hover:bg-yellow-600 transition-all">
                    Commander maintenant
                </button>
            </form>
        </section>
    </div>

    <script>
        function toggleBurgerSelection(button) {
            let card = button.closest('div'); // Récupère la carte du burger
            let checkbox = card.querySelector('input[type="checkbox"]'); // Input checkbox
            let quantityInput = card.querySelector('input[type="number"]'); // Input quantité

            checkbox.checked = !checkbox.checked; // Change l'état de la case à cocher
            quantityInput.classList.toggle('hidden'); // Affiche ou cache la quantité

            if (checkbox.checked) {
                button.classList.remove('bg-yellow-500');
                button.classList.add('bg-green-500');
                button.innerText = "Ajouté";
            } else {
                button.classList.remove('bg-green-500');
                button.classList.add('bg-yellow-500');
                button.innerText = "Ajouter";
                quantityInput.value = 1; // Réinitialise la quantité à 1
            }
        }

        document.getElementById("orderForm").addEventListener("submit", function(e) {
            let selectedBurgers = document.querySelectorAll('input[type="checkbox"]:checked');

            if (selectedBurgers.length === 0) {
                e.preventDefault(); // Bloque l'envoi
                alert("Veuillez sélectionner au moins un burger.");
                return;
            }

            selectedBurgers.forEach((checkbox) => {
                let quantityInput = checkbox.closest('div').querySelector('input[type="number"]');
                if (!quantityInput.value || quantityInput.value <= 0) {
                    e.preventDefault();
                    alert("Veuillez saisir une quantité valide pour chaque burger sélectionné.");
                    return;
                }
            });
        });
    </script>
@endsection
