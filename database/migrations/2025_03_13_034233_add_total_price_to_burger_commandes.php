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
        Schema::table('burger_commandes', function (Blueprint $table) {
            $table->decimal('total_price', 8, 2)->after('quantite');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('burger_commandes', function (Blueprint $table) {
            //
        });
    }
};
