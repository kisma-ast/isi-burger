@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; margin-top: 7px;">
        <div class="card shadow-sm p-4 text-white" style="max-width: 500px; width: 100%; background-color: #1a2942;">
            <h2 class="text-center mb-4">Modifier la commande</h2>

            <form action="{{ route('commandes.update', $commande->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Client (désactivé) -->
                <div class="mb-3">
                    <label for="user_id" class="form-label fw-bold">
                        <i class="bi bi-person-circle"></i> Client
                    </label>
                    <input type="text" class="form-control text-white border-0"
                           style="background-color: #0d0132;"
                           value="{{ $commande->user->name }}" disabled>
                </div>

                <!-- Statut de la commande -->
                <div class="mb-3">
                    <label for="status" class="form-label fw-bold">
                        <i class="bi bi-list-check"></i> Statut
                    </label>
                    <select name="status" id="status" class="form-select text-white border-0"
                            style="background-color: #0d0132;">
                        <option value="en attente" {{ $commande->status == 'en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="en préparation" {{ $commande->status == 'en préparation' ? 'selected' : '' }}>En préparation</option>
                        <option value="prête" {{ $commande->status == 'prête' ? 'selected' : '' }}>Prête</option>
                        <option value="payée" {{ $commande->status == 'payée' ? 'selected' : '' }}>Payée</option>
                    </select>
                </div>

                <!-- Total de la commande (désactivé) -->
                <div class="mb-3">
                    <label for="total" class="form-label fw-bold">
                        <i class="bi bi-cash-coin"></i> Total (Xof)
                    </label>
                    <input type="number" class="form-control text-white border-0"
                           style="background-color: #0d0132;"
                           value="{{ $commande->total }}" disabled>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-save"></i> Mettre à jour
                </button>
            </form>
        </div>
    </div>
@endsection
