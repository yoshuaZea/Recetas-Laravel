<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstruccionesController extends Controller {
    
    /**
     * __invoke - Carga por default el unico elemento del controlador
     * En las rutas solo se colova el nombre del controlladorc
     */

    public function index() {

        $recetas = [
            'Receta pizza',
            'Receta tacos',
            'Receta hamburguesas'
        ];

        $categorias = [
            'comida',
            'cena',
            'postres'
        ];

        /**
         * FORMAS DE RETORNAR VALORES A LA VISTA
         */

        // Forma 1 ->with(nombre, varibale)
        return view('recetas.index')
                    ->with('recetas', $recetas)
                    ->with('categorias', $categorias);

        // Forma 2 compact()
        return view('recetas.index', compact('recetas', 'categorias'));
    }
}
