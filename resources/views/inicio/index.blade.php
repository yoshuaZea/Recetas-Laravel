@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" />
@endsection

@section('content')

    @section('hero')
        <div class="hero-categorias">
            <form action="{{ route('buscar.show') }}" type="get" class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-md-4 texto-buscar">
                        <p class="display-4">Encuentra una receta para tu próxima comida</p>
                        <input type="search" name="buscar" class="form-control" placeholder="Buscar receta...">
                    </div>
                </div>
            </form>
        </div>
    @endsection

    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Últimas recetas</h2>  

        <div class="owl-carousel owl-theme">
            @foreach($nuevas as $nueva)
                <div class="card">
                    <img class="card-img-top" src="/storage/{{ $nueva->imagen }}" alt="{{ $nueva->titulo}}">
                    <div class="card-body justify-content-between">
                        <div>
                            <h3>{{ $nueva->titulo }}</h3>
                            <p>{{ Str::words(strip_tags($nueva->preparacion), 15) }}</p>
                        </div>
                        <a 
                            href="{{ route('recetas.show', ['receta' => $nueva->id ]) }}"
                            class="btn btn-primary d-block font-weight-bold- text-uppercase"
                        >Ver receta</a>
                    </div>
                </div>    
            @endforeach
        </div>

    </div>

    {{-- RECETAS MÁS VOTADAS --}}
    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Recetas más votadas</h2>
        <div class="row">
            @foreach($votadas as $receta)
                @if($receta->count() > 0)
                    @include('ui.receta')
                @else
                    <div class="col-md-12">
                        <p class="text-primary mb-0">Aún no hay recetas para esta categoría</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- RECETAS POR CATEGORIA --}}
    @foreach($recetas as $key => $grupo)
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mt-5 mb-4">{{ str_replace('-', ' ', $key) }}</h2>
            <div class="row">
                @foreach($grupo as $recetasGrupo)
                    @if($recetasGrupo->count() > 0)     
                        @foreach($recetasGrupo as $receta)
                           @include('ui.receta')
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <p class="text-primary mb-0">Aún no hay recetas para esta categoría</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
    
@endsection