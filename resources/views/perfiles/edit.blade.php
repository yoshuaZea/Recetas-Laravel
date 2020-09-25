@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" integrity="sha512-pTg+WiPDTz84G07BAHMkDjq5jbLS/AqY0rU/QdugnfeE0+zu0Kjz++0rrtYNK9gtzEZ33p+S53S2skXAZttrug==" crossorigin="anonymous" />
@endsection


@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-outline-primary text-uppercase font-weight-bold mr-2">
        <svg class="icono" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 19l-7-7 7-7"></path></svg>
        Volver
    </a>
@endsection

@section('content')
    
    <h1 class="text-center">Editar mi perfil</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form action="{{ route('perfiles.update', ['perfil' => $perfil->id ]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre"><b>Nombre</b></label>
                    <input 
                        id="nombre" 
                        name="nombre" 
                        class="form-control @error('nombre') is-invalid @enderror" 
                        placeholder="¿Cuál es tu nombre?"
                        value="{{ $perfil->usuario->name }}"
                    />

                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url"><b>Sitio web</b></label>
                    <input 
                        id="url" 
                        name="url" 
                        class="form-control @error('url') is-invalid @enderror" 
                        placeholder="¿Cuál es tu sitio web?"
                        value="{{ $perfil->usuario->url }}"
                    />

                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="biografia"><b>Biografía</b></label>
                    <input type="hidden" id="biografia" name="biografia" value="{{ $perfil->biografia }}" />
                    <trix-editor
                        class="form-control @error('biografia') is-invalid @enderror"
                        input="biografia"
                    ></trix-editor>

                    @error('biografia')
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

                    @if($perfil->imagen)
                        <div class="mt-4">
                            <p><b>Imagen actual:</b></p>
                            <img src="/storage/{{ $perfil->imagen }}" class="w-25 rounded-circle" alt="...">
                        </div>
                    @endif 

                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Actualizar perfil">
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" integrity="sha512-EkeUJgnk4loe2w6/w2sDdVmrFAj+znkMvAZN6sje3ffEDkxTXDiPq99JpWASW+FyriFah5HqxrXKmMiZr/2iQA==" crossorigin="anonymous" defer></script>
@endsection