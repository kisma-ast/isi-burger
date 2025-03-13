<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Commande;
use App\Policies\CommandePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Commande::class => CommandePolicy::class, // Associer la politique au modèle
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Exemple de Gate globale si nécessaire
        Gate::define('view-commande', function ($user, $commande) {
            return $user->id === $commande->user_id;
        });
    }
}
