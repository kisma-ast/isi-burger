@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; margin-top: 1px;">
        <div class="card shadow-sm p-4 text-white" style="max-width: 600px; width: 100%; background-color: #1a2942;">
            <h1 class="text-center mb-4">Commande #{{ $commande->id }}</h1>

            <p><strong><i class="bi bi-person-circle"></i> Client:</strong> {{ $commande->user->name ?? 'Client inconnu' }}</p>
            <p><strong><i class="bi bi-cash-coin"></i> Total:</strong> {{ number_format($commande->total, 2) }} XOF</p>
            <p><strong><i class="bi bi-list-check"></i> Statut:</strong> {{ ucfirst($commande->status ?? 'Inconnu') }}</p>

            <h3 class="mt-4">Produits commandés</h3>

            @if($commande->burgers->isEmpty())
                <p class="text-warning">Aucun produit dans cette commande.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered text-white" style="background-color: #0d0132;">
                        <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix Unitaire</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($commande->burgers as $burger)
                            <tr>
                                <td>
                                    {{ $burger->nom ?? 'Produit supprimé (ID: '.$burger->id.')' }}
                                </td>
                                <td>{{ $burger->pivot->quantite ?? 0 }}</td>
                                <td>{{ number_format($burger->pivot->price ?? 0, 2) }} XOF</td>
                                <td>{{ number_format(($burger->pivot->quantite ?? 0) * ($burger->pivot->price ?? 0), 2) }} XOF</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <a href="{{ route('commandes.index') }}" class="btn btn-secondary w-100">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>
@endsection
