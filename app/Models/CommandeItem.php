<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeItem extends Model
{
    use HasFactory;

    protected $fillable = ['commande_id', 'burger_id', 'quantity', 'price'];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function burger()
    {
        return $this->belongsTo(Burger::class);
    }
}
