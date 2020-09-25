<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img class="card-img-top" src="/storage/{{ $receta->imagen }}" alt="Imagen receta">
        <div class="card-body justify-content-between">
            <div>
                <h4 class="card-title">{{ $receta->titulo }}</h4>
    
                <div class="meta-receta d-flex justify-content-between">
                    @php
                        $fecha = $receta->created_at
                    @endphp
                    <p class="text-primary font-weight-bold fecha">
                        <fecha-receta fecha="{{$fecha}}"></fecha-receta>
                    </p>
    
                    <p>{{ $receta->likes->count() }} les gustó</i></p>
                </div>
    
                <div class="card-text">
                    <p>{{ Str::words(strip_tags($receta->preparacion), 20) }}</p>
                </div>
            </div>

            <a 
                href="{{ route('recetas.show', ['receta' => $receta->id ]) }}"
                class="btn btn-primary btn-block"
            >Ver receta</a>
        </div>
    </div>
</div>