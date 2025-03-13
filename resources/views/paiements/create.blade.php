@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ajouter un paiement</h1>
        <form action="{{ route('paiements.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="commande_id" class="form-label">ID Commande</label>
                <input type="number" name="commande_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="montant" class="form-label">Montant</label>
                <input type="number" step="0.01" name="montant" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="methode" class="form-label">Méthode</label>
                <input type="text" name="methode" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </form>
    </div>
@endsection
