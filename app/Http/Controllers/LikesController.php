<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class LikesController extends Controller{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function update(Receta $receta){
        // Almacena likes de usuario a una receta
        return auth()->user()->meGusta()->toggle($receta);
    }
}
