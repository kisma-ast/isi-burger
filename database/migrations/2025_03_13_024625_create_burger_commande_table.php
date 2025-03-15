<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('burger_commande', function (Blueprint $table) {
            $table->id();
            $table->foreignId('burger_id')->constrained();
            $table->foreignId('commande_id')->constrained();
            $table->integer('quantite');
            $table->decimal('price', 10, 2); // Vérifier si la colonne est bien déclarée
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('burger_commande');
    }
};
