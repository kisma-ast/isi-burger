@section('content')
    <div class="container">
        <h1>Modifier le paiement</h1>
        <form action="{{ route('paiements.update', $paiement->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="montant" class="form-label">Montant</label>
                <input type="number" step="0.01" name="montant" class="form-control" value="{{ $paiement->montant }}" required>
            </div>
            <button type="submit" class="btn btn-warning">Mettre à jour</button>
        </form>
    </div>
@endsection
