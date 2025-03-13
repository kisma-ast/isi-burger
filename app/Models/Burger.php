<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Burger extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image', 'stock'];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    // Relation avec CommandeItem
    public function commandeItems()
    {
        return $this->hasMany(CommandeItem::class);
    }

    // Scope pour récupérer uniquement les burgers en stock
    public function scopeAvailable($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Accessor pour récupérer l'URL complète de l'image
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : asset('images/default-burger.png');
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'burger_commande')
            ->withPivot('quantite')
            ->withTimestamps();
    }


}
