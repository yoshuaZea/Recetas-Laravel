@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" integrity="sha512-pTg+WiPDTz84G07BAHMkDjq5jbLS/AqY0rU/QdugnfeE0+zu0Kjz++0rrtYNK9gtzEZ33p+S53S2skXAZttrug==" crossorigin="anonymous" />
@endsection


@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-primary text-white mr-2">Volver</a>
@endsection

@section('content')

    <h2 class="text-center mb-3">Editar receta: {{ $receta->titulo }}</h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-7">
            <form action="{{ route('recetas.update', ['receta' => $receta->id ]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="titulo"><b>Titulo de receta</b></label>
                    <input 
                        id="titulo" 
                        name="titulo" 
                        class="form-control @error('titulo') is-invalid @enderror" 
                        placeholder="¿Cuál es el título?"
                        value="{{ $receta->titulo }}"
                    />

                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="categoria"><b>Categoría</b></label>
                    <select
                        id="categoria" 
                        name="categoria" 
                        class="form-control @error('categoria') is-invalid @enderror" 
                        placeholder="¿Cuál es el título?"
                    >
                        <option value="">Selecciona una categoría</option>
                        @foreach($categorias as $categoria)
                            <option 
                                value="{{ $categoria->id }}" 
                                {{ $receta->categoria_id == $categoria->id ? 'selected' : null }}
                            >{{ $categoria->categoria}}</option>
                        @endforeach
                    </select>

                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="preparacion"><b>Preparación</b></label>
                    <input type="hidden" id="preparacion" name="preparacion" value="{{ $receta->preparacion }}" />
                    <trix-editor
                        class="form-control @error('preparacion') is-invalid @enderror"
                        input="preparacion"
                    ></trix-editor>

                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ingredientes"><b>Ingredientes</b></label>
                    <input type="hidden" id="ingredientes" name="ingredientes" value="{{ $receta->ingredientes }}" />
                    <trix-editor 
                        class="form-control @error('ingredientes') is-invalid @enderror"
                        input="ingredientes"
                    ></trix-editor>

                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="imagen"><b>Elige una imagen</b></label>
                    <input 
                        type="file"
                        id="imagen"
                        name="imagen"
                        class="form-control @error('imagen') is-invalid @enderror"
                    />

                    <div class="mt-4">
                        <p><b>Imagen actual:</b></p>
                        <img src="/storage/{{ $receta->imagen }}" class="img-fluid" alt="...">
                    </div>

                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Editar receta">
                </div>
            </form>
        </div>
    </div>
    
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" integrity="sha512-EkeUJgnk4loe2w6/w2sDdVmrFAj+znkMvAZN6sje3ffEDkxTXDiPq99JpWASW+FyriFah5HqxrXKmMiZr/2iQA==" crossorigin="anonymous" defer></script>
@endsection