<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupération des commandes par mois (compatible PostgreSQL)
        $commandesParMois = DB::table('commandes')
            ->selectRaw("EXTRACT(MONTH FROM created_at) as mois, COUNT(*) as total")
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // Retourne la vue dashboard avec les données
        return view('dashboard', compact('commandesParMois'));
    }
}
