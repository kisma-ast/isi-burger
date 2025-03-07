<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen flex items-center justify-center">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div
                class="bg-white/10 backdrop-blur-lg shadow-lg rounded-xl p-6 border border-gray-700 opacity-0 translate-y-10 animate-fade-in-up"
            >
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-white animate-fade-in">
                        Bienvenue, <span class="text-indigo-400">{{ Auth::user()->name }}</span> 🚀
                    </h1>
                    <p class="mt-3 text-gray-300 animate-fade-in-delay">
                        Vous êtes bien connecté ! Explorez les fonctionnalités de votre application.
                    </p>
                    <div class="mt-6">
                        <a
                            href="{{ route('burgers.index') }}"
                            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg shadow-md transition-transform duration-300 transform hover:scale-105 active:scale-95 animate-bounce"
                        >
                            Explorer les Burgers 🍔
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Animations Tailwind -->
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
        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes fade-in-delay {
            0% { opacity: 0; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }
        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }
        .animate-fade-in-delay {
            animation: fade-in-delay 1.5s ease-out forwards;
        }
    </style>
</x-app-layout>
