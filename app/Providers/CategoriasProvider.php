<?php

namespace App\Providers;

use View;
use App\CategoriaReceta;
use Illuminate\Support\ServiceProvider;

class CategoriasProvider extends ServiceProvider{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        // Colocas dependencias al antes de comenzar laravel y configurar tu proyecto
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){
        // Se ejecuta todo cuando la aplicación está lista

        View::composer('*', function($view){
            $categorias = CategoriaReceta::all();
            $view->with('categorias', $categorias);
        });
    }
}
