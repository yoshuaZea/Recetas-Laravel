<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model{
    /** Relación 1:1 de Perfil a Usuario */
    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
