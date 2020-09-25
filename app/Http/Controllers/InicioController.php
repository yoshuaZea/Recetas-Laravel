<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller{

    public function index(){

        // Recetas por cantidad de votos
        // $votadas = Receta::has('likes', '>', 0)->get();
        $votadas = Receta::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();

        // Obtener las recetas más nuevas
        $nuevas = Receta::latest()
                            ->take(5)
                            ->get();

        // 1. Obtener todas las categorias
        $categorias = CategoriaReceta::all();

        // 2. Iterar en cada una para agruparlas
        $recetas = [];
        foreach ($categorias as $categoria) {
            $recetas[Str::slug($categoria->categoria)][] = Receta::where('categoria_id', $categoria->id)
                                                                    ->orderBy('created_at', 'desc')
                                                                    ->take(3)
                                                                    ->get();
        }

        return view('inicio.index', compact('nuevas', 'recetas', 'votadas'));
    }
}
