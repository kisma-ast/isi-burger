<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Burger extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image', 'stock'];

    public function commandeItems()
    {
        return $this->hasMany(CommandeItem::class);
    }
}
