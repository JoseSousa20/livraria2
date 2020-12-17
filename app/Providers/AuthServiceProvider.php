<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('atualizar-livro', function($user,$livro){
            return $user->id==$livro->id_user;
        });

        Gate::define('atualizar-genero', function($user,$genero){
            return $user->id==$genero->id_user;
        });

        Gate::define('atualizar-autor', function($user,$autor){
            return $user->id==$autor->id_user;
        });

        Gate::define('atualizar-editora', function($user,$editora){
            return $user->id==$editora->id_user;
        });

        Gate::define('admin', function($user){
            if($user->tipo_user=='admin'){
                return true;
            }
            else{
                return false;
            }
        });
    }
}
