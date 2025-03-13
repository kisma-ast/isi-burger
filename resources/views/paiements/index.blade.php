@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des paiements</h1>
        <a href="{{ route('paiements.create') }}" class="btn btn-primary">Ajouter un paiement</a>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Commande</th>
                <th>Montant</th>
                <th>Méthode</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($paiements as $paiement)
                <tr>
                    <td>{{ $paiement->id }}</td>
                    <td>{{ $paiement->commande->id }}</td>
                    <td>{{ $paiement->montant }} €</td>
                    <td>{{ $paiement->methode }}</td>
                    <td>
                        <a href="{{ route('paiements.show', $paiement->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('paiements.edit', $paiement->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('paiements.destroy', $paiement->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
