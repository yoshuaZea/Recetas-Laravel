<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model {

    // Campos que se agregarán
    protected $fillable = [
        'titulo',
        'ingredientes',
        'preparacion',
        'imagen',
        'categoria_id'
    ];
    
     /** Relación 1:n de Recetas a Categoria */
     public function categoria(){
        return $this->belongsTo(CategoriaReceta::class, 'categoria_id');
    }

    // Obtiene la información del usuario via FK
    public function autor() {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Likes recibios a una receta
    public function likes(){
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}
