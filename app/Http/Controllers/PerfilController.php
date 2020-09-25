<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller {


    public function __construct(){
        $this->middleware('auth', [
            'except' => 'show'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil){

        // Obtener recetas con paginación
        $recetas = Receta::where('usuario_id', $perfil->usuario_id)->paginate(3);

        return view('perfiles.show', compact('perfil', 'recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil){
        // Verificar policy
        $this->authorize('view', $perfil);

        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil){
        // Verificar policy
        $this->authorize('update', $perfil);

        // Realizar validación
        $data = $request->validate([
            'nombre' => 'required|min:6',
            'url' => 'required',
            'biografia' => 'required'
        ]);

        // Si se sube una imagen
        if($request['imagen']){
            // Subir imágenes al servidor
            $rutaImagen = $request['imagen']->store('upload-perfiles', 'public');

            // Resize de la imagen
            $img = Image::make(public_path("storage/{$rutaImagen}"))->fit(600,600);
            $img->save();

            // Asignar al objeto
            $array_imagen = ['imagen' => $rutaImagen];
        }

        // Asignar nombre y url
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        // Eliminar url y name
        unset($data['url']);
        unset($data['nombre']);

        // Asignar biografia e imagen
        auth()->user()->perfil()->update(array_merge(
            $array_imagen ?? [], 
            $data
        ));

        // Redireccionar
        return redirect()->action('RecetaController@index');

    }
}
