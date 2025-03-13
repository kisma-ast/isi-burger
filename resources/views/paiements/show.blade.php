@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails du paiement</h1>
        <p>ID : {{ $paiement->id }}</p>
        <p>Commande : {{ $paiement->commande->id }}</p>
        <p>Montant : {{ $paiement->montant }} €</p>
        <p>Méthode : {{ $paiement->methode }}</p>
        <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Retour</a>
    </div>
@endsection
