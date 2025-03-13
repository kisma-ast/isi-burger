@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Créer une commande</h2>

        <form action="{{ route('commandes.store') }}" method="POST">
            @csrf

            <!-- Sélection de l'utilisateur -->
            <div class="mb-3">
                <label for="user_id" class="form-label">Client</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sélection des produits -->
            <div class="mb-3">
                <label for="burgers" class="form-label">Produits</label>
                <div id="burger-list">
                    @foreach($burgers as $burger)
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" name="burgers[{{ $burger->id }}][id]" value="{{ $burger->id }}" class="me-2">
                            <label>{{ $burger->nom }} - {{ number_format($burger->prix, 2) }} XOF</label>
                            <input type="number" name="burgers[{{ $burger->id }}][quantite]" class="form-control ms-2" style="width: 80px;" min="1" placeholder="Qté">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Statut de la commande -->
            <div class="mb-3">
                <label for="status" class="form-label">Statut</label>
                <select name="status" id="status" class="form-control">
                    <option value="en attente">En attente</option>
                    <option value="en préparation">En préparation</option>
                    <option value="prête">Prête</option>
                    <option value="payée">Payée</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
@endsection
