@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Resultados de búsqueda: {{ $busqueda }} </h2>    

        <div class="row">
            @if($recetas->count() > 0)
                @foreach($recetas as $receta)
                    @include('ui.receta')                
                @endforeach

                <div class="col-md-12">
                    <div class="d-flex justify-content-center mt-5">
                        {{ $recetas->links() }}
                    </div>
                </div>
            @else
                <div class="col-md-12">
                    <p class="text-primary mb-0">
                        Aún no hay recetas
                    </p>    
                </div>                
            @endif
        </div>
    </div>    
@endsection