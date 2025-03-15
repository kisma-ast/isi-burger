<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BurgerCommande extends Pivot
{
    protected $table = 'burger_commande'; // Vérifie que c'est bien le nom exact de ta table pivot
    protected $fillable = ['burger_id', 'commande_id', 'quantite', 'total_price'];

    public $timestamps = false; // Si ta table pivot ne contient pas de `created_at` et `updated_at`

    public function burger()
    {
        return $this->belongsTo(Burger::class, 'burger_id');
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }
}
