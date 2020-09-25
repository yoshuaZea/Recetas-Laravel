@extends('layouts.app')


@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')

    <h2 class="text-center mb-3">Administra tus recetas</h2>

    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recetas as $receta)
                    <tr>
                        <td>{{ $receta->titulo }}</td>
                        <td>{{ $receta->categoria->categoria }}</td>
                        <td>
                            {{-- 
                                FORMA 1
                                <form action="{{ route('recetas.destroy', ['receta' => $receta->id ]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-danger w-100 mb-2" value="Eliminar &times;" />
                                </form> 
                            --}}
                            <eliminar-receta 
                                receta-id={{ $receta->id }}
                            ></eliminar-receta>
                            <a href="{{ action('RecetaController@edit', ['receta' => $receta->id ]) }}" class="btn btn-dark btn-block">Editar</a>
                            <a href="{{ route('recetas.show', ['receta' => $receta->id ]) }}" class="btn btn-success btn-block">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $recetas->links() }}
        </div>

        <h2 class="text-center my-5">Recetas que te gustan</h2>
        <div class="col-md-10 mx-auto bg-white p-3">
            @if(count($usuario->meGusta) > 0)
            <ul class="list-group">
                @foreach($usuario->meGusta as $key => $receta)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <img class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" src="/storage/{{ $receta->imagen }}" alt="{{ $receta->titulo }}">
                        <p class="mb-0">{{ $receta->titulo}}</p>
                        <a href="{{ route('recetas.show', ['receta' => $receta->id ]) }}" class="btn btn-outline-success">Ver</a>
                    </li>
                @endforeach
            </ul>
            @else
                <p class="text-center">
                    Aún no tienes recetas con likes 
                    <small>Dale me gusta a las recetas y aquí aparecerán</small>
                </p>
            @endif
        </div>
    </div>

    
@endsection