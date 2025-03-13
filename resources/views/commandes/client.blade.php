@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-center mb-8 text-white text-3xl font-extrabold relative">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-yellow-600">🍔 Commandez votre burger préféré !</span>
            <div class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-yellow-500 rounded-full"></div>
        </h1>

        <form action="{{ route('commandes.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($burgers as $burger)
                    <div class="bg-gray-900 text-white rounded-lg overflow-hidden shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-xl flex flex-col h-full border border-gray-700">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $burger->image) }}" class="w-full h-52 object-cover rounded-t-lg" alt="{{ $burger->name }}">
                            <div class="absolute top-0 right-0 bg-yellow-500 text-black font-bold px-3 py-1 rounded-bl-lg shadow-lg text-sm">
                                {{ number_format($burger->price, 0, ',', ' ') }} XOF
                            </div>
                        </div>

                        <div class="p-4 text-center flex flex-col flex-grow">
                            <h5 class="text-lg font-bold mb-2">{{ $burger->name }}</h5>
                            <p class="text-gray-400 text-xs mb-4">{{ $burger->description }}</p>

                            <div class="flex items-center justify-center w-full">
                                <input type="checkbox" name="burgers[{{ $burger->id }}][id]" value="{{ $burger->id }}" class="burger-checkbox hidden">
                                <label class="cursor-pointer select-none flex items-center justify-between w-full bg-gray-800 text-gray-300 text-sm px-4 py-2 rounded-lg border border-gray-600 hover:bg-gray-700 transition-all">
                                    <span>Ajouter</span>
                                    <span class="text-yellow-500 font-bold">✔</span>
                                </label>
                            </div>

                            <div class="mt-2 hidden quantity-container">
                                <label for="quantity-{{ $burger->id }}" class="block text-xs font-medium mb-1">Quantité</label>
                                <div class="flex items-center justify-center w-full">
                                    <button type="button" onclick="decrementQuantity(this)" class="bg-gray-700 hover:bg-gray-600 text-white w-8 h-8 rounded-l-lg flex items-center justify-center focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <input type="number" name="burgers[{{ $burger->id }}][quantite]" class="w-12 text-center py-1 bg-gray-700 text-gray-200 font-bold select-none border-x border-gray-600 text-sm quantity-input" min="1" value="1">
                                    <button type="button" onclick="incrementQuantity(this)" class="bg-gray-700 hover:bg-gray-600 text-white w-8 h-8 rounded-r-lg flex items-center justify-center focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="mt-6 w-full bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-black font-bold py-3 px-4 rounded-lg shadow-lg transform transition-all duration-300 hover:-translate-y-1 hover:scale-105 flex items-center justify-center gap-1 text-lg">
                Commander maintenant
            </button>
        </form>
    </div>

    <script>
        document.querySelectorAll(".burger-checkbox").forEach(checkbox => {
            checkbox.addEventListener("change", function () {
                let container = this.closest(".flex").nextElementSibling;
                if (this.checked) {
                    container.classList.remove("hidden");
                } else {
                    container.classList.add("hidden");
                }
            });
        });

        function incrementQuantity(button) {
            const input = button.parentElement.querySelector('input');
            input.value = parseInt(input.value) + 1;
        }

        function decrementQuantity(button) {
            const input = button.parentElement.querySelector('input');
            const value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        }
    </script>
@endsection
