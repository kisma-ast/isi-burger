@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">

            {{-- Titre --}}
            <h1 class="text-3xl font-bold text-indigo-400 text-center">📊 Tableau de Bord</h1>
            <p class="text-gray-300 text-center mt-2">
                Bienvenue, <span class="font-semibold text-white">{{ Auth::user()->name }}</span> !
            </p>

            {{-- Statistiques --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="p-4 bg-white dark:bg-gray-700 shadow rounded-lg text-center">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">🍔 Total Burgers</h2>
                    <p class="text-indigo-500 text-3xl font-bold mt-1">{{ $totalBurgers ?? 0 }}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-700 shadow rounded-lg text-center">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">🛒 Commandes en cours</h2>
                    <p class="text-green-500 text-3xl font-bold mt-1">{{ $totalCommandes ?? 0 }}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-700 shadow rounded-lg text-center">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-300">💰 Revenus du jour</h2>
                    <p class="text-yellow-500 text-3xl font-bold mt-1">{{ number_format($revenus ?? 0, 0, ',', ' ') }} XOF</p>
                </div>
            </div>

            {{-- Graphiques --}}
            <div class="mt-10">
                <h2 class="text-2xl font-bold text-gray-300">📈 Statistiques des ventes</h2>
                <canvas id="commandesChart" class="mt-6"></canvas>
            </div>
        </div>
    </div>

    {{-- Script pour Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('commandesChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_map(fn($mois) => DateTime::createFromFormat('!m', $mois)->format('F'), $commandesParMois->pluck('mois')->toArray())) !!},
                    datasets: [{
                        label: 'Nombre de commandes',
                        data: {!! json_encode($commandesParMois->pluck('total')) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>

@endsection
