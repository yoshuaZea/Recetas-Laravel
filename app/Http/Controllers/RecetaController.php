<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller {

    public function __construct(){
        $this->middleware('auth', [
            'except' => ['show', 'search'] 
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        // Consultar con Eloquent
        // Auth::user()->recetas->dd();
        // auth()->user()->recetas->dd();

        // $recetas = Auth::user()->recetas;
        $usuario = auth()->user();

        // Recetas con paginación
        $recetas = Receta::where('usuario_id', $usuario->id)->paginate(3);

        return view('recetas.index', compact('recetas', 'usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        /**
         * Consulta DB
         * pluck - selecciona ciertos campos
         */

        // Consultar datos de forma directa (sin modelo)
        // $categorias = DB::table('categoria_recetas')->get()->pluck('categoria', 'id');

        // Con modelo
        $categorias = CategoriaReceta::all(['id', 'categoria']);

        return view('recetas.create')
                ->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // Console log que usas
        // dd($request->all());

        // Realizar validación
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required|integer',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image|max:1000'
        ]);

        // Subir imágenes al servidor
        $rutaImagen = $request['imagen']->store('upload-recetas', 'public');

        // Resize de la imagen
        $img = Image::make(public_path("storage/{$rutaImagen}"))->fit(1000, 550);
        $img->save();

        // Inserción directa a la BD (sin modelo)
        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'ingredientes' => $data['ingredientes'],
        //     'preparacion' => $data['preparacion'],
        //     'imagen' => $rutaImagen,
        //     'usuario_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria'],
        // ]);

        // Inserción con modelo (ya incluye relación)
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $rutaImagen,
            'categoria_id' => $data['categoria']
        ]);

        return redirect()->action('RecetaController@index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta){

        // Algunos métodos para obtener recetas
        // $query = Receta::find($receta);
        // $query = Receta::findOrFail($receta);

        // Obtener usuario actual le gusta la receta y está autenticado
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;

        // Total de likes a la vista
        $likes = $receta->likes->count();

        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta){
        // Revisar policy
        $this->authorize('view', $receta);

        // Con modelo
        $categorias = CategoriaReceta::all(['id', 'categoria']);

        return view('recetas.edit', compact('receta', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta){

        // Revisar policy
        $this->authorize('update', $receta);

        // Realizar validación
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required|integer',
            'preparacion' => 'required',
            'ingredientes' => 'required',
        ]);

        // Asignar los cambios
        $receta->titulo = $data['titulo'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->preparacion = $data['preparacion'];
        $receta->categoria_id = $data['categoria'];

        // Si se sube nueva imagen
        if($request['imagen']){
            // Subir imágenes al servidor
            $rutaImagen = $request['imagen']->store('upload-recetas', 'public');

            // Resize de la imagen
            $img = Image::make(public_path("storage/{$rutaImagen}"))->fit(1000, 550);
            $img->save();

            // Asignar al objeto
            $receta->imagen = $rutaImagen;
        }

        // Guardar los cambios
        $receta->save();

        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta){
        // Revisar policy
        $this->authorize('delete', $receta);

        $receta->delete();

        return redirect()->action('RecetaController@index');
    }

    public function search(Request $request){
        // Cachar valor
        // $busqueda = $request['buscar'];
        $busqueda = $request->get('buscar');

        // Buscar la receta solicitada
        $recetas = Receta::where('titulo', 'like', "%$busqueda%")->paginate(10);

        // Agregar una variable al query string (para paginación)
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show', compact('recetas', 'busqueda'));
    }
}
