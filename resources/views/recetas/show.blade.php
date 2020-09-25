@extends('layouts.app')

@section('content')
    <article class="contenido-receta bg-white p-5 shadow">
        <h1 class="text-center mb-4">{{ $receta->titulo }}</h1>

        <div class="imagen-receta">
            <img src="/storage/{{ $receta->imagen }}" alt="..." class="w-100" />    
        </div>

        <div class="receta-meta mt-3">
            <p class="mb-0">
                <span class="font-weight-bold text-primary">Escrito en:</span>
                <a 
                    href="{{ route('categorias.show', ['categoriaReceta' => $receta->categoria->id ]) }}"
                    class="text-dark"
                >
                    {{ $receta->categoria->categoria }}
                </a>
            </p>
            <p class="mb-0">
                <span class="font-weight-bold text-primary">Autor:</span>
                <a 
                    href="{{ route('perfiles.show', ['perfil' => $receta->autor->id ]) }}"
                    class="text-dark"
                >
                    {{ $receta->autor->name }}
                </a>
            </p>
            <p class="mb-0">
                <span class="font-weight-bold text-primary">Fecha:</span>
                @php
                    $fecha = $receta->created_at
                @endphp
                <fecha-receta fecha="{{$fecha}}"></fecha-receta>
            </p>

            <div class="ingredientes">
                <h2 class="my-3 text-primary">Ingredientes</h2>

                {!! $receta->ingredientes !!}
            </div>

            <div class="preparacion">
                <h2 class="my-3 text-primary">Preparación</h2>

                {!! $receta->preparacion !!}
            </div>

            <div class="row justify-content-center text-center">
                <like-button
                    receta-id="{{ $receta->id }}"
                    like="{{ $like }}"
                    likes="{{ $likes }}"
                ></like-button> 
            </div>
        </div>

    </article>
@endsection