<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    // Champs autorisés pour l'attribution de masse
    protected $fillable = ['user_id', 'status', 'total'];

    /**
     * Relation avec l'utilisateur (client)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les items de la commande
     */
    public function items()
    {
        return $this->hasMany(CommandeItem::class);
    }

    /**
     * Relation avec le paiement associé
     */
    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }

    /**
     * Récupérer les commandes par statut
     */
    public static function getByStatus($status)
    {
        return self::where('status', $status)->get();
    }

    /**
     * Calculer le total des recettes des commandes payées
     */
    public static function totalRecettes()
    {
        return self::where('status', 'payée')->sum('total');
    }

    /**
     * Vérifier si la commande est en cours de traitement
     */
    public function enCours()
    {
        return in_array($this->status, ['en attente', 'en préparation']);
    }
}
